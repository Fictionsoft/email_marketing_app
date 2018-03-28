<div class="payments form">
<?php echo $this->Form->create('Payment'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Payment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('payment_method_name');
		echo $this->Form->input('payment_method_code');
		echo $this->Form->input('status');
		echo $this->Form->input('vendor_email');
		echo $this->Form->input('vendor_name');
		echo $this->Form->input('vendor_password');
		echo $this->Form->input('transaction_mode');
		echo $this->Form->input('test_url');
		echo $this->Form->input('production_url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Payment.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Payment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Payments'), array('action' => 'index')); ?></li>
	</ul>
</div>
