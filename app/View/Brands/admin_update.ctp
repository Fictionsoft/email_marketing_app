<h3>Update Brand</h3>
<?php
    echo $this->Form->create('Brand',array('type' => 'file'));
    echo $this->element('../Brands/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
?>