<?php
    $User = $data['User'];
    $Products = $data['Products'];

   // $this->log($User,'debug');
?>

<p>Hello,Smartshoppers Admin</p>
<p>An order has been submitted by <strong><?php echo $User['first_name'].' '.$User['first_name'] ?></strong></p>
<div>Phone:<?php echo $User['phone'] ?></div>
<div>Email:<a href="mailto:<?php echo $User['email'] ?>"><?php echo $User['email'] ?></a></div>
<div>Payment Method:<?php echo $User['payment_method'] ?></div>
<div><i><?php echo $User['message'] ?></i></div>
<br>
<br>
<h3>Order Summary</h3>
<table width="100%">
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
    <?php if($Products):?>
        <?php $total_amount = 0; ?>
        <?php foreach($Products as $product): ?>
            <tr>
                <td class="cart_product">
                    <a href="<?php echo Router::url('/products/details/'.$product['Product']['slug'], true) ?>">

                        <img src="<?php echo Router::url('/uploads/products/'.$product['Product']['cover_photo'],true) ?>" alt="Product" width="150"/>
                        <?php /*echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','width'=>'150')) */?>
                    </a>
                </td>
                <td class="cart_description">
                    <h4><a href="<?php echo Router::url('/products/details/'.$product['Product']['slug'], true) ?>"><?php echo $product['Product']['name'] ?></a></h4>
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


<br/>
<br/>
<br/>

<p>Thanks</p>
<div>Regards,</div>
<div><?php echo $site_name ?> Team</div>