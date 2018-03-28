<div class="dashboard_title">
    <h2>Dashboard</h2>
</div>

<div class="dashboards index">
  <div class="dashboard-container-quick-icon">
    <div class="quick-icon">
      <?php foreach ($dashboards as $dashboard): ?>
      <div class="icon"> <a href="<?php echo $this->base.'/admin/'. h($dashboard['Dashboard']['url']); ?>">
		<?php
            $image_name = '../uploads/dashboards/'.$dashboard['Dashboard']['image'];
            echo $this->Html->image($image_name,array('width' => 48, 'height' => 48));
        ?>
        <span><?php echo h($dashboard['Dashboard']['name']); ?></span> </a> </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
