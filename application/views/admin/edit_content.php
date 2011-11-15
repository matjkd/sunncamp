<?php foreach($content as $row):?>


<?php  $id = $row->content_id;?>


<?=form_open("admin/edit_content/$row->content_id")?> 
Title: <br/><?=form_input('title', $row->title)?><br/>
Menu link:<?=form_input('menu', $row->menu)?>
<br/>
<textarea cols=65 rows=20 name="content" id="content" class='wymeditor'><?=$row->content?></textarea>
<br/>


Extra: 
<br/><?=form_input('extra', $row->extra)?><br/>
Sidebox:
<br/><?=form_input('sidebox', $row->sidebox)?><br/>
<input type="submit" class="wymupdate" />
<?=form_close()?> 
<?php endforeach;?>