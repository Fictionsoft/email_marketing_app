<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"><h3>Dashboard List</h3></div>
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/dashboards/add',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>


<?php
    $paginator = $this->Paginator;
    if($dashboards){
?>
    <table class="table table-hover">
        <tr>
            <th>#Id</th>
            <th><?php echo $paginator->sort('name') ?></th>
            <th><?php echo $paginator->sort('url') ?></th>
            <th><?php echo $paginator->sort('image') ?></th>
            <th><?php echo $paginator->sort('order') ?></th>
            <th><?php echo $paginator->sort('status') ?></th>
            <th>Action</th>
        </tr>
    <?php
    $i=1;
    foreach( $dashboards as $dashboard ){
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $dashboard['Dashboard']['name'] ?></td>
            <td><?php echo $dashboard['Dashboard']['url'] ?></td>
            <td><?php echo $this->Html->image("/uploads/dashboards/" . $dashboard['Dashboard']['image'], array('alt' => 'Photo','width'=>'50')) ?></td>
            <td><?php echo $dashboard['Dashboard']['order'] ?></td>
            <td class="center"><?php echo $this->element('admin/toggle', array('status' => $dashboard['Dashboard']['status'] )) ?>&nbsp;</td>
            <td>
                <?php
                // edit
                echo $this->Html->link(
                    "Edit",
                    array('action' => '/edit', $dashboard['Dashboard']['id'])
                );

                echo '&nbsp; &nbsp;';
                // Delete
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => '/delete', $dashboard['Dashboard']['id']),
                    array('confirm' => 'Are you sure?')
                );
                ?>
            </td>
        </tr>
        <?php
        $i++;
    }
    unset($dashboard);
    ?>
    </table>
    <?php echo $this->element('admin/paging') ?>

<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Record is not available !</div>';
}
?>

