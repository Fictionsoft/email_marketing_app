<?php
App::uses('AppController', 'Controller');

class EmailTemplatesController extends AppController {


    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');
    //public $uses = array('EmailTemplate');

    /*public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }*/

    /**
     * @param null
     * @return null
     */
    public function admin_index() {
        //$this->autoRender = false;
        if(!empty($this->data)){
            $this->Session->write('EmailTemplateFilter', $this->request->data['EmailTemplate']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $email_templates = $this->paginate('EmailTemplate');
        $this->loadModel('EmailTemplate');
        //$email_templates = $this->EmailTemplate->find('all');die;

        $this->set('email_templates',$email_templates);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {
        if ($this->request->is('post')) {

            // START : File upload
            $image = $this->request->data['EmailTemplate']['image'];

            if ($image['name']) {
                $result = $this->FileHandler->uploadImage($image);
                if ($result) {
                    $image = $this->FileHandler->_uploadimgname;
                }else {
                    $image = '';
                }
            }else{
                $image = '';
            }
            $this->request->data['EmailTemplate']['image'] = $image;
            //END: file upload


            $this->EmailTemplate->create();

            if ($this->EmailTemplate->save($this->request->data)) {
                $this->Session->setFlash("Email template has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate EmailTemplate_package table

        }
    }

    /**
     * @param null $id
     * @return null
     */
    public function admin_update($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid request !'));
        }

        $email_template= $this->EmailTemplate->findById($id);

        //pr($email_template); die;

        if (!$email_template) {
            throw new NotFoundException(__('Invalid request !'));
        }

        if ($this->request->is(array('EmailTemplate', 'put'))) {
           $this->EmailTemplate->id = $id;

            // START : File upload
            $image = $this->request->data['EmailTemplate']['image'];

            if ($image['name']) {
                $result = $this->FileHandler->uploadImage($image);
                if ($result) {
                    $image = $this->FileHandler->_uploadimgname;
                }else {
                    $image = '';
                }
            }else{
                $image = '';
            }
            $this->request->data['EmailTemplate']['image'] = $email_template['EmailTemplate']['image'];
            //END: file upload


           if ($this->EmailTemplate->save($this->request->data)) {
                $this->Session->setFlash("Email template has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $email_template;
        }
    }


    /**
     * @param null $id
     * @return redirect to index
     */
    public function admin_delete($id = null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->EmailTemplate->delete($id)) {
            $this->Session->setFlash("Email Template #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('EmailTemplateFilter')){
            $this->Session->delete('EmailTemplateFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('EmailTemplateFilter')){
           $filter = $this->Session->read('EmailTemplateFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('EmailTemplate.name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }

    public function admin_details($id = null){
        $template  = $this->EmailTemplate->findById($id);
        $this->set('template', $template);

    }



}