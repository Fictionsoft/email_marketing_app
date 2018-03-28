<section><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3" id="reviews">
            <h2 class="title text-center">Login to your account</h2>
                <?php echo $this->Session->flash() ?>
                <div class="user_info"><!--login form-->
                    <?php
                    echo $this->Form->create('User');
                    echo $this->Form->input('username',array('type'=>'email','placeholder'=>'Email Address','label'=>'Email Address<em class="mandatory">*</em>'));
                    echo $this->Form->input('password',array('minlength'=>'6','placeholder'=>'******','label'=>'Password<em class="mandatory">*</em>'));
                    echo '<button type="submit" class="btn btn-default pull-right">Login</button>';
                    echo $this->Form->end();

                    echo '<br/>';
                    echo $this->Html->link('Forgot Password','/users/forgot_password');
                    ?>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#UserLoginForm').validate({

        });
    });
</script>