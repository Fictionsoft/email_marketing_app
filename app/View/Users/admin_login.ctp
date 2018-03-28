<div class="users form">
    <br/>
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
        <legend><?php echo __('Admin Login'); ?></legend>
        <div class="form-group"><?php echo $this->Form->input('username',array('required'=>true,'type'=>'email','class'=>'form-control','label'=>'Email Address <em class="mandatory">*</em>')); ?></div>
        <div class="form-group"><?php echo $this->Form->input('password',array('required'=>true,'class'=>'form-control','label'=>'Psswords <em class="mandatory">*</em>')); ?></div>
    <br/>
   <?php echo $this->Form->end(array('label'=>'Login','class'=>'btn btn-primary'));?>

</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#UserAdminLoginForm').validate({
            rules:{
                'data[User][username]':{
                    email:true
                }
            }
        });
    });
</script>