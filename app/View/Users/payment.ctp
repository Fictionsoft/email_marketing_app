<div class="user-form-container">
    <h4 class="text-center">Your Account Charge</h4>
    <?php echo $this->Html->image('/images/Secure-payment-with-Paypal.jpg', array('alt' => 'Pay now' ) ) ?>
    <p>Account Charge: $<?php echo $account_charge ?> USD </p>
    <?php
        echo $this->Form->create('User');
        echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Click here to pay','class'=>'btn btn-primary')).'</div>';
    ?>
</div>