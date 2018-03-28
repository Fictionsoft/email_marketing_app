<div class="checkout_page_content">
    <div class="order_total_summary">
            <?php echo $this->Form->create('contact')?>
                <!--start cc-->
                <div id="payment_section" class="checkout_block payment-method-form">
                    <div class="checkout_block_header"><h2>Contact Us</h2></div>
                    <div class="checkout_block_content">
                        <div class="payment_method_confirmation">
                              <div class="payment-method-list">

                                <div class="payment-method-item payment-method-item-credit-card">

                                    <div class="payment-method-credit-card-form">
                                        <ul>
                                            <li><label>Full name:<em>*</em></label><?php echo $this->Form->input('full_name', array('required' => 'true', 'class' => 'validate[required] text-input','label'=>false, 'div'=>false)); ?></li>
                                            <li><label>Email:<em>*</em></label><?php echo $this->Form->input('email', array('required' => 'true', 'class' => 'validate[required] text-input','label'=>false, 'div'=>false)); ?></li>
                                            <li><label>Subject:<em>*</em></label><?php echo $this->Form->input('subject', array('required' => 'true', 'class' => 'validate[required] text-input','label'=>false, 'div'=>false)); ?></li>
                                            <li><label>Message:<em>*</em></label><?php echo $this->Form->input('message', array('required' => 'true','type'=>'textarea', 'class' => 'validate[required] text-input','label'=>false, 'div'=>false)); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

        <div class="order_total_summary_right">
            <?php echo $this->Form->submit('Submit',array('id' => 'proceed-to-checkout-btn')); ?>
        </div>
        <div class="clear"></div>
    </div>

</div>