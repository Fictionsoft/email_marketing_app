<h3>Update Upload File</h3>
<?php
    echo $this->Form->create('UploadFile',array('type' => 'file'));
    echo $this->element('../UploadFiles/elements');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
?>