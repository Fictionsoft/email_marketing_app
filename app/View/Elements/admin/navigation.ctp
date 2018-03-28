<nav class="navbar-inverse sidebar">
	<div class="navbar-inner">
        <div class="sidebar-menu-heading">
            <?php echo $this->Html->image('admin/menu-heading.png'); ?>
        </div>
        <?php
            echo $this->Croogo->adminMenus(CroogoNav::items(), array(
                'htmlAttributes' => array(
                    'id' => 'sidebar-menu',
                ),
            ));
        ?>
	</div>
</nav>