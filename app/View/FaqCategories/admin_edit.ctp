
<h3>Create FAQ Category</h3>
<?php echo $this->Form->create('FaqCategory',array('type' =>'file')) ?>
<?php include('element.ctp') ?>
<?php echo $this->Form->input('id') ?>
<?php echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';?>


