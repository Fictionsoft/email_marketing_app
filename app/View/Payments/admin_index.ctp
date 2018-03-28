<div class="payments index">
	<h2><?php echo __('Payments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method_name'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method_code'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_email'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_name'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_password'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_mode'); ?></th>
			<th><?php echo $this->Paginator->sort('test_url'); ?></th>
			<th><?php echo $this->Paginator->sort('production_url'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['title']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['payment_method_name']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['payment_method_code']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['status']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['vendor_email']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['vendor_name']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['vendor_password']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['transaction_mode']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['test_url']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['production_url']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['id']), array(), __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?></li>
	</ul>
</div>
