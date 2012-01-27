
<h2>Add Manual</h2>
<div id="generic_form">
    Enter a Name, select a category then choose the file from your hard drive. If you don't specifiy a name it will be populated by the filename.<br/>
<?php echo form_open_multipart('backend/manuals_admin/do_upload');?>


<input type="text" name="catname" title="Name"/><br /><br />


<select name="man_cat"> 
<?php foreach($manuals_cats as $row):?>


<option value="<?=$row->manual_cat_id?>"><?=$row->manual_cat?></option>
<?php endforeach; ?>
</select> Category
<br /><br/>
<input type="file" name="userfile" size="20" /><br/>
<br />

<input type="submit" value="upload" />

</form>
</div>
<table id="box-table-a">

<?php foreach($manuals_cats as $row):?>
            
                <tr>
                    <th><?=$row->manual_cat?></th>
                  
                    
                </tr>
                <?php foreach($manuals as $row2):?>
                
                <?php if($row2->manual_category == $row->manual_cat_id) { ?>
                <tr>
                <td id="row_<?=$row2->manual_id?>">
                 <?=$row2->manual_title?> | <?=$row2->manual_filename?>
                 <div style="float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteManual(<?= $row2->manual_id ?>, '<?= $row2->manual_filename ?>')">x</div>
                </td>
                </tr>
                <?php } ?>
                
                <?php endforeach; ?>
                
<?php endforeach; ?>

</table>



