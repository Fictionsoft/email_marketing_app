<?php
App::uses('AppController', 'Controller');
/**
 * Dashboards Controller
 *
 * @property Dashboard $Dashboard
 * @property PaginatorComponent $Paginator
 */
class DashboardsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','FileHandler');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('dashboard_links');
    }


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
        $this->paginate = array(
           'order'=>'order'
        );
		$this->set('dashboards', $this->paginate('Dashboard'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Dashboard->exists($id)) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		$options = array('conditions' => array('Dashboard.' . $this->Dashboard->primaryKey => $id));
		$this->set('dashboard', $this->Dashboard->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {

		if ($this->request->is('post')) {
            $file = $this->request->data['Dashboard']['image'];
            if ($file['name']) {
                $result = $this->FileHandler->uploadImage($file);
                if ($result) {
                    $this->request->data['Dashboard']["image"] = $this->FileHandler->_uploadimgname;
                }
                else {
                    $this->request->data['Dashboard']["image"] = '';
                }
            }
            else{
                $this->request->data['Dashboard']["image"] = '';
            }
            //END: File Upload

			$this->Dashboard->create();
			if ($this->Dashboard->save($this->request->data)) {
                $this->Session->setFlash("The dashboard has been saved.",'default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash("The dashboard could not be saved. Please, try again.",'default',array('class'=>'alert alert-danger'));
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
		if (!$this->Dashboard->exists($id)) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		if ($this->request->is(array('post', 'put'))) {

            $file = $this->request->data['Dashboard']['image'];
            if ($file['name']) {
                $result = $this->FileHandler->uploadImage($file);
                if ($result) {
                    $this->request->data['Dashboard']["image"] = $this->FileHandler->_uploadimgname;
                }else {

                    $this->request->data['Dashboard']["image"] = '';
                }
            }else{
                $options = array('conditions' => array($this->Dashboard->primaryKey => $this->request->data['Dashboard']['id']));
                $dashboard = $this->Dashboard->find('first', $options);
                $this->request->data['Dashboard']["image"] = $dashboard['Dashboard']['image'];
            }

			if ($this->Dashboard->save($this->request->data)) {
                $this->Session->setFlash("The dashboard has been saved.",'default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
                $this->Session->setFlash("The dashboard could not be saved. Please, try again.",'default',array('class'=>'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Dashboard.' . $this->Dashboard->primaryKey => $id));
			$this->request->data = $this->Dashboard->find('first', $options);
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
		$this->Dashboard->id = $id;
		if (!$this->Dashboard->exists()) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Dashboard->delete()) {
            $this->Session->setFlash("The dashboard has been deleted.",'default',array('class'=>'alert alert-danger'));
		} else {
            $this->Session->setFlash("The dashboard could not be deleted. Please, try again.",'default',array('class'=>'alert alert-success'));

		}
		return $this->redirect(array('action' => 'index'));
	}

    public function admin_display(){
        $dashboards = $this->Dashboard->find('all',array('conditions'=>array('status'=>1),'order'=>'order'));

        if(isset($this->params['requested']) and $this->params['requested']==1){
            return $dashboards;
        }

        $this->set('dashboards',$dashboards);
    }


    public function dashboard_links(){
        $dashboards = $this->Dashboard->find('all',array('conditions'=>array('status'=>1),'order'=>'order'));

        if(isset($this->params['requested']) and $this->params['requested']==1){
            return $dashboards;
        }
    }
}
