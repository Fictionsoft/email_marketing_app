
<h4>Hi <?php echo $user['User']['username'] ?>,</h4>
<p>An reset password email has been made using your email address. Please click on the below link to reset your password</p>
<p>If you did not request the password reset, please ignore this email.</p>
<p>
    <a href="<?php echo Router::url('/', true) ?>users/reset_password/<?php echo $user['User']['token'] ?>">
        <?php echo Router::url('/', true) ?>users/reset_password/<?php echo $user['User']['token'] ?>
    </a>
</p>
<br/>
<div>Regards,</div>
<div><?php echo $site_name ?> Team</div>
