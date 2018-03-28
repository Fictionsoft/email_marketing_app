<h3>Update Size</h3>
<?php
    echo $this->Form->create('Size',array('type' => 'file'));
    echo $this->element('../Sizes/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
?>