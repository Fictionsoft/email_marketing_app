<?php
    echo $this->Form->input('type',array('options'=>array('General'=>'General', 'Payment'=>'Payment'),'empty'=>'--SELECT--','class'=>'form-control'));
?>
<span id="LoadingAjax" style="display:none"><?php echo $this->Html->image('ajax-loader.gif')?></span>
<?php
echo $this->Form->input('faq_category_id',array('class'=>'form-control','label'=>'FAQ Category','div'=>array('id'=>'faq-category-id')));
echo $this->Form->input('question',array('class'=>'form-control'));
echo $this->Form->input('slug',array('class'=>'form-control'));
echo $this->Form->input('answer',array('class'=>'form-control'));
?>
<div class="form-group is_publish"> <?php echo $this->Form->input('status' ) ?></div>
<?php
echo $this->Ajax->observeField('FaqType',
    array(
        'url' => array('controller' => 'faqs', 'action' => 'change_category'),
        'update'    => 'faq-category-id',
        'indicator' => 'LoadingAjax'
    )
);
?>