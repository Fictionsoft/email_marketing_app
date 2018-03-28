<?php $site_name = $this->requestAction('settings/setting'); ?>
<?php $left_navigation = $this->requestAction('dashboards/dashboard_links'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title> <?php echo $site_name.': '. $this->fetch('title'); ?> </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css(array(
        'admin_style',
        'bootstrap.min',
        'plugins/metisMenu/metisMenu.min',
        'plugins/timeline',
        'sb-admin-2',
        'admin_custom',
        'plugins/morris',
        'font-awesome.min'
    ));


    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo "\n" . '<script type="text/javascript">var BASE_URL = \'' . $this->Html->url('/', true) . '\';</script>';
    echo "\n" . '<script type="text/javascript">var CONTROLLER = \'' . $this->name . '\';</script>';
    echo "\n" . '<script type="text/javascript">var ACTION = \'' . $this->action . '\';</script>';
    echo $this->fetch('script');
    echo $this->Html->script('jquery-1.11.0');
    echo $this->Html->script('jquery.validate.js');
    echo $this->Html->script('inflection');
    echo $this->Html->script('custom_admin');

    ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href=""></a>-->
            <?php
            echo $this->Html->link($site_name,Router::url('/',true),array('class' => 'navbar-brand') );
            ?>

        </div>

        <div class="email_subscription">
            <?php echo $this->Form->create('User',array('class'=>'email_sub_form','url' => '/admin/users/email_subscription')); ?>
            <div class="col-sm-3"  style="margin-top: 10px;">
                <?php echo $this->Form->input('email',array('class'=>'form-control','required'=>'required', 'placeholder'=>'Email','div'=> false, 'label'=> false)); ?>
            </div>
            <div class="col-sm-2"  style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <?php
            /*
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
                */
            ?>
            <?php
            if($this->Session->check('Auth.User')) {
                ?>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="<?php /*echo Router::url('/users/my_profile',true) */?>"><i class="fa fa-user fa-fw"></i>My Profile</a></li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo Router::url('/users/logout',true) ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        <li><a href="<?php echo Router::url('/users/change_password',true) ?>"><i class="fa fa-sign-out fa-fw"></i> Change Password</a></li>
                    </ul>
                </li>

            <?php } ?>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php echo $this->base;?>/admin/dashboards/display" class="<?php echo ($this->params['controller']=='dashboards' AND $this->params['action']=='admin_display')?'active':'' ?>"><i class="fa fa-wrench fa-fw"></i> Dashboard <span class="fa arrow"></span></a>
                    </li>

                    <?php
                    if(!empty($left_navigation)){
                        foreach($left_navigation as $navigation){
                            ?>
                            <li><a href="<?php echo $this->base.'/admin/'.$navigation['Dashboard']['url'] ?>" class="<?php echo ($this->params['controller']==$navigation['Dashboard']['url'])?'active':'' ?>"><i class="fa fa-wrench fa-fw"></i><?php echo $navigation['Dashboard']['name'] ?><span class="fa arrow"></span></a></li>
                    <?php
                        }
                    }
                    ?>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <?php echo $this->Session->flash(); ?>
                <?php
                echo $this->fetch('content'); ?>
                <br/>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php echo $this->element('sql_dump'); ?>

<?php
echo $this->Html->script(
    array(
        'bootstrap.min',
        'plugins/metisMenu/metisMenu.min',
        'sb-admin-2'
    )
);

echo $this->Js->writeBuffer();
?>
</body>
</html>
