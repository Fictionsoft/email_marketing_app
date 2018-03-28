<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"><h3>Category List</h3></div>

        <div class="col-md-3 top_space">

            <?php echo $this->Form->create('Category') ?>
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
        <div class="col-md-2 top_space">
            <?php
            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'categories', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            ?>
        </div>
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/categories/create',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>



<?php
$paginator = $this->Paginator;
if($Categories){
?>
    <table class="table table-hover">
    <tr>
        <th>#Id</th>
        <th><?php echo $paginator->sort('MainCategory.name', 'Main Category')?></th>
        <th><?php echo $paginator->sort('name', 'Category')?></th>
        <th><?php echo $paginator->sort('slug') ?></th>
        <th><?php echo $paginator->sort('order') ?></th>
        <th><?php echo $paginator->sort('status') ?></th>
        <th>Action</th>
    </tr>
    <?php
    $i=1;
    foreach( $Categories as $Category ) {
    ?>
        <tr>
            <td><?php echo $i ?> </td>
            <td><?php echo $Category['MainCategory']['name'] ?></td>
            <td><?php echo $Category['Category']['name'] ?></td>
            <td><?php echo $Category['Category']['slug'] ?></td>
            <td><?php echo $Category['Category']['order'] ?></td>
            <td class="center"><?php echo $this->element('admin/toggle', array('status' => $Category['Category']['status'] )) ?>&nbsp;</td>
            <td>
                <?php
                    // edit link
                    echo $this->Html->link("Edit", array('action' => 'update', $Category['Category']['id'])).'&nbsp;&nbsp;';
                    //delete link
                    echo $this->Form->postLink('Delete', array('action' => 'delete', $Category['Category']['id']),array('confirm' => 'Are you sure you want to delete this Category?'));
                ?>
            </td>
       </tr>
    <?php
        $i++;
    }
        unset($Category);
    ?>
    </table>

    <?php echo $this->element('admin/paging') ?>

<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Category is not available !</div>';
}
?>



