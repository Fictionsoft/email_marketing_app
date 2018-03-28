<?php
$dashboardUrl = array(
	'admin' => true,
    'plugin' =>false,
	'controller' => 'dashboards',
	'action' => 'dashboard',
);
?>
<header class="navbar navbar-inverse navbar-fixed-top super-admin-nav-bar">
	<div class="navbar-inner">

        <div class="header-university-logo">
            <?php echo $this->Html->link($this->Html->image('admin/southam_super_admin_logo.png'), $dashboardUrl); ?>
        </div>

        <div class="header-right-side">
            <?php if ($this->Session->read('Auth.User.id')): ?>
                <ul class="nav pull-right">
                    <li>
                        <a href="#">
                            <?php echo __d('croogo', "You are logged in as: <span>%s</span>", $this->Session->read('Auth.User.username')); ?>
                        </a>
                    </li>
                    <li>
                        <?php echo $this->Html->link($this->Html->image('admin/log-out.png'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')); ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
	</div>
</header>

