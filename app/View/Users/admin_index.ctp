<div class="container-fluid">

    <div class="row">
        <div class="col-md-2"><h3>User List</h3></div>
        <div class="col-md-8 top_space">
            <?php echo $this->Form->create('User') ?>
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
            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'users', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            ?>
        </div>
    </div>
    <br>

    <div class="row">
        <?php echo $this->Form->create('EmailProcess',array('class'=>'JobAdminIndexForm','url' => '/admin/users/send_bulk_email')); ?>
        <div class="col-sm-3">
            <?php echo $this->Form->input('start',array('type'=>'number','min'=>0,'class'=>'form-control','required'=>'required', 'placeholder'=>'Start','div'=> false, 'label'=> false)); ?>
        </div>

        <div class="col-sm-3">
            <?php echo $this->Form->input('limit',array('type'=>'number','min'=>0,'class'=>'form-control','required'=>'required','placeholder'=>'End', 'div'=> false, 'label'=> false)); ?>
        </div>

        <div class="col-sm-4">
            <?php echo $this->Form->input('email_template_id',array('options'=>$get_templates, 'required'=>'required','empty'=>'Select Template','class'=>'form-control','id'=>'template-status', 'div'=> false, 'label'=> false)); ?>
        </div>

        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary">Send Email</button>
        </div>

        <?php echo $this->Form->end(); ?>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#EmailProcessAdminIndexForm').validate({

            });
        });
    </script>


    <br/>
</div>


<?php
// so we use the paginator object the shorter way.
// instead of using '$this->Paginator' everytime, we'll use '$paginator'
$paginator = $this->Paginator;

if(!empty($users)){

    //creating our table
    echo '<table class="table table-hover">';

    // our table header, we can sort the data user the paginator sort() method!
    echo "<tr>";
            echo "<th>#" .$paginator->sort('id'). "</th>";
            echo "<th>" . $paginator->sort('first_name') . "</th>";
            echo "<th>" . $paginator->sort('last_name') . "</th>";
            echo "<th>" . $paginator->sort('email') . "</th>";
            echo "<th>" . $paginator->sort('fb_link') . "</th>";
            echo "<th>" . $paginator->sort('status') . "</th>";
            echo '<th>Action</th>';
        echo "</tr>";

    $i=1;
    foreach( $users as $user ):
    echo "<tr>";
            echo "<td>{$user['User']['id']}</td>";
            echo "<td>{$user['User']['first_name']}</td>";
            echo "<td>{$user['User']['last_name']}</td>";
            echo "<td>{$user['User']['email']}</td>";
            echo "<td><a href=\"".$user['User']['fb_link']."\" target=\"_black\" /> {$user['User']['fb_link']} </a></td>";
        ?>
        <td class="center"><?php echo $this->element('admin/toggle', array('status' => $user['User']['is_email_sent'] )) ?>&nbsp;</td>


       <td>
           <?php
           /*// edit
           echo $this->Html->link(
               "View",
               array('action' => '/details', $user['User']['id'])
           );

           echo '&nbsp; &nbsp;';
           // edit
           echo $this->Html->link(
               "Edit",
               array('action' => '/update', $user['User']['id'])
           );*/

           echo '&nbsp; &nbsp;';
            // Delete
           echo $this->Form->postLink(
                'Delete',
                array('action' => '/delete', $user['User']['id']),
                array('confirm' => 'Are you sure you want to delete this User?')
            );
           ?>
        </td>

    <?php
      echo "</tr>";
        $i++;
        endforeach;
        unset($user);

    echo "</table>";

    ?>

    <?php echo $this->element('admin/paging') ?>

<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Record is not available !</div>';
}
?>



