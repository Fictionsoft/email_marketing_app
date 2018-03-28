
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $site_name.' '. $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->script(array('jquery','jquery.validate'));
    echo $this->Html->css(array(
        'admin_style',
        'bootstrap.min',
        'plugins/metisMenu/metisMenu.min',
        'plugins/timeline',
        'sb-admin-2',
        'admin_custom',
        'plugins/morris',
        'css/font-awesome.min'
    ));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <?php
            echo $this->Html->link($site_name,Router::url('/',true),array('class' => 'navbar-brand') );
            ?>
        </div>
    </nav>
    <br/>
    <div style="width: 400px;margin:auto;border:1px solid #ddd;padding: 20px;">
        <?php echo $this->Session->flash(); ?>
        <?php
        echo $this->fetch('content'); ?>
    </div>
</div>

<?php
echo $this->Html->script(
    array(
    'bootstrap.min',
    'sb-admin-2'
    )
);
echo $this->Js->writeBuffer();
?>
</body>
</html>
