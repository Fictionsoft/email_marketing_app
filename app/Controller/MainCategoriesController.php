<?php
App::uses('AppController', 'Controller');
/**
 * MainCategories Controller
 *
 * @property MainCategory $MainCategory
 * @property PaginatorComponent $Paginator
 */
class MainCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->MainCategory->recursive = 0;
        if (!empty($this->data)) {
            $this->Session->write('Filter', $this->data['MainCategory']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' =>'order'
        );
		$this->set('mainCategories', $this->Paginator->paginate());
	}



/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MainCategory->create();
			if ($this->MainCategory->save($this->request->data)) {
				$this->Session->setFlash('The main category has been saved.','default',array('class'=>'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The main category could not be saved. Please, try again.','default',array('class'=>'alert alert-danger'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->MainCategory->exists($id)) {
            $this->Session->setFlash('Invalid main category','default',array('class'=>'alert alert-danger'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MainCategory->save($this->request->data)) {
				$this->Session->setFlash('The main category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The main category could not be saved. Please, try again.','default',array('class'=>'alert alert-danger'));

            }

		} else {
			$options = array('conditions' => array('MainCategory.' . $this->MainCategory->primaryKey => $id));
			$this->request->data = $this->MainCategory->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->MainCategory->id = $id;
		if (!$this->MainCategory->exists()) {
            $this->Session->setFlash('Invalid main category','default',array('class'=>'alert alert-danger'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MainCategory->delete()) {
			$this->Session->setFlash('The main category has been deleted.','default',array('class'=>'alert alert-success'));
            return $this->redirect(array('action' => 'index'));

        } else {
			$this->Session->setFlash('The main category could not be deleted. Please, try again.','default',array('class'=>'alert alert-danger'));
		}
	}


    public function admin_reset()
    {
        if ($this->Session->check('Filter')) {
            $this->Session->delete('Filter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('Filter')){
            $filter = $this->Session->read('Filter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('MainCategory.name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }
}
