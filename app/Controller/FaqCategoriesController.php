<?php
App::uses('AppController', 'Controller');
/**
 * FaqCategories Controller
 *
 * @property FaqCategory $FaqCategory
 * @property PaginatorComponent $Paginator
 */
class FaqCategoriesController extends AppController {

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
		$this->FaqCategory->recursive = 0;
        if (!empty($this->data)) {
            $this->Session->write('Filter', $this->data['FaqCategory']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' =>'order'
        );
		$this->set('faqCategories', $this->Paginator->paginate());
	}



/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->FaqCategory->create();
			if ($this->FaqCategory->save($this->request->data)) {
				$this->Session->setFlash('The faq category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The faq category could not be saved. Please, try again.','default',array('class'=>'alert alert-danger'));
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
		if (!$this->FaqCategory->exists($id)) {
            $this->Session->setFlash('Invalid faq category','default',array('class'=>'alert alert-danger'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FaqCategory->save($this->request->data)) {
				$this->Session->setFlash('The faq category has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The faq category could not be saved. Please, try again.','default',array('class'=>'alert alert-danger'));

            }

		} else {
			$options = array('conditions' => array('FaqCategory.' . $this->FaqCategory->primaryKey => $id));
			$this->request->data = $this->FaqCategory->find('first', $options);
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
		$this->FaqCategory->id = $id;
		if (!$this->FaqCategory->exists()) {
            $this->Session->setFlash('Invalid faq category','default',array('class'=>'alert alert-danger'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FaqCategory->delete()) {
			$this->Session->setFlash('The faq category has been deleted.','default',array('class'=>'alert alert-success'));
            return $this->redirect(array('action' => 'index'));

        } else {
			$this->Session->setFlash('The faq category could not be deleted. Please, try again.','default',array('class'=>'alert alert-danger'));
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
                array('FaqCategory.name LIKE' => '%' . $filter . '%'),
                array('FaqCategory.type LIKE' => '%' . $filter . '%'),
            ));
        }

        return $conditions;
    }
}
