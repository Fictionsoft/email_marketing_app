<?php
App::uses('AppModel', 'Model');

class Size extends AppModel {

    public $validate = array(
        'size' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter size field'
        )
    );

    public function getSizes(){
        $sizes = $this->find('all',array('conditions'=>array('status'=>1),'order'=>'order'));
        return $sizes;
    }
}

