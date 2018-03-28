<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"><h3>Product List</h3></div>
        <div class="col-md-3 top_space">
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
            <td><?php echo $product['Product']['name'] ?></td>
            <td><?php echo $product['Product']['slug'] ?></td>
            <?php $photo = ($product['Product']['cover_photo'])?'/uploads/products/'.$product['Product']['cover_photo'].'':'/img/default_video_cover_photo.png'; ?>
            <td><?php echo $this->Html->image($photo, array('alt' => 'Photo','width'=>'50')) ?></td>
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

    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>

    <div class="pagination">
        <ul>
            <?php
            if($paginator->hasPrev()){
                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            }

            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));

            if($paginator->hasNext()){
                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            }

            echo $paginator->last("Last");
            ?>
        </ul>
    </div>

<?php
}else{
    echo '<div class="alert alert-danger" role="alert">Product is not available !</div>';
}
?>



