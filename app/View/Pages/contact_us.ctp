<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="contact-form">
                <h2 class="title text-center">Get In Touch</h2>
                <?php echo $this->Session->flash() ?>

                <div class="status alert alert-success" style="display: none"></div>
                <?php echo $this->Form->create('contact',array('url'=>'/users/contact')) ?>
                    <div class="form-group col-md-6">
                        <?php echo $this->Form->input('name',array('required'=>true,'placeholder'=>'Name','label'=>false,'class'=>'form-control',)) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo $this->Form->input('email',array('required'=>true,'placeholder'=>'Email','label'=>false,'class'=>'form-control',)) ?>
                    </div>
                    <div class="form-group col-md-12">
                        <?php echo $this->Form->input('subject',array('required'=>true,'placeholder'=>'Subject','label'=>false,'class'=>'form-control',)) ?>
                    </div>
                    <div class="form-group col-md-12">
                        <?php echo $this->Form->input('message',array('type'=>'textarea','rows'=>'8','required'=>true,'placeholder'=>'Your Message Here','label'=>false,'class'=>'form-control','div'=>false,'style'=>'height:200px;')) ?>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                    </div>
                <?php echo $this->Form->end() ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="contact-info">
                <h2 class="title text-center">Contact Info</h2>
                <address>
                    <p>Client name</p>
                    <p>Plot no:23,1445, Gulshan</p>
                    <p>Dhaka-1212</p>
                    <p>Mobile: <?php //echo Configure::read('Company.phone') ?></p>
                    <p>Email: <?php //echo Configure::read('Company.email') ?></p>
                </address>
                <div class="social-networks">
                    <h2 class="title text-center">Social Networking</h2>
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->

<?php echo $this->Html->script('gmaps') ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<?php echo $this->Html->script('contact') ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#contactContactUsForm').validate({

        });
    });
</script>