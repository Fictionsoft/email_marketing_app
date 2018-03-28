<?php
App::uses('AppModel', 'Model');

class Comment extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'className' => 'User'
        )
    );

    public $validate = array(
        'comment' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter comment field'
        )
    );
}

