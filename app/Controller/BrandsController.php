<?php
App::uses('AppController', 'Controller');


class BrandsController extends AppController {


    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');
    //public $uses = array('Brand');

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
            $this->Session->write('BrandFilter', $this->request->data['Brand']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $brands = $this->paginate('Brand');
        $this->loadModel('Brand');
        //$brands = $this->Brand->find('all');die;

        $this->set('brands',$brands);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {
        if ($this->request->is('post')) {
            $this->Brand->create();

            if ($this->Brand->save($this->request->data)) {
                $this->Session->setFlash("Brand has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate Brand_package table

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

        $brand= $this->Brand->findById($id);

        if (!$brand) {
            throw new NotFoundException(__('Invalid request !'));
        }

        if ($this->request->is(array('Brand', 'put'))) {
           $this->Brand->id = $id;

           if ($this->Brand->save($this->request->data)) {
                $this->Session->setFlash("Brand has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $brand;
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

        if ($this->Brand->delete($id)) {
            $this->Session->setFlash("Brand #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('BrandFilter')){
            $this->Session->delete('BrandFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('BrandFilter')){
           $filter = $this->Session->read('BrandFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('Brand.name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }



}