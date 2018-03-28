<div class="dashboards view">
<h2><?php echo __('Dashboard'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Super Admin'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['super_admin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['admin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($dashboard['Dashboard']['weight']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dashboard'), array('action' => 'edit', $dashboard['Dashboard']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dashboard'), array('action' => 'delete', $dashboard['Dashboard']['id']), array(), __('Are you sure you want to delete # %s?', $dashboard['Dashboard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dashboards'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dashboard'), array('action' => 'add')); ?> </li>
	</ul>
</div>
