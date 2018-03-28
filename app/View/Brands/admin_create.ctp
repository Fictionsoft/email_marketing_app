<h3>Create Brand</h3>
<?php
echo $this->Form->create('Brand',array('type' =>'file'));
echo $this->element('../brands/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
