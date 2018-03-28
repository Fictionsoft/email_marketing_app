<div class="col-sm-3">
    <div class="box">
        <div class="box1">ACCOUNT</div>
        <div class="box-content">
            <ul>
                <?php if($this->Session->check('Auth.User')): ?>
                <li><a href="<?php echo $this->Html->url('/users/my_profile')?>">My Account</a></li>
                <li><a href="<?php echo $this->Html->url('/products/wish_list')?>">Wish List</a></li>
                <li><a href="<?php echo $this->Html->url('/users/my_profile')?>">Order History</a></li>
                <li><a href="<?php echo $this->Html->url('/users/change_password')?>">Change Password</a></li>
                <li><a href="<?php echo $this->Html->url('/users/logout')?>">Logout</a></li>
                <?php else: ?>
                <li><a href="<?php echo $this->Html->url('/users/login')?>">Login</a></li>
                <li><a href="<?php echo $this->Html->url('/users/signup')?>">Register</a></li>
                <li><a href="<?php echo $this->Html->url('/users/forgot_password')?>">Forgot Password</a></li>
                <?php endif ?>
            </ul>

        </div>
    </div>
</div>