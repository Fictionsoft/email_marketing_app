<?php
App::uses('AppModel', 'Model');
/**
 * Payment Model
 *
 */
class WishList extends AppModel {

    public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
    );

}
