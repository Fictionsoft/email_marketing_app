<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="author" content="">
    <title><?php echo $site_name ?>:<?php echo $this->fetch('title'); ?></title>
    <?php
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('style');
    echo $this->Html->script('jquery');
    echo $this->Html->script('jquery.validate');
    ?>

    <!--[if lt IE 9]>
    <?php echo $this->Html->script('html5shiv') ?>
    <?php echo $this->Html->script('respond.min') ?>
    <![endif]-->

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
<?php
echo "\n" . '<script type="text/javascript">var BASE_URL = \'' . $this->Html->url('/', true) . '\';</script>';
echo "\n" . '<script type="text/javascript">var CONTROLLER = \'' . $this->name . '\';</script>';
echo "\n" . '<script type="text/javascript">var ACTION = \'' . $this->action . '\';</script>';
?>
<?php echo $this->element('header') ?>
<?php echo $this->fetch('content') ?>
<?php echo $this->element('footer') ?>


<?php echo $this->Html->script('bootstrap.min') ?>
<?php echo $this->Html->script('jquery.scrollUp.min') ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>


