
<h2>Add Manual</h2>
<?php echo form_open_multipart('backend/manuals_admin/do_upload');?>


<input type="text" name="catname" title="Name"/><br /><br />


Category:<select name="man_cat">
<?php foreach($manuals_cats as $row):?>


<option value="<?=$row->manual_cat_id?>"><?=$row->manual_cat?></option>
<?php endforeach; ?>
</select>
<br /><br/>
<input type="file" name="userfile" size="20" /><br/>
<br />

<input type="submit" value="upload" />

</form>

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



