<section>
    <div class="container">
        <div class="row">
            <?php echo $this->element('categories')?>

            <div class="col-sm-9 padding-right">
                <?php echo $this->Session->flash() ?>
                <?php if(isset($products)): ?>
                    <div class="row search-select">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <?php echo $this->Form->create('Product',array('class'=>'form-inline','role'=>'form' ) ) ?>
                                    <span>Show Items:</span>
                                    <div class="form-group">
                                        <?php echo $this->Form->input('limit',array('options'=>array(30=>30,50=>50,100=>100,500=>'all'),'label'=>'form-control','label'=>false ) ) ?>
                                    </div>
                                    <span>Price:</span>
                                    <div class="form-group">
                                        <?php echo $this->Form->input('order',array('options'=>array('asc'=>'Min - Max','desc'=>'Max - Min'),'empty'=>'--Select--','label'=>'form-control','label'=>false) ) ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $this->Form->input('Filter',array('type'=>'submit','label'=>false,'class'=>'form-control') ) ?>
                                    </div>
                                <?php echo $this->Form->end()?>
                            </div>
                        </div>
                    </div>


                    <div class="features_items"><!--features_items-->
                        <?php $i=1 ?>
                        <?php foreach($products as $product): ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="<?php echo $this->Html->url('details/'.$product['Product']['slug'] ) ?>"> <?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','width'=>'150')) ?></a>
                                            <h2><?php echo number_format($product['Product']['price'] ) ?> Tk</h2>
                                            <p><?php echo implode(' ', array_slice(explode(' ', $product['Product']['name']), 0, 3)) ?></p>
                                            <a href="<?php echo $this->Html->url('details/'.$product['Product']['slug'] ) ?>" class="btn btn-default add-to-cart"><i class="fa fa-arrow-circle-o-right"></i>Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++ ?>
                        <?php endforeach ?>
                    </div><!--features_items-->
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
