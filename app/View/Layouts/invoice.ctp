<?php

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>iXenCenter:<?php echo $this->fetch('title'); ?>
	</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
        echo $this->Html->script('jquery-1.11.0');
        echo $this->Html->script('jquery.validate');
        echo $this->Html->script('jquery.bxslider');
        echo $this->Html->script('index_header');
	?>
</head>
<body style="background:#F1F1F1">
<!--START:-->
<div class="page-centent">
  <div class="wrapper">
    <div id="my-account-content">
      <div class="my-account-right" style="float:none!important;margin:auto!important;">
        <h1>Invoice</h1>
        <div class="my-account-right-content"> <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch('content'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!--END:-->
</body>
</html>
