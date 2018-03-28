<h3>Add User</h3>
<?php
echo $this->Form->create('User',array('enctype' => 'multipart/form-data'));
echo $this->element('../Users/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
