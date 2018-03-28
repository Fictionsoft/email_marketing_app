<?php
    $url = Router::url(array(
        'controller' => 'users',
        'action' => 'login',
    ), true);
?>


<h4>Hi <?php echo $user['User']['username'] ?>,</h4>
<p>Your password has been reset successfully</p>
<p>You may log into your Account by simply clicking <a href="<?php echo $url ?>">here</a>.</p>
<br/>

<div>Regards,</div>
<div><?php echo $site_name ?> Team</div>
