<?php
App::uses('AppModel', 'Model');
/**
 * Faq Model
 *
 * @property FaqCategory $FaqCategory
 */
class Faq extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'question';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'FAQ type is required',
                'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
		),'faq_category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'FAQ Category is required',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'question' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'FAQ question is required',
				'allowEmpty' => false,
				'required' => true
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'FAQ slug is required',
				'allowEmpty' => false,
			    'required' => true
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'unique' => array(
                'on'  => 'create',
                'rule'    => array('isUnique'),
                'message' => 'Slug is already used'
            ),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'FaqCategory' => array(
			'className' => 'FaqCategory',
			'foreignKey' => 'faq_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
