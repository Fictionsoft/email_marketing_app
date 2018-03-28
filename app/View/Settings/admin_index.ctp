<h3>Settings</h3>
<?php
echo $this->Form->create('Setting');
if($settings) {
    $i = 0;
    foreach($settings as $setting){
        echo '<div class="form-group">
            '.$this->Form->input( $setting['Setting']['key'], array('name'=>'data[Setting]['.$i.'][value]', 'value'=>$setting['Setting']['value'], 'class'=>'form-control','required'=>true)).'
            </div>';
        echo $this->Form->input('id', array('name'=>'data[Setting]['.$i.'][id]', 'value'=>$setting['Setting']['id'], 'type'=>'hidden' ) ) ;
        $i++;
    }
}
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>';

?>
