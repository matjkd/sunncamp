<div class="corner_cart" >
    <strong>Login</strong>
    <?php
    $is_logged_in = $this->session->userdata('is_logged_in');
    if (!isset($is_logged_in) || $is_logged_in == true) {
        echo "you are logged in. <a href='" . base_url() . "user/login/logout'>logout</a>";
    } else {
        echo form_open(base_url() . 'user/login/validate_credentials');
        ?>

        <div id="loginbox" > 
            <input id="inputs"  type="text" id="username" name="username" title="Username" />  


            <input id="inputs" type="password" id="password" name="password" title="Password" />
      
      <input id="submitbutton" type="submit" name="login" value="Login"  border="0" />
         </div>
     
        <?php
      
        echo form_close();
    }
    ?>
    
   <?php if($this->sitelanguage == "dutch") { ?>
        	<hr>
   <strong>Register</strong><br/>
   Click here to Register     	
   <?php } ?>
<div style="clear:both"></div>
</div>

