<?php
if(empty($this->request->data['User']['id']))
    $readonly = false;
else
    $readonly = true;

echo '<div class="form-group">'.$this->Form->input('first_name',array('label'=>'First Name <span>*</span>','class'=>'form-control','required'=>true)).'</div>';
echo '<div class="form-group">'.$this->Form->input('last_name',array('label'=>'Last Name <span>*</span>','class'=>'form-control','required'=>true)).'</div>';
echo '<div class="form-group">'.$this->Form->input('phone',array('label'=>'Phone <span>*</span>','class'=>'form-control','required'=>true)).'</div>';
echo '<div class="form-group">'.$this->Form->input('address_line1',array('label'=>'Address <span>*</span>','class'=>'form-control','required'=>true)).'</div>';

/*echo '<div class="form-group">'.$this->Form->input('address_line2',array('label'=>'Address Line 2','class'=>'form-control')).'</div>';
echo '<div class="form-group">'.$this->Form->input('city',array('label'=>'City/Suburb/Town <span>*</span>','class'=>'form-control','required'=>true)).'</div>';
echo '<div class="form-group">'.$this->Form->input('state',array('label'=>'State/Province <span>*</span>','class'=>'form-control','required'=>true)).'</div>';
echo '<div class="form-group">'.$this->Form->input('zip',array('label'=>'Post/Zip Code <span>*</span>','class'=>'form-control','required'=>true)).'</div>';
echo '<div class="form-group">'.$this->Form->input('country',array('label'=>'Country','options'=>$countries,'class'=>'form-control','required'=>false)).'</div>';*/


echo '<div class="form-group">'.$this->Form->input('email',array('label'=>'Email *','type' =>'email','class'=>'form-control','readonly'=>$readonly)).'</div>';

if(empty($this->request->data['User']['id'])) {
    echo '<div class="form-group">'.$this->Form->input('password',array('label'=>'Password *','type' =>'password','class'=>'form-control')).' <span class="number_note">Ex: At last 6 characters</span></div>';
    echo '<div class="form-group">'.$this->Form->input('confirm_password',array('label'=>'Confirm Password *','type' =>'password','class'=>'form-control')).'</div>';
}

/*if(!empty($this->request->data['User']['id'])){
    echo '<div class="form-group">'.$this->Html->image($this->element( 'user_photo_selector', array( 'photo'=>$this->data['User']['photo'] ) ), array('alt' => 'Profile Photo','width'=>'150')).'</div>';
}

echo '<div class="form-group">'.$this->Form->input('photo',array('type' =>'file','name' =>'data[User][photo]')).'</div>';*/



if($this->params['prefix'] == 'admin'){
    echo '<div class="form-group is-publish">'.$this->Form->input('status').'</div>';
}

