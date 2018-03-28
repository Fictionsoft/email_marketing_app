<div>An enquiry has been submitted with the following information and message:</div>
<br>
<div>From: <?php echo $user['contact']['name'] ?></div>
<div>Email: <?php echo $user['contact']['email'] ?></div>
<div>Message:</div>
<p><?php echo $user['contact']['message'] ?></p>
<br/>
<div>Regards,</div>
<div><?php echo $user['contact']['name'] ?></div>
<div>This message is sent from <?php echo Router::url('/', true) ?></div>

