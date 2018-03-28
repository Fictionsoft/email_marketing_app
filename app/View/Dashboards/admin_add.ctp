<div class="dashboards form">
    <h3>Create Dashboard</h3>
	<?php
        echo $this->Form->create('Dashboard',array('type'=>'file'));
        echo $this->element('../Dashboards/elements');
        echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
	?>
</div>

