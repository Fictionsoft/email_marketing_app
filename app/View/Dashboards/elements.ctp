
<div class="form-group"><?php echo $this->Form->input('name',array('class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('url',array('class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('order',array('class'=>'form-control')) ?></div>
<?php if(!empty($this->request->data['Dashboard']['id'])){ ?>
    <?php $image = ($this->data['Dashboard']['image'])?'../uploads/dashboards/'.$this->data['Dashboard']['image'].'':'/img/default_photo.png'; ?>
    <div class="form-group"><?php echo $this->Html->image($image,array('alt' => 'Dashboard','width'=>'150')) ?></div>
<?php } ?>
<div class="form-group"><?php echo $this->Form->input('image',array('label' => 'Image', 'type'=>'file')) ?></div>
<div class="form-group is-publish"><?php echo $this->Form->input('status') ?></div>
