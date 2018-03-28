<div class="payments view">
<h2><?php echo __('Payment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Method Name'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['payment_method_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Method Code'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['payment_method_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor Email'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['vendor_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor Name'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['vendor_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor Password'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['vendor_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Mode'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['transaction_mode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Test Url'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['test_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Production Url'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['production_url']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment'), array('action' => 'edit', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment'), array('action' => 'delete', $payment['Payment']['id']), array(), __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?> </li>
	</ul>
</div>
