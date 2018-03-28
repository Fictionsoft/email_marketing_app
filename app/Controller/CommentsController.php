<?php
App::uses('AppController', 'Controller');


class CommentsController extends AppController {
    public $uses = array('Comment','Category');
    public $helpers = array('Html', 'Form', 'Currency');
    public $components = array('Auth','Session','Common', 'FileHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }

    /**
     * @param null
     * @return null
     */
    public function admin_index() {
        $where = $this->__builtContentWhere();
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $videos = $this->paginate('Video');
        $this->set('videos',  $videos);
    }

    /**
     * @param null
     * @return null
     */
    public function admin_create() {

        $this->set('Categories',$this->Category->find('list'));

        if ($this->request->is('post')) {

            // START : cover photo upload
            $cover_photo = $this->request->data['Video']['cover_photo'];
            if ($cover_photo['name']) {
                $result = $this->FileHandler->uploadImage($cover_photo);
                if ($result) {
                    $this->request->data['Video']["cover_photo"] = $this->FileHandler->_uploadimgname;
                }else {
                    $this->request->data['Video']["cover_photo"] = '';
                }
            }else{
                $this->request->data['Video']["cover_photo"] = '';
            }
            //END: cover photo upload


            // START : video upload
            $video = $this->request->data['Video']['video'];
            if ($video['name']) {
                $result = $this->FileHandler->uploadVideo($video);

                if ($result) {
                    $this->request->data['Video']["video"] = $this->FileHandler->_uploadimgname;
                }else {
                    $this->request->data['Video']["video"] = '';
                }
            }else{
                $this->request->data['Video']["video"] = '';
            }
            //END: video upload


            //pr($this->data);die;
            $this->Video->create();
            $this->request->data['Video']['date_created'] = date("Y-m-d H:i:s");

            if ($this->Video->save($this->request->data)) {
                $this->Session->setFlash("Video has been successfully added",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));

            // populate Video_package table
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

        $Video= $this->Video->findById($id);
        if (!$Video) {
            throw new NotFoundException(__('Invalid request !'));
        }


        if ($this->request->is(array('Video', 'put'))) {

            // start cover photo up
            $cover_photo = $this->request->data['Video']['cover_photo'];
            if ($cover_photo['name']) {
                $result = $this->FileHandler->uploadImage($cover_photo);
                if ($result) {
                    $this->request->data['Video']["cover_photo"] = $this->FileHandler->_uploadimgname;
                }else {

                    $this->request->data['Video']["cover_photo"] = '';
                }
            }else{
                $this->request->data['Video']["cover_photo"] = $Video['Video']['cover_photo'];
            }
            // end cover photo up



            // start video up
            $video = $this->request->data['Video']['video'];
            if ($video['name']) {
                $result = $this->FileHandler->uploadVideo($video);
                if ($result) {
                    $this->request->data['Video']["video"] = $this->FileHandler->_uploadimgname;
                }else {

                    $this->request->data['Video']["video"] = '';
                }
            }else{
                //$options = array('conditions' => array($this->Video->primaryKey => $this->request->data['Video']['id']));
                //$Video = $this->Video->findById($this->request->data['Video']['id']);
                $this->request->data['Video']["video"] = $Video['Video']['video'];
            }
            // end video up


           $this->Video->id = $id;
           if ($this->Video->save($this->request->data)) {
                $this->Session->setFlash("Video has been updated.",'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'admin_index'));
           }

            $this->Session->setFlash("Unable to update !",'default',array('class'=>'alert alert-danger'));
        }

        if (!$this->request->data) {
            $this->request->data = $Video;
            $this->set('Categories',$this->Category->find('list'));
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

        if ($this->Video->delete($id)) {
            $this->Session->setFlash("Video #$id has been successfully deleted !",'default',array('class'=>'alert alert-success'));

            $this->redirect(array('action' => 'admin_index'));
        }
    }

    public function admin_reset(){
        if($this->Session->check('VideoFilter')){
            $this->Session->delete('VideoFilter');
        }
        $this->redirect('index');
    }


    public function __builtContentWhere(){
        $filter = null;
        $conditions = array();

        if($this->Session->check('VideoFilter')){
           $filter = $this->Session->read('VideoFilter.filter');
        }
        if(!empty($filter)){
            $conditions = array('OR' => array(
                array('Video.name LIKE' => '%' . $filter . '%'),
                array('Video.slug LIKE' => '%' . $filter . '%'),
                array('Video.price LIKE' => '%' . $filter . '%'),
                array('Video.Video_type LIKE' => '%' . $filter . '%')
            ));
        }

        return $conditions;
    }

    /*
     * Video list
     */
    public function video_list($category_id=null){
        $where = array('Video.status'=>1,'Video.category_id'=>$category_id);
        $this->paginate = array(
            'conditions' => $where,
            'limit' => 30,
            'order' => array('id' => 'desc')
        );

        $videos = $this->paginate('Video');

        if($videos){
            $this->set('Videos',  $videos);
        }else{
            $this->Session->setFlash("Video could not found",'default',array('class'=>'alert alert-danger'));
        }
    }


    /**
     * @param null $slug
     */
    public function play_video($slug = null) {
        $video = $this->Video->findBySlug($slug);
        $this->set('video',$video);
    }

    /*
     * post comment
     */
    public function post_comment(){
            $this->Comment->create();
            $this->request->data['Comment']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Comment']['date_created'] = date("Y-m-d H:i:s");
            $this->request->data['Comment']['status'] = 1;

            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash("Comment has been successfully posted",'default',array('class'=>'alert alert-success'));
                $this->redirect($this->referer());
            }

            $this->Session->setFlash("Unable to save !",'default',array('class'=>'alert alert-danger'));
    }



}



