<section id="form">
    <div class="login-form">

    <h2 class="title h4">Change Password</h2>
    <?php echo $this->Session->flash() ?>
        <?php
        echo $this->Form->create('User');
        echo $this->Form->input('current_password',array('type'=>'password','minlength'=>'6','class'=>'form-control','label'=>'Current Password<em class="mandatory">*</em>'));
        echo $this->Form->input('password',array('type'=>'password','minlength'=>'6','class'=>'form-control','label'=>'Password<em class="mandatory">*</em>'));
        echo $this->Form->input('confirm_password',array('type'=>'password','minlength'=>'6','class'=>'form-control form-group','label'=>'Confirm Password<em class="mandatory">*</em>'));
        echo '<button type="submit" class="btn btn-primary">Submit</button>';
        echo $this->Form->end();

        ?>
    </div>

</section>

<script type="text/javascript">
    jQuery(document).ready(function(){

        jQuery('#UserChangePasswordForm').validate({

            rules:{
                'data[User][confirm_password]': {
                    equalTo: "#UserConfirmPassword"
                }
            },
            messages:{
                'data[User][confirm_password]':'Password did not match with confirm password'
            }

        });
    });
</script>

