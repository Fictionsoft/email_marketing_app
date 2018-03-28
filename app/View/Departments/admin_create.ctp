<h3>Create Department</h3>
<?php
echo $this->Form->create('Department',array('type' =>'file'));
echo $this->element('../Departments/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
