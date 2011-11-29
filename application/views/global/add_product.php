<?php
/*
 * Gallery
 */
?>
<div id="gallery">
    <ul id="sortablethumb">
        <?php if (isset($images)):

            foreach ($images as $image): ?>



                <li id="pageorder_<?= $image->image_id ?>">
                    <div class="thumb" >
                        <a href="#">
                            <img height="100px" width="135px" src="<?= base_url() ?>images/properties/<?= $image->property_id ?>/thumbs/<?= $image->filename ?>" />
                        </a>
                        <div style="float:left;">On Printout:</div> <div  style="float:left;" class="printable" id="<?= $image->image_id ?>" style="width:150px; float:left;">
                            <?php
                            if ($image->printable == 0) {
                                echo "No";
                            };
                            if ($image->printable == 1) {
                                echo "Yes";
                            };
                            ?>
                        </div>

                        <div style="clear:both; float:left;">Order:</div> 	<div  style="float:left;" class="image_order" id="<?= $image->image_id ?>" style="width:150px; float:left;"><?= $image->print_order ?></div>
                        <div style="clear:both; float:left; padding-top:10px;">

                            <?= form_open('admin/delete_image') ?>
                            <?= form_hidden('id', $image->property_id) ?>
        <?= form_hidden('image_id', $image->image_id) ?>
        <?= form_submit('delete', 'Delete') ?>
        <?= form_close() ?>
                        </div> 		
                    </div>
                </li>


        <?php endforeach;
    else: ?>
        </ul>
        <div id="blank_gallery">Please Upload an Image</div>
<?php endif; ?>
</div>

<div id="upload">
	<?php 
		echo realpath(APPPATH . '../images/products');
		echo form_open_multipart('admin/upload_image');
		echo form_hidden('product_id', $product_id);
		echo form_upload('userfile');
		echo form_submit('upload', 'Upload');
		echo form_close();
	?>

</div>


<?php foreach($product as $row): ?>


<?php 
echo form_open('admin/update_product/'.$row->product_id);

?>


<div class="product_edit" id="<?=$row->product_id?>">
<div class="label">Product Name</div>
       
<input name="product_name" value="<?=$row->product_name?>"/>



<textarea name="product_desc" id="product_desc"  class="wymeditor" style="width:100%;"><?=$row->product_desc?></textarea>
        
</div>


<br/><input type="submit" class="wymupdate" />


<?php echo form_close(); ?>
<?php endforeach; ?>