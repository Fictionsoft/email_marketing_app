<div class="features_items">
    <?php $categories = $this->requestAction('products/index') ?>
    <?php if(!empty($categories)){
        foreach($categories as $category){
            if(!empty($category['Product'])) {
                echo '<h2 class="title text-center" >'.$category['Category']['name'].'</h2>';
                echo '<div class="row">';
                $total_products = count($category['Product']);
                $i = 0;
                foreach($category['Product'] as $product) {
                    if($i%4==0 and $i!=0){
                        echo '</div><div class="row">';
                    }
                    ?>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="<?php echo $this->Html->url('/products/details/'.$product['slug'] ) ?>">
                                            <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','class'=>'img-responsive')) ?>
                                        </a>
                                        <h2><?php echo number_format($product['price'] ) ?> Tk</h2>
                                        <p><?php echo implode(' ', array_slice(explode(' ', $product['name']), 0, 3)) ?></p>
                                        <a href="<?php echo $this->Html->url('/products/details/'.$product['slug'] ) ?>" class="btn btn-default add-to-cart"><i class="fa fa-arrow-circle-o-right"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    $i++;
                }
                echo '</div>';
            }
        }
    }
    ?>
</div>

