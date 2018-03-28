
<section id="cart_items">
    <div class="container">
        <div class="row">
            <?php echo $this->element('categories') ?>
            <div class="col-sm-9">
                <?php echo $this->Session->flash() ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if(!empty($products)) { ?>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description">Category</td>
                                    <td class="price">Price</td>
                                    <td class="action-align" colspan="2">Action</td>
                                </tr>
                                </thead>
                                <tbody>

                                    <?php //pr($products) ?>

                                    <?php foreach($products as $product): ?>

                                        <tr>
                                            <td class="cart_product">
                                                <a href="<?php echo $this->Html->url('/products/details/'.$product['Product']['slug']) ?>">
                                                    <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','width'=>'150')) ?>
                                                </a>
                                            </td>

                                            <td class="cart_description">
                                                <?php echo $product['Product']['Category']['name'] ?>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">
                                                <?php echo $product['Product']['price'] ?> Tk</a>
                                                </p>
                                            </td>
                                            <td class="cart_quantity">
                                                <a href="<?php echo $this->Html->url('/products/details/'.$product['Product']['slug']) ?>"> View Details</a>
                                            </td>
                                            <td class="cart_delete">
                                                <?php echo $this->Form->postLink('Delete',array('action' => 'delete_wish_list', $product['WishList']['id']),array('confirm'=>'Are you sure?'));?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <?php }else{
                            echo '<div class="alert alert-warning">Product is not available in your wish list, Click <a href="<?php echo $this->Html->url('/')">here</a> to add product</div>';
                        }
                        ?>
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