
<div class="form-group"><?php echo $this->Form->input('category_id',array('options'=>$categories,'empty'=>'--Select--','class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('brand_id',array('options'=>$brands,'empty'=>'--Select--','class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('condition',array('options'=>array("new"=>"New","old"=>"Old" ),'class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('availability',array('options'=>array("in stock"=>"In stock","not in stock"=>"Not in stock" ),'class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('name',array('class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('slug',array('class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('price',array('class'=>'form-control')) ?></div>
<div class="form-group"><?php echo $this->Form->input('description',array('class'=>'form-control')) ?></div>
<?php if(!empty($this->request->data['Product']['id'])){ ?>
    <div class="form-group"><?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$this->data['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','width'=>'150')) ?></div>
<?php } ?>
<div class="form-group"><?php echo $this->Form->input('cover_photo',array('label'=>'Photo','type'=>'file')) ?></div>
<div class="form-group is-publish"><?php echo $this->Form->input('status') ?></div>



















