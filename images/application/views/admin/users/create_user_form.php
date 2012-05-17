<div id="generic_form">
   <?= form_open('user/login/create_member') ?>
    <?php foreach ($company as $row): ?>

        <input type="hidden" name="company_id" value="<?= $row->company_id ?>"/>
    <input type="hidden" name="active" value="1"/>



    <?php endforeach; ?>
    <p>
        <input type="text" name="firstname"/> <label>Firstname</label>
    </p>
    <p>
        <input type="text" name="lastname"/> <label>Lastname</label>
    </p>  
     <p>
        <input type="text" name="email_address"/> <label>Email</label>
    </p>  
      <p>
        <input type="text" name="phone"/> <label>Phone</label>
    </p>  
        <p>
        <input type="text" name="username"/> <label>Username</label>
    </p>  
   <p>
        <input type="password" name="password"/> <label>Password</label>
    </p>  
 <p>
        <input type="password" name="password2"/> <label>Repeat Password</label>
    </p>  
    
     <input type="submit" value="Add User" />
     <?=form_close()?>
</div>