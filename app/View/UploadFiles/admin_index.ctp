<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"><h3>Upload File List</h3></div>

        <!--<div class="col-md-3 top_space">
            <?php /*echo $this->Form->create('UploadFile') */?>
                <div class="input-group custom-search-form">
                    <?php /*echo $this->Form->input('filter',array('placeholder'=>'Search...','class'=>'form-control','label'=>false) ) */?>
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            <?php /*echo $this->Form->end() */?>
        </div>
        <div class="col-md-2 top_space">
            <?php
/*            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'uploadFiles', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            */?>
        </div>-->

        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/uploadFiles/create',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>


<?php
$paginator = $this->Paginator;
if($upload_files){
?>
    <table class="table table-hover">
    <tr>
        <th>#Id</th>
        <th><?php echo $paginator->sort('name')?></th>
        <th><?php echo $paginator->sort('created','Create Date') ?></th>
        <th>Action</th>
    </tr>
    <?php
    $i=1;
    foreach( $upload_files as $upload_file ) {
    ?>
        <tr>
            <td><?php echo $i ?> </td>
            <td>
                <?php echo $this->Html->link($upload_file['UploadFile']['name'], array('controller'=>'users', 'action' => 'set_file_id', $upload_file['UploadFile']['id'])).'&nbsp;&nbsp;'; ?>
            </td>
            <td class="center"><?php echo $this->Common->getDate( $upload_file['UploadFile']['created'] );?>&nbsp;</td>
            <td>
                <?php
                    // edit link
                    //echo $this->Html->link("Edit", array('action' => 'update', $upload_file['UploadFile']['id'])).'&nbsp;&nbsp;';
                    //delete link
                    echo $this->Form->postLink('Delete', array('action' => 'delete', $upload_file['UploadFile']['id']),array('confirm' => 'Are you sure you want to delete this UploadFile?'));
                ?>
            </td>
       </tr>
    <?php
        $i++;
    }
        unset($upload_file);
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
    echo '<div class="alert alert-danger" role="alert">File is not available !</div>';
}
?>



