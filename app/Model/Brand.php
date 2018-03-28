<?php
App::uses('AppModel', 'Model');

class Brand extends AppModel{

    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter name field'
        )
    );

    public function getBrands(){
        $brands = $this->find('list',array('conditions'=>array('status'=>1),'order'=>'name'));
        return $brands;
    }
}

