<?php
App::uses('AppModel', 'Model');

class Product extends AppModel {

    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        ),
        'Brand' => array(
            'className' => 'Brand',
            'foreignKey' => 'brand_id'
        )
    );

    public $hasMany = array(
        'Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'product_id'
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'product_id',
            'order'=>array('Comment.id'=>'DESC')
        )
    );

    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter name field'
        ),
        'slug' => array(
            'slug' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter slug field'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Please chose another slug'
            ),
        )
    );
}

