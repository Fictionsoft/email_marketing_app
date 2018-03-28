
<div class="form-group"><?php echo $this->Form->input('template_name',array('class'=>'form-control','required'=>'required')) ?></div>
<div class="form-group"><?php echo $this->Form->input('url',array('class'=>'form-control','required'=>'required')) ?></div>
<div class="form-group"><?php echo $this->Form->input('subject',array('class'=>'form-control','required'=>'required')) ?></div>
<div class="form-group"><?php echo $this->Form->input('message',array('class'=>'form-control','required'=>'required')) ?></div>
<div class="form-group"><?php echo $this->Form->input('special_note',array('class'=>'form-control','required'=>'required')) ?></div>

<?php
    //pr($this->request->data['EmailTemplate']); die;
?>
<?php if(!empty($this->request->data['EmailTemplate']['id'])){ ?>
    <div class="form-group"><?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$this->data['EmailTemplate']['image'],'dir'=>'emailtemplates' ) ), array('alt' => 'Email template image','width'=>'150')) ?></div>
<?php } ?>
<div class="form-group"><?php echo $this->Form->input('image',array('type'=>'file')) ?></div>
<div class="form-group is-publish"><?php echo $this->Form->input('status') ?></div>

