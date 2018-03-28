<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3" >
                <h2 class="title text-center">New User Signup!</h2>
                <?php echo $this->Session->flash() ?>
                <div class="signup-form">
                    <?php
                    echo $this->Form->create('User',array('url'=>'signup','type'=>'file'));
                    echo $this->element('../Users/front_elements');
                    echo '<button type="submit" class="btn btn-default pull-right">Signup</button>';
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

        jQuery('#UserSignupForm').validate({
            rules:{
                'data[User][email]': {
                    remote: {
                        url: BASE_URL+'users/is_user_available',
                        type: "post",
                        data: {
                            email: function(){ return jQuery("#UserEmail").val(); }
                        }
                    }
                },
                'data[User][confirm_password]': {
                    equalTo: "#UserPassword"
                }
            },
            messages: {
                'data[User][email]': {
                    remote: 'Email already used.'
                }
            }
        });
    });
</script>
