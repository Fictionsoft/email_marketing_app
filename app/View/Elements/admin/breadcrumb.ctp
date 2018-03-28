<?php
$crumbs = $this->Html->getCrumbs(
	$this->Html->tag('span', '', array(
		'class' => 'breadcrumb-separator',
	))
);
?>
<?php if ($crumbs): ?>
<div id="breadcrumb-container" class="span12 visible-desktop">
	<div class="breadcrumb">
		<?php echo $crumbs; ?>
	</div>

    <?php if (isset($primaryTabs)): ?>
    <div class="admin-menu-tab">
        <ul class="tabs primary">
            <?php
            foreach($primaryTabs AS $tabs){
                $activeClass = '';
                if($tabs['active'] == 1){
                    $activeClass = ' class="active" ';
                }
                echo ' <li'.$activeClass.'><a '.$activeClass.' href="' . $tabs['link'] . '">'. $tabs['text'] .'</a></li>';
            }
            ?>
        </ul>
    </div>
    <?php endif; ?>

</div>
<?php endif; ?>
