<?php
/*
 * Gallery
 */
?>
<div id="gallery">
    <ul id="sortablethumb">
        <?php if (isset($images) && $images != NULL) {
            foreach ($images as $image): ?>



                <li id="pageorder_<?= $image->product_image_id ?>">
                    <div class="thumb" >
                        <a href="#">
                            <img height="100px" width="135px" src="<?= base_url() ?>images/products/<?= $product_id ?>/thumbs/<?= $image->filename ?>" />
                        </a>


                        <div style="clear:both; float:left;">Order:</div> 	<div  style="float:left;" class="image_order" id="<?= $image->product_image_id ?>" style="width:150px; float:left;"><?= $image->order ?></div>
                        <div style="clear:both; float:left; padding-top:10px;">

                            <?= form_open('admin/delete_image') ?>
                            <?= form_hidden('id', $image->product_id) ?>
                            <?= form_hidden('image_id', $image->product_image_id) ?>
                            <?= form_submit('delete', 'Delete') ?>
                            <?= form_close() ?>
                        </div> 		
                    </div>
                </li>


            <?php endforeach;
        } else { ?>
        </ul>
        <div id="blank_gallery">Please Upload an Image</div>
    <?php } ?>
</div>

<div id="upload">
    <?php
    //echo realpath(APPPATH . '../images/products');
    echo form_open_multipart('admin/upload_image');
    echo form_hidden('product_id', $product_id);
    echo form_upload('userfile');
    echo form_submit('upload', 'Upload');
    echo form_close();
    ?>

</div>

<!--This is the product details-->
<?php
foreach ($product as $row):



    echo form_open('a630dmin/update_product/' . $row->product_id);
    ?>


    <div class="product_edit" id="<?= $row->product_id ?>">

        <div class="product_input_l">
            <div class="label">Product Name</div>

            <input name="product_name" value="<?= $row->product_name ?>"/>
        </div>

        <div class="product_input_r">
            <div class="label">Product ref</div>

            <input name="product_ref" value="<?= $row->product_ref ?>"/>
        </div>




        <div style="clear:both;">
            <textarea name="product_desc" id="product_desc"  class="wymeditor" style="width:100%;"><?= $row->product_desc ?></textarea>
        </div>
    </div>

    <br/>
    <input type="submit" class="wymupdate" />


    <?php
    echo form_close();
endforeach;
?>
<!--end of product details-->


<!--set product specs-->

<hr/>
<?= form_open('admin/add_product_spec/' . $product_id) ?>
<div class="ui-widget">

    <div class="label">Product Specifications</div>

    <input  id="autocompletespecs" name="product_spec" value=""/>
    <input  id="spec_value" name="spec_value" value=""/>
    <input type="submit" />  

</div>  
<input  type="hidden" name="product_id" value="<?= $product_id ?>"/>

<?= form_close() ?>
<style>
	#specorder { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#specorder li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.0em; height: 18px; }
	#specorder li span { position: absolute; margin-left: -1.3em; }
	</style>
<div id="attributes">   <ul id="specorder">   
    <?php if ($specs != NULL) {
        foreach ($specs as $row): ?>
        <li id="page_<?= $row->spec_link_id ?>" class="ui-state-default">
            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                <?= form_open('admin/remove_spec/' . $product_id) ?>

                <input type="hidden"  disabled="disabled" value="<?= $row->spec_desc ?>"/>
                <input type="hidden"  disabled="disabled" value="<?= $row->spec_value ?>"/>
                <input  type="hidden" name="spec_link_id" value="<?= $row->spec_link_id ?>"/>
<?= $row->spec_desc ?>: <?= $row->spec_value ?>
                <input style="width:18px; float:right;" class="ui-icon ui-icon-circle-close" type="submit" value="X" />
        </li>
                <?= form_close() ?>
           
        <?php endforeach;
    } ?> </ul>
</div>
<!--end of product specs-->



