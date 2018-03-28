<div class="dashboards form">
    <h3>Update Dashboard</h3>
    <?php
        echo $this->Form->create('Dashboard',array('type'=>'file'));
        echo $this->element('../Dashboards/elements');
        echo $this->Form->input('id');
        echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';
    ?>
</div>