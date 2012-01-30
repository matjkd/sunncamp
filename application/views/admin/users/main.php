
<div>
<?php foreach($company as $row):?>



<div id="generic_form">


<div style="width:50%; float:left;">
<h2>Company Details</h2>
    <?php echo form_open('user/user_admin/update_company'); ?>
<input type="hidden" name="address_id" value="<?=$row->address_id?>"/>
<input type="hidden" name="company_id" value="<?=$row->company_id?>"/>
    <p>

        <input type="text" name="company_name" value="<?=set_value('company_name', $row->company_name)?>"/>
        <label>Company Name</label>
    </p>
    <p>

        <input type="text" name="phone"  value="<?=set_value('phone', $row->company_phone)?>"/>
        <label>Phone</label>
    </p>
    <p>

        <input type="text" name="webaddress" value="<?=set_value('webaddress', $row->company_web)?>" />
        <label>Web Address</label>
    </p>
    <p>

        <input type="text" name="address1" value="<?=set_value('address1', $row->address1)?>"/>
        <label>Address 1</label>
    </p>
    <p>

        <input type="text" name="address2" value="<?=set_value('address2', $row->address2)?>"/>
        <label>Address 2</label>
    </p>
    <p>

        <input type="text" name="address3" value="<?=set_value('address3', $row->address3)?>"/>
        <label>Address 3</label>
    </p>
    <p>

        <input type="text" name="address4" value="<?=set_value('address4', $row->address4)?>"/>
        <label>Address 4</label>
    </p>
    <p>

        <input type="text" name="address5" value="<?=set_value('address5', $row->address5)?>"/>
        <label>Address 5</label>
    </p>
    <p>

        <input type="text" name="postcode" value="<?=set_value('postcode', $row->postcode)?>" />
        <label>Postcode</label>
    </p>

    <p>

        <select name="company_type">
            <option value="1">Stockist</option>
            <option value="2">Supplier</option>
            <option value="10">Other</option>
        </select>
        <label>Company Type</label>
    </p>
    <p>

        <select name="visible">
            <option value="0">No</option>
            <option value="1">Yes</option>
          
        </select>
        <label>Visible on site (under stockists, if stockist)</label>
    </p>
    <input type="submit" value="update" />

</form>

</div>



<div style="width:45%; float:left;">
<h3>Users</h3>
<?php foreach($users as $row):?>

<?=$row->firstname?> <?=$row->lastname?><br/>
<?php endforeach; ?>

<span class="spanlink">Add User</span>

</div>

<div style="clear:both;"></div>

</div>

<?php endforeach; ?>

</div>

<div>
<a href="<?=base_url()?>user/user_admin/create_company">Create Company</a>
</div>
<table id="company_table" width=100%>
<thead>
<tr>
<td>
Company Name
</td>
<td>
Company Type
</td>

<td>
Visible on site
</td>

<td>
Actions
</td>
</tr>
</thead>
<tbody>
<?php foreach($companies as $row):?>

        <tr id="row_<?=$row->company_id?>">
                <td>
                <?=$row->company_name?>
                </td>
                
                <td>
                <?=$row->company_type_name?>
                </td>
                
                <td>
                <?=$row->visible_on_site?>
                </td>
                
                <td>
                <a href="<?=base_url()?>user/user_admin/list_companies/<?=$row->company_id?>">view</a>
                 
                 |
                  
              
                
                <span class="spanlink" onclick="deleteCompany(<?=$row->company_id?>)">delete</span>
                </td>
        </tr>
        
<?php endforeach; ?>
</tbody>
</table>
