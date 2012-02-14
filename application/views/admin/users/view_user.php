<h2>Edit User</h2>
<div id="generic_form">
    <div style="float:left; width:50%;">
        <?= form_open('user/login/update_member') ?>
        <?php foreach ($user as $row): ?>
            <input type="hidden" name="company_id" value="<?= $row->company ?>"/>
            <input type="hidden" name="user_id" value="<?= $row->user_id ?>"/>
            <input type="hidden" name="active" value="1"/>



        <?php endforeach; ?>
            <p>
                Username: <?=$row->username?>
            </p>
        <p>
            <input type="text" name="firstname" value="<?= set_value('firstname', $row->firstname) ?>"/> <label>Firstname</label>
        </p>
        <p>
            <input type="text" name="lastname" value="<?= set_value('lastname', $row->lastname) ?>"/> <label>Lastname</label>
        </p>  
        <p>
            <input type="text" name="email_address" value="<?= set_value('email_address', $row->email) ?>"/> <label>Email</label>
        </p>  
        <p>
            <input type="text" name="phone" value="<?= set_value('phone', $row->phone) ?>"/> <label>Phone</label>
        </p>  

        <input type="submit" value="Update User" />
        <?= form_close() ?>
    </div>  

    <div style="float:left; width:45%;">
        <?= form_open('user/login/update_login_details') ?>
        <input type="hidden" name="company_id" value="<?= $row->company ?>"/>
            <input type="hidden" name="user_id" value="<?= $row->user_id ?>"/>
<!--        <p>
            <input type="text" name="username" value="<?= set_value('username', $row->username) ?>"/> <label>Username</label>
        </p>  -->
        <p>
            <input type="password" name="password"/> <label>Password</label>
        </p>  
        <p>
            <input type="password" name="password2"/> <label>Repeat Password</label>
        </p>  
        <input type="submit" value="Update login details" />
        <?= form_close() ?>
    </div>
    <div style="clear:both">
    </div>
</div>