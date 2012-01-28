<a href="<?=base_url()?>user/user_admin/create_company">Create Company</a>

<table id="company_table" width=100%>
<thead>
<tr>
<td>
Company Name
</td>
<td>
Company Type
</td>
</tr>
</thead>
<tbody>
<?php foreach($companies as $row):?>

        <tr>
                <td>
                <?=$row->company_name?>
                </td>
                
                <td>
                <?=$row->company_type_name?>
                </td>
        </tr>
        
<?php endforeach; ?>
</tbody>
</table>
