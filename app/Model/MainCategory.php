<?php
App::uses('AppModel', 'Model');
/**
 * FaqCategory Model
 *
 * @property Faq $Faq
 */
class MainCategory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */


	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty')
			)
		)
	);

	public $hasMany = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'main_category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public function getMainCategories(){
        $categories = $this->find('list',array('conditions'=>array('status'=>1),'order'=>'name'));
        return $categories;
    }

}
