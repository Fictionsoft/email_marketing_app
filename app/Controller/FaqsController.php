<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 */
class FaqsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Faq->recursive = 0;
        if (!empty($this->data)) {
            $this->Session->write('FaqFilter', $this->data['Faq']);
        }
        $where = $this->__builtContentWhere();

        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );
		$this->set('faqs', $this->Paginator->paginate());
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Faq->create();
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash(__('The FAQ has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FAQ could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}

		$faqCategories = $this->Faq->FaqCategory->find('list',array('conditions'=>array('type'=>'General')));
		$this->set(compact('faqCategories'));
	}

    public function admin_change_category(){
        $type = $this->request->data['Faq']['type'];
        $faqCategories = $this->Faq->FaqCategory->find('list',array('conditions'=>array('type'=>$type)));
        $this->set(compact('faqCategories'));
    }
/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Faq->exists($id)) {
			throw new NotFoundException(__('Invalid FAQ'), 'default', array('class' => 'alert alert-danger'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash(__('The FAQ has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FAQ could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
			$this->request->data = $this->Faq->find('first', $options);
            $type = $this->data['FaqCategory']['type'];
			$this->request->data['Faq']['type'] = $type;
		}

		$faqCategories = $this->Faq->FaqCategory->find('list',array('conditions'=>array('type'=>$type)));
		$this->set(compact('faqCategories'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid FAQ'), 'default', array('class' => 'alert alert-danger'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Faq->delete()) {
			$this->Session->setFlash(__('The FAQ has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The FAQ could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function admin_reset()
    {
        if ($this->Session->check('FaqFilter')) {
            $this->Session->delete('FaqFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere()
    {
        $filter = null;
        $conditions = array();

        if ($this->Session->check('FaqFilter')) {
            $filter = $this->Session->read('FaqFilter.filter');
        }
        if (!empty($filter)) {
            $conditions = array('OR' => array(
                array('Faq.question LIKE' => '%' . $filter . '%'),
                array('Faq.answer LIKE' => '%' . $filter . '%'),
                array('FaqCategory.type LIKE' => '%' . $filter . '%'),
                array('FaqCategory.name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }

    public function index(){

        $this->set('title_for_layout','FAQ');
        $faq_categories = $this->Faq->FaqCategory->find('all',array('order'=>'FaqCategory.order asc'));
        $this->set('faq_categories',$faq_categories);
    }
}
