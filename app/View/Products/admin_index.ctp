<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"><h3>Product List</h3></div>

        <div class="col-md-3 top_space">
            <?php echo $this->Form->create('Product') ?>
                <div class="input-group custom-search-form">
                    <?php echo $this->Form->input('filter',array('placeholder'=>'Search...','class'=>'form-control','label'=>false) ) ?>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            <?php echo $this->Form->end() ?>

            <!--<div class="input-group custom-search-form">
                <?php
/*                echo $this->Form->create('Product', array(
                    'class' => '',
                    'url' => '/admin/products',
                ));
                echo $this->Form->input('filter',array('label'=>false,'div'=>false,'class'=>'form-control'));
                */?>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                <?php
/*                echo $this->Form->end();
                */?>
            </div>-->
        </div>
        <div class="col-md-2 top_space">
            <?php
            echo '<div class="reset-button">'.$this->Html->link('Reset',array('controller' => 'products', 'action' => 'reset', 'admin' =>true),array('class'=>'btn btn-primary')).'</div>';
            ?>
        </div>
        <div class="col-md-2 top_space">
            <?php
            echo $this->Html->link(
                'Add new',
                '/admin/products/create',
                array('class' => 'btn btn-primary')
            );
            ?>
        </div>
    </div>
    <br/>
</div>

<?php
$paginator = $this->Paginator;
if($products){
?>
    <table class="table table-hover">
    <tr>
        <th>#Id</th>
        <th><?php echo $paginator->sort('category_id','Category')?></th>
        <th><?php echo $paginator->sort('brand_id','Brand')?></th>
        <th><?php echo $paginator->sort('name')?></th>
        <th><?php echo $paginator->sort('slug') ?></th>
        <th>Photo</th>
        <th><?php echo $paginator->sort('status') ?></th>
        <th>Action</th>
    </tr>
    <?php
    $i=1;
    foreach( $products as $product ) {

    ?>
        <tr>
            <td><?php echo $i ?> </td>
            <td><?php echo $product['Category']['name'] ?></td>
            <td><?php echo $product['Brand']['name'] ?></td>
            <td><?php echo $product['Product']['name'] ?></td>
            <td><?php echo $product['Product']['slug'] ?></td>
            <td><div class="form-group"><?php echo $this->Html->image($this->element( 'default_photo_selector', array( 'photo'=>$product['Product']['cover_photo'],'dir'=>'products' ) ), array('alt' => 'Product','width'=>'50')) ?></div></td>
            <td class="center"><?php echo $this->element('admin/toggle', array('status' => $product['Product']['status'] )) ?>&nbsp;</td>
            <td>
                <?php
                    // edit link
                    echo $this->Html->link("Edit", array('action' => 'update', $product['Product']['id'])).'&nbsp;&nbsp;';
                    //delete link
                    echo $this->Form->postLink('Delete', array('action' => 'delete', $product['Product']['id']),array('confirm' => 'Are you sure you want to delete this Product?'));
                ?>
            </td>
       </tr>
    <?php
        $i++;
    }
        unset($product);
    ?>
    </table>

    <?php echo $this->element('admin/paging') ?>

<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Product is not available !</div>';
}
?>



