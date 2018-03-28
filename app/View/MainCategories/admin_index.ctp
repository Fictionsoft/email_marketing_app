
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"><h3>Main Category</h3></div>
        <div class="col-md-3 top_space">

            <?php echo $this->Form->create('MainCategory') ?>
                <div class="input-group custom-search-form">
                    <?php echo $this->Form->input('filter',array('placeholder'=>'Search...','class'=>'form-control','label'=>false) ) ?>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            <?php echo $this->Form->end() ?>

        </div>
        <div class="col-md-1 top_space">
            <?php
            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'mainCategories', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            ?>
        </div>
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/mainCategories/add',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>


	<table class="table table-hover">
	<thead>
	<tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('order'); ?></th>
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
    <?php $i = 1 ?>
	<?php foreach ($mainCategories as $mainCategory): ?>
	<tr>
		<td><?php echo $i ?>&nbsp;</td>
		<td><?php echo h($mainCategory['MainCategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($mainCategory['MainCategory']['order']); ?>&nbsp;</td>
        <td class="center"><?php echo $this->element('admin/toggle', array('status' => $mainCategory['MainCategory']['status'] )) ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mainCategory['MainCategory']['id'])); ?> &nbsp;
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mainCategory['MainCategory']['id']), array(), __('Are you sure you want to delete # %s?', $mainCategory['MainCategory']['id'])); ?>
		</td>
	</tr>
        <?php $i++ ?>
<?php endforeach; ?>
	</tbody>
	</table>
    <?php echo $this->element('admin/paging') ?>
</div>