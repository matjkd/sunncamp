<div class="footerstyle" style="padding-top:20px; padding-left:10px;">
    Customer Login
    <?php
    $is_logged_in = $this->session->userdata('is_logged_in');
    if (!isset($is_logged_in) || $is_logged_in == true) {
        echo "you are logged in. <a href='" . base_url() . "user/login/logout'>logout</a>";
    } else {
        echo form_open(base_url() . 'user/login/validate_credentials');
      
        echo form_input('username', 'Username');
        ?>
        <br/>
        <?php
        echo "<br/>";
        echo form_password('password', 'Password');
        ?>
        <br/>
        <?php
        echo form_submit('submit', 'Login');
        echo form_close();
    }
    ?>

</div>