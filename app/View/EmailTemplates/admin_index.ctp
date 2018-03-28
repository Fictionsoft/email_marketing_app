<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"><h3>Email Template List</h3></div>

        <!--<div class="col-md-3 top_space">
            <?php /*echo $this->Form->create('EmailTemplate') */?>
                <div class="input-group custom-search-form">
                    <?php /*echo $this->Form->input('filter',array('placeholder'=>'Search...','class'=>'form-control','label'=>false) ) */?>
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            <?php /*echo $this->Form->end() */?>
        </div>-->
        <!--<div class="col-md-2 top_space">
            <?php
/*            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'email_templates', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            */?>
        </div>-->
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/email_templates/create',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>


<?php
$paginator = $this->Paginator;
if($email_templates){
?>
    <table class="table table-hover">
    <tr>
        <th>#Id</th>
        <th><?php echo $paginator->sort('template_name')?></th>
        <th><?php echo $paginator->sort('subject')?></th>
        <!--<th><?php /*echo $paginator->sort('status') */?></th>-->
        <th>Action</th>
    </tr>
    <?php
    $i=1;
    foreach( $email_templates as $email_template ) {
    ?>
        <tr>
            <td><?php echo $i ?> </td>
            <td><?php echo $email_template['EmailTemplate']['template_name'] ?></td>
            <td><?php echo $email_template['EmailTemplate']['subject'] ?></td>
            <!--<td class="center"><?php /*echo $this->element('admin/toggle', array('status' => $email_template['EmailTemplate']['status'] )) */?>&nbsp;</td>-->
            <td>
                <?php
                    // edit link
                    echo $this->Html->link("Edit", array('action' => 'update', $email_template['EmailTemplate']['id'])).'&nbsp;&nbsp;';
                    //delete link
                    echo $this->Form->postLink('Delete', array('action' => 'delete', $email_template['EmailTemplate']['id']),array('confirm' => 'Are you sure you want to delete this EmailTemplate?'))."&nbsp;&nbsp";
                    
                ?>
            </td>
       </tr>
    <?php
        $i++;
    }
        unset($email_template);
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
    echo '<div class="alert alert-danger" role="alert">Email template is not available !</div>';
}
?>



