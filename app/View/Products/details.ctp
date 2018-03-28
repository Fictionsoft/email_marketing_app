<section>
    <div class="container">
        <div class="row">
            <?php echo $this->element('categories') ?>
            <div class="col-sm-9 padding-right">
                <?php echo $this->Session->flash() ?>
                <?php echo $this->Form->create('Product',array('url'=>'cart/'.$product['Product']['id'])) ?>
                    <div class="product-details">
                        <div class="col-sm-7">
                            <h4><?php echo $product['Product']['name'] ?></h4>
                            <div class="full product-view">
                                <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','class'=>'img-responsive')) ?>
                            </div>
                            <br/>
                            <div class="previews product-type">
                                <span style="cursor: pointer" data-full="<?php echo $this->base.'/'.$this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ) ?>" class="view-large">
                                    <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('title' => 'Click me!','alt'=>'Thumbnail','width'=>'100')) ?>
                                </span>

                                <?php if(!empty($product['Photo'])): ?>
                                    <?php $i=1; foreach($product['Photo'] as $photo): ?>
                                        <?php if($i<4): ?>
                                        <span style="cursor: pointer" data-full="<?php echo $this->base.'/'.$this->element( 'default_photo_selector', array( 'photo'=>$photo['name'],'dir'=>'products' ) ) ?>" class="view-large">
                                            <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$photo['name'],'dir'=>'products' ) ), array('title' => 'Click me!','alt'=>'Thumbnail','width'=>'120')) ?>
                                        </span>
                                        <?php endif ?>
                                    <?php $i++; endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="product-information">
                                <div>
                                    <h2><?php echo $product['Product']['name'] ?></h2>
                                </div>
                                <div class="size">
                                    <?php
                                    if(!empty($product['Category']['CategorySize'])){
                                    echo '<div><b>Size</b><b>*</b></div>';

                                        foreach($product['Category']['CategorySize'] as $size) {
                                            $get_size = $this->requestAction('products/getSize/'.$size['size_id']);
                                            $sizes[$get_size['Size']['size']] = $get_size['Size']['size'];
                                        }
                                        echo $this->Form->input('size',array('type'=>'radio','options'=>$sizes,'legend'=>false,'div'=>false,'required'=>true) );
                                    }
                                    ?>
                                    <div>
                                        <?php echo $this->html->image('/images/product-details/rating.png',array('alt'=>'Rating') ); ?>
                                    </div>
                                </div>
                                <span>
                                    <b><?php echo $product['Product']['price'] ?> Tk</b>
                                    <?php echo $this->Form->input('quantity',array('type'=>'number','div'=>false,'default'=>1 ) ) ?>
                                    <br/>

                                    <?php
                                    if($this->Session->check('Auth.User')) {
                                        $wish_list_link = $this->html->url('wish_list/'.$product['Product']['id']);
                                        echo '
                                            <button type="submit" class="btn btn-default cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </button>

                                            <a href="'.$wish_list_link.'">
                                            <button type="button" class="btn btn-default cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to wish list
                                            </button>
                                            </a>
                                        ';
                                    }else{
                                        echo '
                                         <button type="button" class="btn btn-default cart" onClick=" return alert(\'Please login first to add your product in cart\'); ">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                         </button>
                                        <button type="button" class="btn btn-default cart" onClick=" return alert(\'Please login first to add your product into wish list\');">
                                            <i class="fa fa-shopping-cart"></i>
                                           Add to wish list
                                        </button>
                                        ';
                                    }
                                    ?>
                                </span>
                                <p><b>Availability:</b><?php echo $product['Product']['availability']?></p>
                                <p><b>Condition:</b><?php echo $product['Product']['condition']?></p>
                                <p><b>Brand:</b><?php echo $product['Brand']['name']?></p>
                            </div>
                        </div>
                    </div>
                <?php echo $this->Form->end() ?>

                <div class="category-tab shop-details-tab ">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                            <li><a href="#reviews" data-toggle="tab">Reviews (<?php echo (!empty($product['Comment']))?count($product['Comment']):0 ?>)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="details">
                            <div class="col-sm-12">
                                <div class="previews product-type">
                                    <p>Product size</p>
                                    <span style="cursor: pointer" data-full="<?php echo $this->base.'/'.$this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['product_size_photo'],'dir'=>'products' ) ) ?>" class="view-large">
                                        <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['product_size_photo'],'dir'=>'products' ) ), array('title' => 'Click me!','alt'=>'Thumbnail','width'=>'150')) ?>
                                    </span>
                                </div><br><br>
                                Product details information goes here
                            </div>
                        </div>

                        <div class="tab-pane fade" id="reviews" >
                            <div class="col-sm-12">
                                <p><b>Write Your Review</b></p>
                                <?php echo $this->Form->create('Comment',array('url'=>'/products/save_comment'));?>
                                <?php echo $this->Form->textarea('comment',array('placeholder'=>'comment'));?>
                                <?php $user_id = $this->Session->read('Auth.User.id'); ?>

                                <?php echo $this->Form->input('product_id',array('type'=>'hidden','value'=>$product['Product']['id'] ) )?>
                                <?php echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user_id ) )?>

                                <?php
                                    if($this->Session->check('Auth.User')) {
                                        echo $this->Form->button('Submit',array('class'=>'btn btn-default pull-right') );
                                    }else{
                                        echo $this->Form->button('Submit',array('type'=>'button','class'=>'btn btn-default pull-right','onClick'=>'return alert(\'Please login first to submit your comment!\'); ') );
                                    }
                                ?>


                                <?php echo $this->Form->end();?><br><br>
                                <?php if(!empty($product['Comment'])){ ?>
                                    <div class="comment">
                                        <?php foreach($product['Comment'] as $comment) { ?>
                                            <div class="comment-row">
                                                <div class="pull-left user-icon">
                                                    <?php echo $this->Html->image('/images/product-details/user_icon.PNG',array('alt'=>'Services')) ?>
                                                </div>
                                                <div class="user">
                                                    <b class="user-name"><?php echo $comment['User']['first_name'].' '.$comment['User']['last_name'] ?></b>
                                                    <p><?php echo $comment['created'] ?></p>
                                                </div>
                                                <div class="user">
                                                    <p><?php echo $comment['comment'] ?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->element('new_arrival') ?>
            </div>
        </div>
    </div>
</section>




