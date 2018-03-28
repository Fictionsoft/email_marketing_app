<?php
App::uses('AppController', 'Controller');


class ProductsController extends AppController {
    public $uses = array('Product','Category','Brand');
    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(
            'details',
            'index',
            'new_arrival',
            'cart',
            'delete_cart_item',
            'order_submit',
            'category',
            'size_guide',
            'product_search',
            'save_comment',
            'single_product',
            'wish_list',
            'getSize'
        );
    }

    /**
     * Feature items
     * @param null
     * @return null
     */
    public function admin_index() {

        if(!empty($this->data)){
            $this->Session->write('ProductFilter', $this->request->data['Product']);
        }

        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $products = $this->paginate('Product');
        $this->set('products',  $products);
    }

    /**
     * New Arrival
     */
    public function new_arrival(){
        $products = $this->Product->find('all',array( 'condition'=>array( 'Product.status'=>1 ) ,'order'=>'Product.created DESC','limit'=>8 ) );
        return $products;
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {

        if($this->request->is('post')) {

            // START : cover photo upload
            $cover_photo = $this->request->data['Product']['cover_photo'];
            if ($cover_photo['name']) {
                $result = $this->FileHandler->uploadImage($cover_photo);
                if ($result) {
                    $this->request->data['Product']["cover_photo"] = $this->FileHandler->_uploadimgname;
                }else {
                    $this->request->data['Product']["cover_photo"] = '';
                }
            }else{
                $this->request->data['Product']["cover_photo"] = '';
            }
            //END: cover photo upload

            $this->Product->create();
            $this->request->data['Product']['created'] = date("Y-m-d H:i:s");

            if($this->Product->save($this->request->data)){


            $this->Session->setFlash("Product has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect('file_manager/'.$this->Product->getInsertID());
            }else{
                $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));
            }
        }

        $this->set('categories',$this->Category->getCategories());
        $this->set('brands',$this->Brand->getBrands());
    }

    /**
     * @param null $id
     * @return null
     */
    public function admin_update($id = null) {

        if(!$id) {
            throw new NotFoundException(__('Invalid request !'));
        }

        $product= $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException(__('Invalid request !'));
        }


        if($this->request->is(array('Product', 'put'))) {

            // start cover photo up
            $cover_photo = $this->request->data['Product']['cover_photo'];
            if ($cover_photo['name']) {
                $result = $this->FileHandler->uploadImage($cover_photo);
                if ($result) {
                    $this->request->data['Product']["cover_photo"] = $this->FileHandler->_uploadimgname;
                }else {
                    $this->request->data['Product']["cover_photo"] = '';
                }
            }else{
                $this->request->data['Product']["cover_photo"] = $product['Product']['cover_photo'];
            }
            // end cover photo up



            // start product size photo up
            $product_size_photo = $this->request->data['Product']['product_size_photo'];
            if ($product_size_photo['name']) {
                $result = $this->FileHandler->uploadImage($product_size_photo);
                if ($result) {
                    $this->request->data['Product']["product_size_photo"] = $this->FileHandler->_uploadimgname;
                }else {
                    $this->request->data['Product']["product_size_photo"] = '';
                }
            }else{
                $this->request->data['Product']["product_size_photo"] = $product['Product']['product_size_photo'];
            }
            // end product size photo up


            $this->Product->id = $id;
            $this->request->data['Product']['modified'] = date("Y-m-d H:i:s");
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash("Product has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect('file_manager/'.$id);
            }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }else{
            $this->request->data = $product;
        }

        $this->set('categories',$this->Category->getCategories());
        $this->set('brands',$this->Brand->getBrands());

    }

    public function admin_file_manager($product_id){

        if($this->request->is('post')){
            $file_type = $this->request->data['file_type'];

            if($file_type == 'Photo'){
                $this->request->data['Photo']['product_id'] = $product_id;
                // START : photo
                $photo = $this->request->data['Photo']['name'];
                if ($photo['name']) {
                    $result = $this->FileHandler->uploadImage($photo);
                    if ($result) {
                        $this->request->data['Photo']['name'] = $this->FileHandler->_uploadimgname;
                        $this->Product->Photo->save($this->request->data);
                        $product_photos = $this->Common->getUploadedPhotos($product_id,$this->webroot);
                        echo $product_photos;die;
                    }
                }
                //END: photo upload
            }
        }else{
            $product_photos = $this->Common->getUploadedPhotos($product_id,$this->webroot);
            $this->set(array(
                'photo_html'=>$product_photos
                )
            );
        }
    }

    function delete_photo($id,$product_id){
        $this->Product->Photo->delete($id);
        $product_photos = $this->Common->getUploadedPhotos($product_id,$this->webroot);
        echo json_encode(array('status'=>true,'photos'=>$product_photos));die;
    }
    /**
     * @param null $id
     * @return redirect to index
     */
    public function admin_delete($id = null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Product->delete($id)) {
            $this->Session->setFlash("Product #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('ProductFilter')){
            $this->Session->delete('ProductFilter');
        }
        $this->redirect('index');
    }


    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('ProductFilter')){
           $filter = $this->Session->read('ProductFilter.filter');
           $category_id = $this->Session->read('ProductFilter.category_id');
        }
        if(!empty($filter) or !empty($category_id)){
            $conditions = array(
                'OR' => array(
                array('Product.name LIKE' => '%' . $filter . '%'),
                array('Product.slug LIKE' => '%' . $filter . '%'),
                array('Product.price LIKE' => '%' . $filter . '%'),
                array('Category.name LIKE' => '%' . $filter . '%')
                )
            );
            if(!empty($category_id)){
                $conditions['AND'] = array('Product.category_id'=>$category_id);
            }

            $this->log($conditions);
        }

        return $conditions;
    }

    // home page feature products
    public function index() {
        /*$this->paginate = array(
            'conditions' => array('1'=>1),
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $products = $this->paginate($this->Category->Product);*/

        $products = $this->Category->find('all',array('conditions'=>array('Category.status'=>1)));
        //pr($products);
        return $products;
    }

    public function single_product(){
        $single_product = $this->Product->find('first',array(
            'conditions' => array(
                'Product.status'=>1,
            ),
            'order' => 'rand()',
        ));
        return $single_product;
    }

    // search product
    public function product_search() {

        // search
        if(!empty($this->request->data)){
            $this->Session->write('ProductFilter', $this->request->data['Product']);
        }else{
            $this->Session->delete('ProductFilter');
        }


        // filter
        $limit = 30;
        $order = array('id' => 'desc');
        if($this->request->is('post')){

            if(!empty($this->request->data['Product']['limit'])){
                $limit = $this->request->data['Product']['limit'];
            }

            if(!empty($this->request->data['Product']['order'])){
                $order = array('price' => $this->request->data['Product']['order'] );
            }
        }

        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => $limit,
            'order' => $order
        );

        $products = $this->paginate('Product');
        if(!empty($products)){
            $this->set('products',  $products);
        }else{
            $this->Session->setFlash('Product could not found','default',array('class'=>'alert alert-danger'));
        }

        $this->render('category');
    }

    /*
     * Product list
     */
    public function category($slug){

        $category = $this->Product->Category->findBySlug($slug);

        $where = array('Product.status'=>1,'Product.category_id'=>$category['Category']['id']);
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $products = $this->paginate('Product');

        if(!empty($products)){
            $this->set('products',  $products);
            $this->set('category',  $category['Category']['name']);
        }else{
            $this->Session->setFlash("Product could not found",'default',array('class'=>'alert alert-danger'));
        }
    }


    /**
     * Details
     * @param null $slug
     */
    public function details($slug = null) {
        $this->Product->recursive = 2;
        $product = $this->Product->findBySlug($slug);
        //$this->log($product,'debug');
        //pr($product);die;

        $this->set('product',$product);
    }

    /**
     * Card
     * @param null $slug
     */
    public function cart($id = null) {
        if(!$this->Session->check('Auth.User')){
            $this->redirect(array('controller'=>'users','action'=>'login'));
        }

        if($this->request->isPost()){
            $this->Product->recursive = 2;
            $product = $this->Product->findById($id);
            $product['Product']['quantity'] = ($this->request->data['Product']['quantity']<0)?1:$this->request->data['Product']['quantity'];
            $product['Product']['size'] = (!empty($this->request->data['Product']['size']))?$this->request->data['Product']['size']:'';


            $is_exist = false;

            // if exist products in cart
            if( $this->Session->check('Cart.Products') ) {

                $existing_products = $this->Session->read('Cart.Products');

                foreach($existing_products as $existing_product){

                    // Update quantity
                    if( $existing_product['Product']['id'] == $product['Product']['id']){
                        $is_exist = true;
                        $existing_product['Product']['quantity'] = $product['Product']['quantity']+$existing_product['Product']['quantity'];
                    }else{
                        $is_exist = false;
                    }

                    $products_array[] = $existing_product;

                }
            }

            // Insert this product in first element of products array in cart session
            if(!$is_exist)
            $products_array[] = $product;
            krsort($products_array);
            $cart_array['Products'] = $products_array;
            $this->__updateCart($cart_array);
        }

        $cart = $this->Session->read('Cart');
        if($cart['Products']){
            $this->set('cart',$cart);
        }else{
            $this->Session->setFlash("Your Cart is blank, Please add product to your Cart",'default',array('class'=>'alert alert-success'));
            $this->redirect(array('controller'=>'pages'));
        }
    }

    function __updateCart($cart_array){
        $cart_array['User'] = $this->Session->read('Auth.User');
        $this->Session->write('Cart',$cart_array);
    }


    public function delete_cart_item($id){
        $this->autoRender = false;

        if(!$this->Session->check('Auth.User'))
            $this->redirect(array('controller'=>'users','action'=>'login'));

        if(is_numeric($id) && !empty($id)){
            if($this->Session->check('Cart.Products')){
                $products = $this->Session->read('Cart.Products');
                $product_array = array();
                if($products){
                    foreach($products as $product){
                        if($product['Product']['id'] != $id){
                            $product_array[] = $product;
                        }
                    }

                    $cart_array['Products'] = $product_array;

                    $this->__updateCart($cart_array);
                    $this->redirect(array('action'=>'cart'));
                }
            }
        }
    }

    public function order_submit(){
        $this->autoRender = false;
        if(!$this->Session->check('Auth.User'))
            $this->redirect(array('controller'=>'users','action'=>'login'));


        if($this->request->isPost()) {
            $settings = $this->Common->settings();

            // update user info
            $this->__updateSessionUserInfo();

            $is_sent = $this->__sendEmail(
                array($settings['site_name'],$settings['email']),
                $this->Session->read('Cart.User.email'),
                'Order Products',
                'order',
                $this->Session->read('Cart')
            );
            if($is_sent){
                $this->Session->setFlash(__('Your order has been successfully sent, Thanks'),'default',array('class'=>'alert alert-success'));
                $this->Session->delete('Cart');
                $this->redirect(array('controller'=>'pages'));

            }else{
                $this->Session->setFlash(__('Your order could not be sent, Please try again' ),'default',array('class'=>'alert alert-danger'));
                $this->redirect('cart');
            }
        }
    }


    function __updateSessionUserInfo(){
        $user = $this->Session->read('Auth.User');
        $user['payment_method'] = $this->request->data['User']['payment_method'];
        $user['message'] = $this->request->data['User']['message'];
        $this->Session->write('Cart.User',$user);
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
            $this->set('data',$viewVars);
            //$this->Email->delivery = 'debug';
            $success = $this->Email->send();
            return $success;
        }

    }


    public function save_comment(){
        $this->autoRender = false;
        if($this->request->is('post')){
            if($this->Product->Comment->save($this->request->data)){
                $this->Session->setFlash(__('Your comment has been successfully saved, Thanks'),'default',array('class'=>'alert alert-success'));
            }else{
                $this->Session->setFlash(__('Your comment could not be saved, Please try again'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->redirect($this->referer());
    }

    public function size_guide(){}

    public function wish_list($product_id = null) {

        $this->loadModel('WishList');

        $user_id = $this->Session->read('Auth.User.id');

        if(!empty($product_id)){
            $this->autoRender = false;

            $wish_list = $this->WishList->find('first',array('conditions'=>array('product_id'=>$product_id ,'user_id'=>$user_id) ) );

            if(empty($wish_list)){
                if($this->WishList->save(array('product_id'=>$product_id ,'user_id'=>$user_id))){
                    $this->Session->setFlash(__('Product has been successfully added into Wish List, Thanks'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->referer());
                }

            }else{
                $this->Session->setFlash(__('This product is already exist in your Wish List'),'default',array('class'=>'alert alert-success'));
                $this->redirect('wish_list');
            }

        }else{
            $this->WishList->recursive = 2;
            $products = $this->WishList->find('all',array('conditions'=>array('WishList.user_id'=>$user_id ) ) );
            if(empty($products)){
                $this->Session->setFlash("Your Wish List is blank, Please add product to your Wish List",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('controller'=>'pages'));
            }else{
                $this->set('products',$products);
            }
        }
    }

    public function delete_wish_list($id){
        if($this->request->is('post')){
            $this->loadModel('WishList');
            if($this->WishList->delete($id)){
                $this->Session->setFlash(__('Product has been successfully deleted from Wish List'),'default',array('class'=>'alert alert-success'));
            }
            $this->redirect($this->referer());
        }
    }

    public function getSize($id){
        $this->loadModel('Size');
        $this->Size->recursive = -1;
        $size = $this->Size->findById($id);
        return $size;
    }

}



