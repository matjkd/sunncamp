<script>
    function submitOnClick(formName){
        document.forms[formName].submit();
    }
</script>

<h2>Add Manual</h2>
<div id="generic_form">
	Enter a Name, select a category then choose the file from your hard drive. If you don't specifiy a name it will be populated by the filename.
	<br/>
	<?php echo form_open_multipart('backend/manuals_admin/do_upload'); ?>

	<input type="text" name="catname" title="Name"/>
	<br />
	<br />

	<select name="man_cat">
		<?php foreach($manuals_cats as $row):?>

		<option value="<?=$row -> manual_cat_id ?>"><?=$row -> manual_cat ?></option>
		<?php endforeach; ?>
	</select>
	Category
	<br />
	<br/>
	<input type="file" name="userfile" size="20" />
	<br/>
	<br />

	<input type="submit" value="upload" />

	</form>
	<hr>
	<h2>Create Category</h2>
	<?=form_open('backend/manuals_admin/create_manual_category') ?>
	
	<input type="text" name="catname2" value=""/>
	
	<input type="submit" value="add category" />
	<?=form_close() ?>

	<hr>
	<?php foreach($manuals_cats as $row):?>
	<div class="catlabel">
		
		<?php $attributes = array('id' => 'myform'.$row -> manual_cat_id);?>
		
		<?=form_open('backend/manuals_admin/delete_manual_category', $attributes) ?>
		<?=$row -> manual_cat ?>
		<?=form_hidden('cat_id', $row -> manual_cat_id)?>
		<div onclick="submitOnClick('myform<?=$row -> manual_cat_id?>')"  style="float:right; margin-right:10px;" class="ui-icon ui-icon-circle-close spanlink">
			x
		</div>
		<?=form_close()?>
	</div>
	<?php endforeach; ?>
<div style="clear:both"></div>
</div>
<table id="box-table-a">

	<?php foreach($manuals_cats as $row):?>

	<tr>
		<th><?=$row -> manual_cat ?></th>

	</tr>
	<?php foreach($manuals as $row2):?>

	<?php if($row2->manual_category == $row->manual_cat_id) { ?>
	<tr>
		<td id="row_<?=$row2 -> manual_id ?>">
		<div style="float:left;">
			<?=$row2 -> manual_title ?> | <?=$row2 -> manual_filename ?>
		</div>
		<div style="float:right;">
			<?=form_open('backend/manuals_admin/move_manual') ?>
			
			<?=form_hidden('manual', $row2 -> manual_id)?>
			<select name="manualselect">
				<?php foreach($manuals_cats as $cats):?>
				<?php
					if ($cats -> manual_cat == $row -> manual_cat)
					{
						$selected = "selected";
					}
					else
					{
						$selected = "";
					}
				?>
				<option value="<?=$cats -> manual_cat_id ?>" <?=$selected ?>><?=$cats -> manual_cat ?></option>
				<?php endforeach; ?>
			</select>
			<button>
				Move
			</button>
			<?=form_close() ?>
		</div>
		<div style="float:right; margin-right:10px;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteManual(<?= $row2 -> manual_id ?>, '<?= $row2 -> manual_filename ?>')">
			x
		</div></td>
	</tr>
	<?php } ?>

	<?php endforeach; ?>

	<?php endforeach; ?>
</table>

