<h3>Create Product</h3>
<?php
echo $this->Form->create('Product',array('type' =>'file'));
echo $this->element('../Products/elements');
echo$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary'));
