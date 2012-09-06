<?= form_open_multipart("admin/submit_content") ?>
<p>
	<?= form_label('Title') ?>
	<br />
	<?= form_input('title', set_value('title')) ?>
</p>


<p>
	<?= form_label('Menu Link') ?>
	<br />
	<?= form_input('menu', set_value('menu')) ?>
</p>

<p>
	<?= form_label('Added by') ?>
	<br />
	<?= form_input('added_by') ?>
</p>

<p class="Image">
	<?= form_label('Image') ?>
	<br />

	<?= form_upload('file') ?>
</p>

<p>
	<?= form_label('Date') ?>
	<br /> <input type="text" name="date_added" id="datepicker" value=""><br />
</p>
<?php
if (!isset($category)) {
	$category = "";
}
?>

<p>
	<?= form_label('Category') ?>
	<br /> <input type="text" name="category" id="datepicker"
		value="<?= set_value('category', $category) ?>" disable="disabled"
		onFocus="this.blur();">
</p>



Content:
<textarea
	cols=75 rows=20 name="content" id="content" class='wymeditor'></textarea>


<input type="submit"
	class="wymupdate" />
<?= form_close() ?>

