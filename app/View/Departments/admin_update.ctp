<h3>Update Department</h3>
<?php
    echo $this->Form->create('Department',array('type' => 'file'));
    echo $this->element('../Departments/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
?>