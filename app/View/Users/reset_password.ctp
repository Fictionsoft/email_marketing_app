<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="title text-center">Reset Password ?</h2>
                <?php echo $this->Session->flash() ?>
                <div class="login-form">
                    <?php
                     echo $this->Form->create('User');

                     echo $this->Form->input('password',array('minlength'=>'6','label'=>'Password <em class="mandatory">*</em>'));
                     echo $this->Form->input('confirm_password',array('minlength'=>'6','type'=>'password','required'=>true,'label'=>'Confirm Password <span class="star">*</span>'));
                     echo $this->Form->input('token',array('type'=>'hidden','value'=>$token));


                    echo '<button type="submit" class="btn btn-default pull-right">Submit</button>';
                    echo $this->Form->end();

                    echo '<br/>';
                    echo $this->Html->link('Click here to Login','/users/login');
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#UserResetPasswordForm').validate({
            rules:{
                'data[User][confirm_password]': {
                    equalTo: "#UserPassword"
                }
            },
            messages:{
                'data[User][confirm_password]':'Password did not match with confirm password'
            }
        });
    });
</script>







