<?php
App::uses('AppController', 'Controller');


class SizesController extends AppController {
    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    /**
     * @param null
     * @return null
     */
    public function admin_index() {
        if(!empty($this->data)){
            $this->Session->write('SizeFilter', $this->request->data['Size']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('order' => 'asc')
        );

        $sizes = $this->paginate('Size');

        $this->set('sizes',$sizes);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {
        if ($this->request->is('post')) {
            $this->Size->create();
            $this->request->data['Size']['date_created'] = date("Y-m-d H:i:s");

            if ($this->Size->save($this->request->data)) {
                $this->Session->setFlash("Size has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate Size_package table

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

        $Size= $this->Size->findById($id);
        if (!$Size) {
            throw new NotFoundException(__('Invalid request !'));
        }

        if ($this->request->is(array('Size', 'put'))) {
           $this->Size->id = $id;
           $this->request->data['Size']['date_updated'] = date("Y-m-d H:i:s");
           if ($this->Size->save($this->request->data)) {
                $this->Session->setFlash("Size has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $Size;
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

        if ($this->Size->delete($id)) {
            $this->Session->setFlash("Size #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('SizeFilter')){
            $this->Session->delete('SizeFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('SizeFilter')){
           $filter = $this->Session->read('SizeFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('Size.Size LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }


    public function video_Sizes(){
        $where = array('status'=>1);
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $Sizes = $this->paginate('Size');
        if($Sizes){
            $this->set('Sizes',$Sizes);
        }else{
            $this->Session->setFlash("Size could not found",'default',array('class'=>'alert alert-danger'));
        }
    }
}