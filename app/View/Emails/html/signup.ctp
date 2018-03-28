<h4>Hi <?php echo $user['User']['username'] ?>,</h4>
<?php
    $url = Router::url(array(
        'controller' => 'users',
        'action' => 'login',
    ), true);
?>

<p>
    <div>Welcome to efair. An User Account has been created for you at efair.</div>
    <div>Please find below the login particulars for your reference:</div>
</p>

<div>User Name: <?php echo $user['User']['username']; ?></div>

<p>You may log into your Account by simply clicking <a href="<?php echo $this->Html->$url('/'); ?>">here</a>.</p>

<br>
<div>Regards,</div>
<div><?php echo $site_name ?> Team</div>