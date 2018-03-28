<?php
$dashboardUrl = array(
	'admin' => true,
    'plugin' =>false,
	'controller' => 'dashboards',
	'action' => 'dashboard',
);
?>
<header class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">

        <div class="header-university-logo">
            <?php //echo $this->Html->link($this->Html->image('admin/university-logo.png'), $dashboardUrl);
                $university = $this->Session->read('University');
            //echo $university['logo']; die;
                if(!empty($university['logo'])){
                    echo $this->Html->link($this->Html->image('../uploads/universities/'.$university['logo'],array('width' =>129, 'height' => 44)), $dashboardUrl);
                }else{

                    echo $this->Html->link($university['name'], $dashboardUrl);
                }
            ?>
        </div>

        <div class="header-right-side">
            <div class="header-southam-logo">
                <?php echo $this->Html->image('admin/southam-admin-logo.png'); ?>
            </div>

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

