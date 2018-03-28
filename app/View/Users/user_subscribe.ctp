<div class="orders index">
	<h3><?php echo __('Subscribe'); ?></h3>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr class="table_heading">
        <td>Product</td>
        <td>Quantity</td>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($subscribes as $product=>$quantity): ?>
	<tr>
		<td> <?php echo h($product); ?>&nbsp;</td>
		<td>
			<?php echo $quantity; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
    <div class="clear"></div>
</div>
