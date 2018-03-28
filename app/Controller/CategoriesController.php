<?php
App::uses('AppController', 'Controller');


class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index','categories','categories_list'));
    }

    /**
     * @param null
     * @return null
     */
    public function admin_index() {
        if(!empty($this->data)){
            $this->Session->write('CategoryFilter', $this->request->data['Category']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' =>'Category.order'
        );

        $Categories = $this->paginate('Category');

        $this->set('Categories',$Categories);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {
        if ($this->request->is('post')) {

            $this->Category->create();
            $this->request->data['Category']['date_created'] = date("Y-m-d H:i:s");
            $this->loadModel('CategorySize');
            if ($this->Category->saveAll($this->request->data)) {
                $this->Session->setFlash("Category has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate Category_package table

        }
        $this->loadModel('Size');
        $this->loadModel('MainCategory');

        $this->set(array(
            'sizes'=>$this->Size->getSizes(),
            'main_categories'=>$this->MainCategory->getMainCategories()
        ));
    }

    /**
     * @param null $id
     * @return null
     */
    public function admin_update($id = null) {

        $category = $this->Category->findById($id);
        if (empty($category)) {
            $this->Session->setFlash('Category is not exist!, Please select a category to edit','default',array('class'=>'alert alert-danger'));
            $this->redirect('index');
        }

        $this->loadModel('Size');
        $this->loadModel('CategorySize');
        $this->loadModel('MainCategory');

        if ($this->request->is(array('Category', 'put'))) {

            // start cover photo up
            $photo = $this->request->data['Category']['photo'];
            if ($photo['name']) {
                $result = $this->FileHandler->uploadImage($photo);
                if ($result) {
                    $this->request->data['Category']["photo"] = $this->FileHandler->_uploadimgname;
                }else {
                    $this->request->data['Category']["photo"] = '';
                }
            }else{
                $this->request->data['Category']["photo"] = $category['Category']['photo'];
            }
            // end cover photo up

           $this->Category->id = $id;
           $this->CategorySize->deleteAll(array('CategorySize.category_id' => $id), false);
           if ($this->Category->saveAll($this->request->data)) {
                $this->Session->setFlash("Category has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }else{
            $this->request->data = $category;
        }


        $sizes = $this->Size->getSizes();
        $existing_sizes = $this->CategorySize->getAssignedSizes($id);

        $this->set(array(
            'sizes' => $sizes,
            'existing_sizes' => $existing_sizes,
            'main_categories'=>$this->MainCategory->getMainCategories()
        ));

    }


    /**
     * @param null $id
     * @return redirect to index
     */
    public function admin_delete($id = null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Category->delete($id)) {
            $this->Session->setFlash("Category #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('CategoryFilter')){
            $this->Session->delete('CategoryFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('CategoryFilter')){
           $filter = $this->Session->read('CategoryFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('Category.name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }


    public function categories(){
        //$this->Category->recursive = -1;
        $categories = $this->Category->MainCategory->find('all', array('conditions'=>array('status'=>1),'order'=>'order' ) );
        if($categories){
            return $categories;
        }
    }

    public function categories_list(){
        $this->Category->recursive = -1;
        $categories = $this->Category->find('list', array('conditions'=>array('status'=>1),'order'=>'name' ) );
        if($categories){
            return $categories;
        }
    }


}