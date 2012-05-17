<?php foreach($content as $row):?>


<?php  $id = $row->content_id;?>


<?=form_open("admin/edit_content/$row->content_id")?> 
<p>
Title* <br/><?=form_input('title', $row->title)?><br/>
</p>
<p>
Menu <br/><?=form_input('menu', $row->menu)?><br/>
</p>
<textarea cols=65 rows=20 name="content" id="content" class='wymeditor'><?=$row->content?></textarea>
<br/>


Meta Description<br/>
<textarea  cols=65 rows=2 name="meta_desc"><?=$row->meta_desc?></textarea>
<br/>
Meta Keywords<br/>
<textarea  cols=65 rows=2 name="meta_keywords"><?=$row->meta_keywords?></textarea>
<br/>
Meta Title<br/>
<textarea  cols=65 rows=2 name="meta_title"><?=$row->meta_title?></textarea>
<br/>

Extra: 
<br/><?=form_input('extra', $row->extra)?><br/>
Sidebox:
<br/><?=form_input('sidebox', $row->sidebox)?><br/>
<input type="submit" class="wymupdate" />
<?=form_close()?> 
<?php endforeach;?>