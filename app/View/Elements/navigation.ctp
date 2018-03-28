<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="col-md-2">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="<?php echo $this->Html->url('/')?>">
                <?php echo $this->Html->image('/images/logo.png', array('alt' => 'Online Shopping')) ?>
            </a>
        </div>

        <div class="col-md-10">
            <div style="text-align: right;">
                <form action="" method="post">
                    <input type="text" style="width:200px;background:#D0E9C6"/>
                    <input type="submit" name="submit" value="Search"/>
                </form>
            </div>
            <ul class="nav navbar-nav">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li><a href="<?php echo $this->Html->url('/') ?>" class="page-scroll"><button type="button" class="btn btn-success navbar-btn">Home</button></a></li>
                <li><a href="<?php echo $this->Html->url('/') ?>" class="page-scroll"><button type="button" class="btn btn-success navbar-btn">Men</button></a></li>
                <li><a href="<?php echo $this->Html->url('/') ?>" class="page-scroll"><button type="button" class="btn btn-success navbar-btn">Wemen</button></a></li>
                <li><a href="<?php echo $this->Html->url('/') ?>" class="page-scroll"><button type="button" class="btn btn-success navbar-btn">Electronics</button></a></li>
                <li><a href="<?php echo $this->Html->url('/pages/home') ?>/#about" class="page-scroll"><button type="button" class="btn btn-success navbar-btn">About</button></a></li>
                <li><a href="<?php echo $this->Html->url('/pages/home') ?>/#contact" class="page-scroll"><button type="button" class="btn btn-success navbar-btn">Contact</button></a></li>

                <?php if($this->Session->check('Auth.User')){?>
                    <li><a href="<?php echo $this->Html->url('/users/my_profile');?>"><button type="button" class="btn btn-success navbar-btn">My Profile</button></a></li>
                    <li><a href="<?php echo $this->Html->url('/users/logout');?>" ><button type="button" class="btn btn-success navbar-btn">Sign out</button></a></li>
                <?php }else{?>
                    <li><a href="<?php echo $this->Html->url('/users/signup');?>" ><button type="button" class="btn btn-success navbar-btn">Sign up</button></a></li>
                    <li><a href="<?php echo $this->Html->url('/users/login');?>" ><button type="button" class="btn btn-success navbar-btn">Sign in</button></a></li>
                <?php }?>
            </ul>

        </div>
    </div>
</nav>
