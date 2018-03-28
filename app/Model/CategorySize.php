<?php
App::uses('AppModel', 'Model');

class CategorySize extends AppModel {
    /*public $belongsTo = array(
        'Size' => array(
            'className' => 'Size',
            'foreignKey' =>'size_id'
        )
    );*/
    public $validate = array(

    );

    /**
     * @param null $id
     * @return array
     */
    public function getAssignedSizes($id=null){
        $sizes = $this->find( 'all',array( 'fields'=>'id,size_id', 'conditions'=>array( 'category_id'=>$id ) ) );

        return $sizes;
    }
}

?>