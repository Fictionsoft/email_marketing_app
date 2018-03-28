<?php
if(empty($this->request->data['User']['id']))
    $readonly = false;
else
    $readonly = true;

echo $this->Form->input('first_name',array('label'=>'First Name<em class="mandatory">*</em>'));
echo $this->Form->input('last_name',array('label'=>'Last Name<em class="mandatory">*</em>'));
echo $this->Form->input('phone',array('label'=>'Phone<em class="mandatory">*</em>'));
echo $this->Form->input('address_line1',array('label'=>'Address line1<em class="mandatory">*</em>'));
echo $this->Form->input('address_line2',array('label'=>'Address line2<em class="mandatory">*</em>'));
echo $this->Form->input('city',array('label'=>'City<em class="mandatory">*</em>'));
echo $this->Form->input('country');
echo $this->Form->input('post',array('label'=>'Post Code'));

echo $this->Form->input('email',array('readonly'=>$readonly,'label'=>'Email<em class="mandatory">*</em>'));

if(!isset($this->request->data['User']['id'])){
echo $this->Form->input('password',array('minlength'=>'6','label'=>'Password<em class="mandatory">*</em>'));
echo $this->Form->input('confirm_password',array('minlength'=>'6','type'=>'password','label'=>'Confirm Password<me class="mandatory">*</me>'));
}

?>