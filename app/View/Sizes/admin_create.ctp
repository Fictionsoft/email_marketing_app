<h3>Create Size</h3>
<?php
echo $this->Form->create('Size',array('type' =>'file'));
echo $this->element('../Sizes/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
