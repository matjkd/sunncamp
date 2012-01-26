<?php
$is_logged_in = $this->session->userdata('is_logged_in');
$role = $this->session->userdata('role');
if ($is_logged_in != NULL && $role < 5) {
    ?>
    <div class="corner_cart">
          Hello <?= $this->session->userdata('firstname')?>, you are logged in. <br/>
        <a href="<?= base_url() ?>usercart/view_cart">View Cart</a> | <a href='<?=base_url()?>user/login/logout'>Click here to logout</a>
        
       
    </div>  
<?php } else { ?>

    <?= $this->load->view('global/sunncamp/login') ?>


<?php } ?>
