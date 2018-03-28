
<section id="cart_items">
    <div class="container">
        <div class="row">
            <?php echo $this->element('categories') ?>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description"></td>
                                    <td class="price">Price</td>
                                    <td class="quantity">Quantity</td>
                                    <td class="total">Total</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $products = $cart['Products'] ?>
                                <?php if($products):?>
                                    <?php $total_amount = 0; ?>
                                    <?php foreach($products as $product): ?>
                                    <tr>
                                        <td class="cart_product">
                                            <a href="<?php echo $this->Html->url('/products/details/'.$product['Product']['slug']) ?>">
                                                <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','width'=>'150')) ?>
                                            </a>
                                        </td>
                                        <td class="cart_description">
                                            <h4>
                                                <a href="<?php echo $this->Html->url('/products/details/'.$product['Product']['slug']) ?>"><?php echo $product['Product']['name'] ?> </a>
                                            </h4>
                                            <?php echo (!empty($product['Product']['size']))?'<div>Size: '.$product['Product']['size'].'</div>':'' ?>
                                        </td>
                                        <td class="cart_price">
                                            <p><?php echo $product['Product']['price'] ?> Tk</a></p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $product['Product']['quantity'] ?>" autocomplete="off" size="2" readonly>
                                            </div>
                                        </td>
                                        <?php $total_amount += $product['Product']['quantity'] * $product['Product']['price']; ?>
                                        <td class="cart_total">
                                            <p class="cart_total_price"><?php echo number_format( $product['Product']['quantity'] * $product['Product']['price'] ) ?> Tk</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" href="<?php echo $this->Html->url('/products/delete_cart_item/'.$product['Product']['id']) ?>"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>

                                    <tr>
                                        <td class="cart_description" colspan="4" style="text-align: right">
                                            <h4>Total Amount:</h4>
                                        </td>
                                        <td class="cart_description">
                                            <h4><?php echo number_format( $total_amount ) ?> Tk</h4>
                                        </td>
                                    </tr>
                                <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="chose_area">
                            <?php $user = $this->Session->read('Auth') ?>
                            <div>Hi, <?php echo $user['User']['first_name'].' '.$user['User']['first_name'] ?></div>
                            <p><i>Your order will be placed into the following address</i></p>
                            <div><?php echo $user['User']['address_line1'].', '.$user['User']['address_line2'] ?></div>
                            <div><?php echo $user['User']['city'].'-'.$user['User']['country'] ?></div>
                            <div><?php echo $user['User']['email'] ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Cart Sub Total <span>$59</span></li>
                                <li>Eco Tax <span>$2</span></li>
                                <li>Shipping Cost <span>Free</span></li>
                                <li>Total <span>$61</span></li>
                            </ul>
                            <a class="btn btn-default check_out" href="#">Check Out</a>
                            <a class="btn btn-default check_out" href="<?php echo $this->Html->url('/') ?>">Continious Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-offset-2">
                <div class="heading">
                    <h3>Would you like to do order now?</h3>
                    <p>Just select your payment method and submit to confirm your order</p>
                </div>
                <div class="login-form">
                    <?php
/*                    echo $this->Form->create('User',array('url'=>'/products/order_submit'));
                    echo $this->Form->input('payment_method',array('options'=>array('bKash'=>'bKash','Cash on delivery'=>'Cash on delivery' ) ) );
                    echo $this->Form->input('message',array('type'=>'textarea', 'placeholder'=>'I need small size') );

                    echo '<button type="submit" class="btn btn-default">Submit Order</button>';
                    echo $this->Form->end();
                    */?>
                </div>
            </div>
        </div>
    </div>
</section>-->