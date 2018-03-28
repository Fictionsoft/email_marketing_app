<?php
App::uses('AppController', 'Controller');


class UploadFilesController extends AppController {


    public $helpers = array('Html', 'Form', 'Currency','Common');
    public $components = array('Auth','Session','Common', 'FileHandler','EmailHandler');
    public $uses = array('UploadFile','User');

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow(array(''));
    }

    /**
     * @param null
     * @return null
     */
    public function admin_index() {
        //$this->autoRender = false;
        if(!empty($this->data)){
            $this->Session->write('UploadFileFilter', $this->request->data['UploadFile']);
        }
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $upload_files = $this->paginate('UploadFile');
        $this->loadModel('UploadFile');
        //$uploadFiles = $this->UploadFile->find('all');die;

        $this->set('upload_files',$upload_files);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {
        if ($this->request->is('post')) {

            // START : File upload
            $document = $this->request->data['UploadFile']['file_name'];

            if ($document['name']) {

                if( pathinfo($document['name'], PATHINFO_EXTENSION) == 'txt' ){
                    $result = $this->FileHandler->uploadfile($document);

                }else{
                    $this->Session->setFlash("Please upload txt tile !",'default',array('class'=>'alert alert-warning'));
                    $this->redirect(array('action' => 'admin_index'));
                    exit();
                }
                if ($result) {
                    $document = $this->FileHandler->_uploadimgname;
                }else {
                    $document = '';
                }
            }else{
                $document = '';
            }
            $this->request->data['UploadFile']['file_name'] = $document;
            //END: file upload


            $this->UploadFile->create();

            if ($this->UploadFile->save($this->request->data)) {
                $this->admin_process_file($this->UploadFile->getInsertID(), $document);

                $this->Session->setFlash("File has been successfully uploaded",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate UploadFile_package table

        }
    }

    // Start: Save file of data uploaded
    function admin_process_file($upload_file_id, $file_name){
        $file_path = WWW_ROOT.'uploads' . DS . 'uploadfiles' . DS. $file_name;

        $array = $this->EmailHandler->fileToArray($file_path, $upload_file_id);

        if($array){
            $this->saveFileData($array);
        }

    }

    function saveFileData($array) {
        $users = array();
        $i=1;
        foreach($array as $key => $value){
            $validate = $this->EmailHandler->is_user_available($value['email']);
            if($validate['status']){
                //$array[$key]['in_invalid'] = 1;
                $users[] = $value;
            }
            
            if($i%500==0) sleep(10);
        }

        $this->User->create();
        $this->User->saveAll($users);
    }
    // End: Save file of data uploaded


    /**
     * @param null $id
     * @return null
     */
    public function admin_update($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid request !'));
        }

        $upload_file= $this->UploadFile->findById($id);
        //$this->log($upload_file,'debug');

        if (!$upload_file) {
            throw new NotFoundException(__('Invalid request !'));
        }

        if ($this->request->is(array('UploadFile', 'put'))) {
           $this->UploadFile->id = $id;
           if ($this->UploadFile->save($this->request->data)) {
                $this->Session->setFlash("UploadFile has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $upload_file;
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

        if ($this->UploadFile->delete($id)) {
            $this->Session->setFlash("UploadFile #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('UploadFileFilter')){
            $this->Session->delete('UploadFileFilter');
        }
        $this->redirect('index');
    }

    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('UploadFileFilter')){
           $filter = $this->Session->read('UploadFileFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('UploadFile.file_name LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }


    public function video_UploadFile(){
        $where = array('status'=>1);
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $upload_file = $this->paginate('UploadFile');
        if($upload_file){
            $this->set('UploadFile',$upload_file);
        }else{
            $this->Session->setFlash("Upload File could not found",'default',array('class'=>'alert alert-danger'));
        }
    }
}