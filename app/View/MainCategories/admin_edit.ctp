
<h3>Create Main Category</h3>
<?php echo $this->Form->create('MainCategory',array('type' =>'file')) ?>
<?php include('element.ctp') ?>
<?php echo $this->Form->input('id') ?>
<?php echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>'; ?>


