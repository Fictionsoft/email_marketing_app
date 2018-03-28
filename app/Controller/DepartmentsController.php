<?php
App::uses('AppController', 'Controller');

class DepartmentsController extends AppController {
    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');
    //public $uses = array('Department');

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
            $this->Session->write('DepartmentFilter', $this->request->data['name']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('name' => 'asc')
        );

        $departments = $this->paginate('Department');
        $this->loadModel('Department');
        //$departments = $this->Department->find('all');die;

        $this->set('departments',$departments);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {
        if ($this->request->is('post')) {
            $this->Department->create();
            $this->request->data['Department']['date_created'] = date("Y-m-d H:i:s");

            if ($this->Department->save($this->request->data)) {
                $this->Session->setFlash("Department has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate Department_package table

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

        $Department= $this->Department->findById($id);
        $this->log($Department,'debug');

        if (!$Department) {
            throw new NotFoundException(__('Invalid request !'));
        }

        if ($this->request->is(array('Department', 'put'))) {
           $this->Department->id = $id;
           $this->request->data['Department']['date_updated'] = date("Y-m-d H:i:s");
           if ($this->Department->save($this->request->data)) {
                $this->Session->setFlash("Department has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $Department;
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

        if ($this->Department->delete($id)) {
            $this->Session->setFlash("Department #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('DepartmentFilter')){
            $this->Session->delete('DepartmentFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('DepartmentFilter')){
           $filter = $this->Session->read('DepartmentFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('Department.name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }


    
}