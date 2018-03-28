<h3>Update Email Template</h3>
<?php
    echo $this->Form->create('EmailTemplate',array('type' => 'file'));
    echo $this->element('../EmailTemplates/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
?>