<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    var $name = 'Users';
    public $helpers = array('Html', 'Form');
    public $uses = array('User','EmailTemplate');
    public $components = array( 'Common', 'Auth', 'Session', 'Cookie', 'RequestHandler', 'Email', 'PaymentHandlerPaypal', 'EmailHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('login','signup','forgot_password','contact','is_user_available','is_invalid_email','reset_password'));

        $methods = array('admin_delete_invalid_email', 'admin_send_bulk_email');
        if (in_array($this->action, $methods)) {
            ini_set('max_execution_time', 3600); //1h
            ini_set('memory_limit', '500M');
            $this->autoRender = false;
        }

    }

    /*
     * login
     */
    public function login() {
        if($this->Session->check('Auth.User')){
            $this->redirect(array('controller'=>'pages','action' => 'display'));
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect(array('controller'=>'pages','action' => 'display'));
            } else {
                $this->Session->setFlash("Invalid username or password !",'default',array('class'=>'alert alert-danger'));
            }
        }
    }

    /*
     * admin login
     * @param:null
     * @return:null
     */
    public function admin_login() {
        $this->layout = 'admin_login';
        if($this->Session->check('Auth.User')){
            $this->redirect(array('controller'=>'dashboards','action' => 'display'));
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash("Invalid username or password !",'default',array('class'=>'error'));
            }
        }
    }

    /*
     * Logout
     */
    public function logout() {
        $this->Auth->logout();
        $this->redirect('/');
    }


    /*
     * user signup
     * @return null
     * @param null
     */
    public function signup() {

        if ($this->request->is('post')) {

            // START : photo upload
            /*$photo = $this->request->data['User']['photo'];
            if ($photo['name']) {
                $result = $this->FileHandler->uploadImage($photo);
                if ($result) {
                    $photo = $this->FileHandler->_uploadimgname;
                }else {
                    $photo = '';
                }
            }else{
                $photo = '';
            }
            $this->request->data['User']['photo'] = $photo;*/
            //END: photo upload

            $this->User->create();
            $this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
            $this->request->data['User']['role'] = 'user';
            $this->request->data['User']['status'] = '1';

            $email = $this->request->data['User']['email'];
            $this->request->data['User']['username'] = $email;

            $user = $this->request->data;

            if ($this->User->save($user)) {
                $this->__sendEmail(
                    array($this->Common->settings('site_name'),$this->Common->settings('site_email')),
                    $email,
                    'Thank you for your registration',
                    'signup',
                    $user
                );


                if ($this->Auth->login()) {
                    $this->Session->setFlash("You have successfully registered",'default',array('class'=>'alert alert-success'));
                    $this->redirect( array( 'controller'=>'pages','action' => 'display' ) );
                } else {
                    $this->Session->setFlash(__('Invalid username or password'),'default',array('class'=>'alert alert-danger'));
                }
            }

            $this->Session->setFlash("Unable to registered !",'default',array('class'=>'alert alert-danger'));

        }

        // country drop down
        $countries = $this->Common->Country();
        $this->set('countries',$countries);

    }


    /**
     * payment
     */

    public function payment() {

        $settings = $this->Common->settings();
        $this->set('account_charge', $settings['account_charge'] );

        if( $this->request->is('post') ) {

            $CartContent[0]=array(
                "Name"=>'Fitdad Account',
                "Code"=>time(),
                "UnitPrice"=>$settings['account_charge'],
                "Quantity"=>1,// quantity should ne changed
                "UseShippingCost"=>false,
                "ShippingCost"=>0,
                "UseHandlingCost"=>false,
                "HandlingCost"=>0
            );

            $user = $this->Session->read('Auth.User');


            echo $this->PaymentHandlerPaypal->PayPalBuyNowButtonCustom(
                $PayPalGateway="https://www.paypal.com/cgi-bin/webscr",
                $Command="_cart",
                //$BusinessEmail="info@themexgroup.com",
                $BusinessEmail=$settings['email'],
                $Item=$CartContent,
                $CurrencyCode="USD",
                $UseShippingCost=false,
                $ShippingCost=0,
                $NoShippingAddress=false,
                $UseHandlingCost=false,
                $HandlingCost=0,
                $TAX=0,
                $AutomaticNotificationURL= Router::url('/users/paypal_ipn/'.$user['id'].'/'.$user['token'], true),
                $ReturnURLOnSuccess= Router::url('/categories/video_categories', true),
                $ReturnURLOnFailure= Router::url('/', true),
                $ButtonCaption=" Click here to Pay Now ",
                $ImageButtonSource="",
                $ExtraOption=array(),
                $NoteCaption="",
                $NoNote=true,
                $Custom="",
                $InvoiceNumber="",
                $ReturnToMerchantButtonCaption="Please click here to complete the process",
                $SimulationMode= false
            );

            echo '<script>
                    document.getElementById("checkout").submit();
                </script>';
        }

    }

    /** paypal ipn */
    public function paypal_ipn( $user_id=null, $token=null ) {
        $this->autoRender = false;

        if($this->User->findByIdAndToken( $user_id, $token ) ) {

            $user = array( 'User'=>array( 'id'=>$user_id,'is_paid'=>1 ) );

            if( $this->User->save($user) ) {
                $this->Session->setFlash( "You have successfully paid",'default',array('class'=>'success') );
                $this->Session->write('Auth.User.is_paid',1);
            }

        }else{
            $this->Session->setFlash( "Invalid request, Please try again ",'default',array('class'=>'error') );
            $this->redirect( array( 'action' => 'payment') );
        }

    }

    /*
     * @return bool|void
     * @throws NotFoundException
     */
    public function my_profile() {
        $user = $this->User->findByIdAndStatus($this->Session->read('Auth.User.id'),1);
        if ($this->request->is(array('user', 'put'))) {

            // start cover photo up
            /* $photo = $this->request->data['User']['photo'];
             if ($photo['name']) {
                 $result = $this->FileHandler->uploadImage($photo);
                 if ($result) {
                     $photo = $this->FileHandler->_uploadimgname;
                 }else {
                     $photo = '';
                 }
             }else{
                 $photo = $user['User']['photo'];
             }

             $this->request->data['User']["photo"] = $photo;*/
            // end cover photo up

            $this->User->id = $user['User']['id'];
            $this->request->data['User']['date_updated'] = date("Y-m-d H:i:s");

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash("Your profile has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect($this->referer());
            }
            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }

        // country drop down
        $countries = $this->Common->Country();
        $this->set('countries',$countries);

    }

    /*
     * forgot password
     * @param:null
     * @return:
     */
    public function forgot_password() {
        if(!empty($this->request->data)) {
            $user_info = $this->User->findByEmail($this->request->data['User']['email']);
            if($user_info) {
                //this, token is not related with user token table, save token and token generated date time
                $user['User']['token'] = $this->Common->getToken();
                $user['User']['token_generated'] = date("Y-m-d H:i:s");
                $user['User']['id'] = $user_info['User']['id'];

                if($this->User->save($user)) {
                    // send stored token and other info into email
                    $user = $this->User->findByEmail($this->request->data['User']['email']);
                    $this->__sendEmail(
                        array($this->Common->settings('site_name'),$this->Common->settings('site_email')),
                        $user['User']['email'],
                        'Reset password request',
                        'forgot_password',
                        $user
                    );

                    $message = 'An email has been sent with a link to reset your password';
                    $this->Session->setFlash($message,'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->referer());
                }

            } else {
                $message = 'No user was found with the submitted email address';
                $this->Session->setFlash($message,'default',array('class'=>'alert alert-danger'));
            }
        }
    }

    /*
     * reset password
     */
    public function reset_password($token = null){
        // submit reset password form
        if($this->request->is('post')) {
            $user = $this->User->findByToken($this->request->data['User']['token']);
            $user['User']['password'] = $this->request->data['User']['password'];
            if($this->User->save($user)) {
                $this->__sendEmail(
                    array($this->Common->settings('site_name'),$this->Common->settings('site_email')),
                    $user['User']['email'],
                    'Reset password',
                    'reset_password',
                    $user
                );

                $message = 'Your password has been reset successfully,you may login now';
                $this->Session->setFlash($message,'default',array('class'=>'alert alert-success'));

                $this->redirect(array('action'=>'login'));
            }

        }else{
            // redirect from email forgot password link
            $redirect = false;
            if($token){
                $user = $this->User->findByToken($token);
                if($user){
                    if($this->Common->countDays($user['User']['token_generated'])>1){
                        $this->Session->setFlash('Request timeout, Please try again','default',array('class'=>'alert alert-danger'));
                        $redirect = true;
                    }
                }else{
                    $this->Session->setFlash('Invalid token, Please try again','default',array('class'=>'alert alert-danger'));
                    $redirect = true;
                }
            }else{
                $this->Session->setFlash('Token is empty, Please try again','default',array('class'=>'alert alert-danger'));
                $redirect = true;
            }

            if($redirect){
                $this->redirect(array('action'=>'forgot_password'));
            }else{
                $this->set('token',$token);
            }
        }
    }



    /**
     * change password
     * @param:null
     * @return:
     */
    function change_password() {

        //pr($settings);
        if($this->request->isPost()) {

            $email = $this->Session->read('Auth.User.email');
            $user = $this->User->find('first',array('conditions'=>array('email'=>$email,'status'=>1)));
            $current_password = AuthComponent::password($this->request->data['User']['current_password']);


            if($current_password === $user['User']['password']) {



                $this->request->data['User']['id'] = $user['User']['id'];

                if($this->User->save($this->request->data)){
                    $user['User']['password']= $this->request->data['User']['password'];
                    $this->__sendEmail(
                        array($this->Common->settings('site_name'),$this->Common->settings('site_email')),
                        $user['User']['email'],
                        'Change password request',
                        'change_password',
                        $user
                    );

                    $this->Session->setFlash("Password has been successfully changed",'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->referer());
                }else{
                    $this->Session->setFlash("Unable to change password !",'default',array('class'=>'alert alert-danger'));
                }

            } else {
                $this->Session->setFlash("Your current password didn't match",'default',array('class'=>'alert alert-danger'));
            }

        }
    }



    /*
     * create temporary password
     * @param $len
     * @return string
     */

    public function __createTempPassword($len) {
        $pass = '';
        $lchar = 0;
        $char = 0;
        for($i = 0; $i < $len; $i++) {
            while($char == $lchar) {
                $char = rand(48, 109);
                if($char > 57) $char += 7;
                if($char > 90) $char += 6;
            }

            $pass .= chr($char);
            $lchar = $char;
        }

        return $pass;
    }


    /*
     * view users from admin panel
     * @param:null
     * @return:null
     */
    public function admin_index() {
        if(!$this->Session->check('Auth.User')){
            $this->redirect(array('controller'=>'users','action' => 'login'));
        }

        if($this->request->isPost()){
            $this->Session->write('UserFilter', $this->request->data['User']);
        }

        $where = $this->__builtContentWhere();

        $this->paginate = array(
            'conditions' => $where,
            //'offset' => 0,
            'limit' => 30,
            'order' => array('id' => 'asc')
        );

        $user = $this->paginate('User');
        $this->set('users', $user);

        $get_templates =$this->EmailTemplate->find('list',array('fields' => array('id','template_name')));
        $this->set('get_templates', $get_templates);

    }


    /*
     * create user from admin panel
     * @return null
     * @param null
     */
    public function admin_create() {
        if ($this->request->is('post')) {

            /*$get_file = $this->request->data['User']['photo']['name'];

            // START : photo upload
            $photo = $this->request->data['User']['photo'];
            if ($photo['name']) {
                $result = $this->FileHandler->uploadImage($photo);
                if ($result) {
                    $photo = $this->FileHandler->_uploadimgname;
                }else {
                    $photo = '';
                }
            }else{
                $photo = '';
            }
            $this->request->data['User']['photo'] = $photo;
            //END: photo upload*/

            $this->User->create();
            $this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
            $this->request->data['User']['role'] = 'user';

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash("User has been successfully created",'default',array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

        }

        // country drop down
        $countries = $this->Common->Country();
        $this->set('countries',$countries);

    }



    /***
     * update user from admin panel
     * @param null $id
     * @return bool|void
     * @throws NotFoundException
     */
    public function admin_update($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid request !'));
        }

        $user = $this->User->findById($id);

        if (!$user) {
            throw new NotFoundException(__('Invalid request !'));
        }

        if ($this->request->is(array('user', 'put'))) {

            /*// start cover photo up
            $photo = $this->request->data['User']['photo'];
            if ($photo['name']) {
                $result = $this->FileHandler->uploadImage($photo);
                if ($result) {
                    $photo = $this->FileHandler->_uploadimgname;
                }else {
                    $photo = '';
                }
            }else{
                $photo = $user['User']['photo'];
            }

            $this->request->data['User']["photo"] = $photo;
            // end cover photo up*/

            $this->User->id = $id;
            $this->request->data['User']['date_updated'] = date("Y-m-d H:i:s");

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash("Data has been updated.",'default',array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'admin_index'));
            }
            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
            // country drop down
            $countries = $this->Common->Country();
            $this->set('countries',$countries);
        }


    }


    /*
     * delete user from admin panel
     * @param null $id
     * @throws MethodNotAllowedException
     */
    public function admin_delete($id = null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->User->delete($id)) {
            $this->Session->setFlash("Record has been successfully deleted !",'default',array('class'=>'alert alert-success'));
            return $this->redirect(array('action' => 'admin_index'));
        }
    }


    /*
     * reset filter
     */
    public function admin_reset(){
        if($this->Session->check('UserFilter')){
            $this->Session->delete('UserFilter');
        }
        $this->redirect('index');
    }

    /*
     * filter
     */
    public function __builtContentWhere(){
        $filter = null;
        if($this->Session->check('upload_file_id')){
            $upload_file_id = $this->Session->read('upload_file_id');
            $conditions['AND'] = array('User.upload_file_id' => $upload_file_id );
        }else{
            $conditions = array();
        }

        if($this->Session->check('UserFilter')){
            $filter = $this->Session->read('UserFilter.filter');
        }
        if(!empty($filter)){
            $conditions['OR'] = array(
                array('User.first_name LIKE' => '%' . $filter . '%'),
                array('User.last_name LIKE' => '%' . $filter . '%'),
                //array('User.phone LIKE' => '%' . $filter . '%'),
                array('User.email LIKE' => '%' . $filter . '%')
            );
        }

        return $conditions;
    }



    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $template
     * @param $viewVars
     * @return bool
     */
    public function __sendEmail($from, $to, $subject, $template,$viewVars)
    {
        if($_SERVER['HTTP_HOST']!='localhost' AND $_SERVER['HTTP_HOST']!='localhost:8080'){
            $this->Email->to = $to;
            $this->Email->bcc = $to;
            $this->Email->subject = $subject;
            $this->Email->replyTo =$from[1];
            $this->Email->from = $from[0].'<'.$from[1].'>';
            $this->Email->template =$template;
            $this->Email->sendAs = 'html';
            $this->set('user',$viewVars);
            //$this->Email->delivery = 'debug';
            $success = $this->Email->send();
            return $success;
        }
    }

    /**
     * contact
     */
    public function contact() {

        $this->autoRender = false;

        if($this->request->is('post')){
            $data = $this->request->data;

            if(!empty($data)){
                $send_email = $this->__sendEmail(
                    array($this->Common->settings('site_name'),$data['contact']['email']),
                    $this->Common->settings('site_email'),
                    $data['contact']['subject'],
                    'contact',
                    $data
                );

                if($send_email){
                    $message = 'Your message has been successfully sent';
                }else{
                    $message = 'Message could not be sent';
                }

                $this->Session->setFlash($message,'default',array('class'=>'alert alert-success'));
                $this->redirect($this->referer());
            }
        }
    }

    /**
     * user details
     */
    public function admin_details($user_id=null){
        if(!empty($user_id)){
            $user = $this->User->findById($user_id);
            $this->set('user', $user);

        }else{
            $this->Session->setFlash("This user could not found",'default',array('class'=>'alert alert-danger'));
        }
    }

    /*function is_user_available(){
        $this->autoRender = false;
        $user = $this->User->findByEmail($this->request->data['email']);
        if(empty($user)){
            echo 'true';die;
        }else{
            echo 'false';die;
        }
    }*/

    function is_invalid_email(){
        $this->autoRender = false;
        $user = $this->User->findByEmail($this->request->data['email']);
        if(!empty($user)){
            echo 'true';die;
        }else{
            echo 'false';die;
        }

    }


    function admin_process_file(){
        $file_path = WWW_ROOT.'uploads' . DS . 'files' . DS. 'file1.txt';
        $array = $this->EmailHandler->fileToArray($file_path);

        if($array){
            $this->saveFileData($array);
        }

    }


    function saveFileData($array) {
        foreach($array as $row){
            $user = $this->User->find('first',array('conditions'=>array('email'=>$row['email'] ) ) );
            if(!$user){
                $this->User->create();
                $this->User->save($row,false);
            }
        }

        $this->Session->setFlash('Process is successfully completed','default',array('class'=>'alert alert-success'));
        return $this->redirect( array( 'action' => 'index') );
    }



    function admin_send_bulk_email(){
        $start= $this->request->data['EmailProcess']['start'];
        $end= $this->request->data['EmailProcess']['limit'];

        $users = $this->User->find('all',array(
                'conditions'=>array('User.id BETWEEN '.$start.' AND '.$end.' '),
                //'offset' => $offset,
                //'limit' => $limit,
            )
        );

        //pr($users); die;

        if($users) {
            foreach( $users as $user) {
                $this->sendEmail($user);

                $this->User->id = $user['User']['id'];
                $this->User->saveField('is_email_sent', 1, false);

                $this->EmailHandler->reset();
                sleep(1);
            }
        }

        $this->Session->setFlash('Emails has been sent successfully','default',array('class'=>'alert alert-success'));
        return $this->redirect( array( 'action' => 'index') );
    }


    function sendEmail($user) {
        // This request come from (admin_send_bulk_email)
        $template_info = $this->EmailTemplate->findById($this->request->data['EmailProcess']['email_template_id']);

        $view_var['User'] = $user['User'];
        $view_var['site_name'] = $this->Common->settings('site_name');

        $view_var['message'] = $template_info['EmailTemplate']['message'];
        $view_var['special_note'] = $template_info['EmailTemplate']['special_note'];
        $view_var['image'] = $this->webroot.'uploads/emailtemplates/'.$template_info['EmailTemplate']['image'];


        $info = array(
            'to'=>$user['User']['email'],
            'subject'=>$template_info['EmailTemplate']['subject'],
            'email_template'=>'bulk_email',
            'view_var'=>$view_var
        );

        $this->EmailHandler->submit($info);
    }

    public function admin_reset_file_id(){
        $this->autoRender = false;
        if($this->Session->check('upload_file_id')) $this->Session->delete('upload_file_id');
        $this->redirect('index');
    }

    public function admin_set_file_id(){
        $this->autoRender = false;
        $this->Session->write('upload_file_id', $this->request->params['pass'][0]);
        $this->redirect('index');
    }

    public function admin_email_subscription(){
        if($this->request->is('post')){
            $validate = $this->EmailHandler->is_user_available($this->request->data['User']['email']);
            if($validate['status']) {
                $this->User->create();
                if($this->User->save($this->request->data)){
                    $this->Session->setFlash("Email has been added successfully",'default',array('class'=>'alert alert-success'));
                    $this->redirect('index');
                }

            }else{
                $this->Session->setFlash($validate['msg'],'default',array('class'=>'alert alert-warning'));
                $this->redirect('index');
            }
        }
    }

    function admin_delete_invalid_email(){
        $this->autoRender = false;
        $users = $this->User->find('all', array('conditions' => array('User.id!=1') ) );

        $i=0;
        if($users){
            foreach($users as $user){
                $validate = $this->EmailHandler->is_user_available($user['User']['email'], $is_update_mode= true);
                if(!$validate['status']){
                    $this->User->delete( $user['User']['id'] );
                    $i++;
                }
            }
        }

        $this->Session->setFlash($i."  Record(s) has been deleted successfully!",'default',array('class'=>'alert alert-success'));
        return $this->redirect(array('action' => 'admin_index'));
    }


}
