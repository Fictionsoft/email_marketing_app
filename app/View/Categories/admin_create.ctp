<h3>Create Category</h3>
<?php
echo $this->Form->create('Category',array('type' =>'file'));
echo $this->element('../Categories/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
