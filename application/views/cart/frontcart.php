<?php
$is_logged_in = $this->session->userdata('is_logged_in');
$role = $this->session->userdata('role');
if ($is_logged_in != NULL && $role < 5) {
    ?>

    Your cart
<a href="<?=base_url()?>usercart/view_cart">View Cart</a>
    
<?php } else { ?>

<?=$this->load->view('global/sunncamp/login')?>


<?php } ?>
