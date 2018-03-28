<h3>Update Category</h3>
<?php
    echo $this->Form->create('Category',array('type' => 'file'));
    echo $this->element('../Categories/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
?>