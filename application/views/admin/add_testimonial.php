<h3>Add Testimonial</h3>
<?= form_open_multipart("admin/submit_content") ?>
<p>
	<?= form_label('Title') ?>
	<br />
	<?= form_input('title', set_value('title')) ?>
</p>


<p>
	
	<br />
	<?= form_hidden('menu', set_value('menu')) ?>
</p>




	 <input type="hidden" name="date_added" id="datepicker" value=""><br />

<?php
if (!isset($category)) {
	$category = "";
}
?>


	
	 <input type="hidden" name="category" id="datepicker"
		value="<?= set_value('category', $category) ?>" disable="disabled"
		onFocus="this.blur();">




Content:
<textarea
	cols=75 rows=20 name="content" id="content" class='wymeditor'></textarea>
	
	
<p>
	<?= form_label('Author') ?>
	<br />
	<?= form_input('added_by') ?>
</p>


<input type="submit"
	class="wymupdate" />
<?= form_close() ?>

