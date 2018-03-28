<div class="col-sm-3">
    <div class="category-position">
        <div class="catagory-top">
            <a href="<?php echo $this->Html->url('/')?>">All Category</a>
        </div>
        <div class="catagory" id="product-categories">
            <ul>
                <?php
                    $main_categories = $this->requestAction('categories/categories');


                    if($main_categories){
                        $count=count($main_categories);
                        $i=1;
                        foreach($main_categories as $main_category){
                            if(!empty($main_category['Category'])){
                        ?>
                            <li <?php echo ($i==$count)?'class="catagory-bac"':'' ?> ><a data-toggle="collapse" data-parent="#product-categories" href="#<?php echo $main_category['MainCategory']['slug'] ?>"><?php echo $main_category['MainCategory']['name'] ?> <i class="pull-right fa fa-angle-right"></i> </a></li>
                            <li id="<?php echo $main_category['MainCategory']['slug'] ?>" class="panel-collapse collapse">
                                <ul>
                                    <?php $c = 1 ?>
                                    <?php foreach($main_category['Category'] as $category){ ?>
                                    <li <?php echo ($c==count($main_category['Category']))?'class="catagory-bac"':'' ?> ><?php echo $this->Html->link($category['name'],'/products/category/'.$category['slug']) ?></li>
                                    <?php } ?>
                                </ul>
                            </li>
                    <?php
                            }
                            $i++;
                        }
                    }
                    ?>
            </ul>
        </div><br><br>

        <div class="left-add mobile-view">
            <a href="#"><?php echo $this->Html->image('/images/home/shipping.jpg',array('alt'=>'Add','class'=>'img-responsive')) ?></a>
        </div>
    </div>
</div>