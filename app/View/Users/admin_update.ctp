<h3>Edit User</h3>
<?php
    echo $this->Form->create('User',array('enctype' => 'multipart/form-data'));
    echo $this->element('../Users/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div><br/>';
?>