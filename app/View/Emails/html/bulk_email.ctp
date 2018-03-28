<p>Hi <?php echo $data['User']['first_name'].' '.$data['User']['last_name'] ?>, </p>
<br>
<p><?php echo $data['message'] ?></p>
<br/>
<p><?php echo $data['special_note'] ?></p>

<br/>

<?php if(!empty( $data['image'] ) ) { ?>
<div><a href="<?php echo $data['link'] ?>"><img src="<?php echo $data['image'] ?>" /></a></div>
<?php } ?>


<br/>
<div>Regards,</div>
<div><?php echo $data['site_name'] ?></div>

