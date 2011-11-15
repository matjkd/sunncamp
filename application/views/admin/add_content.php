<?=form_open("admin/submit_content")?> 
Title:<?=form_input('title', set_value('title'))?>
Menu link:<?=form_input('menu', set_value('menu'))?>
<br/>
Added By: <?=form_input('added_by')?><br/>
Date: <input type="text" name="date_added" id="datepicker" value=""><br/>
<?php if(!isset($category)) { $category=""; } ?>
Category: <input type="text" name="category" id="datepicker" value="<?=set_value('category', $category)?>"  disable="disabled" onFocus="this.blur();"><br/>
Content:
<textarea cols=75 rows=20 name="content" id="content"  class='wymeditor'></textarea>


<input type="submit" class="wymupdate" />
<?=form_close()?> 
