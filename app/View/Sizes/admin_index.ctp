<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"><h3>Size List</h3></div>

        <div class="col-md-3 top_space">
            <?php echo $this->Form->create('Size') ?>
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
            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'sizes', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            ?>
        </div>
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/sizes/create',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>



<?php
$paginator = $this->Paginator;
if($sizes){
?>
    <table class="table table-hover">
    <tr>
        <th>#Id</th>
        <th><?php echo $paginator->sort('size')?></th>
        <th><?php echo $paginator->sort('order') ?></th>
        <th><?php echo $paginator->sort('status') ?></th>
        <th>Action</th>
    </tr>
    <?php
    $i=1;
    foreach( $sizes as $size ) {
    ?>
        <tr>
            <td><?php echo $i ?> </td>
            <td><?php echo $size['Size']['size'] ?></td>
            <td><?php echo $size['Size']['order'] ?></td>
            <td class="center"><?php echo $this->element('admin/toggle', array('status' => $size['Size']['status'] )) ?>&nbsp;</td>
            <td>
                <?php
                    // edit link
                    echo $this->Html->link("Edit", array('action' => 'update', $size['Size']['id'])).'&nbsp;&nbsp;';
                    //delete link
                    echo $this->Form->postLink('Delete', array('action' => 'delete', $size['Size']['id']),array('confirm' => 'Are you sure you want to delete this Size?'));
                ?>
            </td>
       </tr>
    <?php
        $i++;
    }
        unset($size);
    ?>
    </table>

    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>

    <div class="pagination">
        <ul>
            <?php
            if($paginator->hasPrev()){
                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            }

            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));

            if($paginator->hasNext()){
                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            }

            echo $paginator->last("Last");
            ?>
        </ul>
    </div>

<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Size is not available !</div>';
}
?>



