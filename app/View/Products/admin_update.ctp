<h3>Update Products</h3>
<?php
    echo $this->Form->create('Product',array('type' => 'file'));
    echo $this->element('../Products/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end(array('label'=>'Update','class'=>'btn btn-primary'));
?>