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



    echo form_open('admin/update_product/' . $row->product_id);
    ?>


    <div class="product_edit" id="<?= $row->product_id ?>">

        <div class="product_input_l">
            <div class="label">Product Name</div>

            <input name="product_name" value="<?= $row->product_name ?>"/>
        </div>

        <div class="product_input_r">
            <div class="label">Product ref</div>

            <input name="product_ref" value=""/>
        </div>


        <div class="product_input_l">
            <div class="label">Product er</div>

            <input name="product_name" value=""/>
        </div>

        <div class="product_input_r">
            <div class="label">Product ref</div>

            <input name="product_ref" value=""/>
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



<!--add attributes/options and stock level MOVE TO SIDE BOX-->

<?php if ($attributes != NULL) {
    foreach ($attributes as $row): ?>

        <?= $row->option_category ?> - <?= $row->option ?> - <?= $row->stock_level ?><br/>


    <?php endforeach;
} ?>

<?= form_open('admin/add_attribute/' . $product_id) ?>
<div class="product_input_l">
    If this product has no options, just enter 'none' in both the option category and option. Then enter the stock level.
    <div class="label">Option Category (eg. colour)</div>

    <input name="option_category" value=""/>

    <div class="label">Option (eg. red)</div>

    <input  name="option" value=""/>

    <div class="label">Stock Level</div>

    <input name="stock_level" value=""/>
    <input  type="hidden" name="product_id" value="<?= $product_id ?>"/>
</div>  
<input type="submit" />     
<?= form_close() ?>
<!--end of adding options-->


<!--set product categories-->
<?php if ($categories != NULL) {
    foreach ($categories as $row): ?>

        <?= $row->category ?><br/>


    <?php endforeach;
} ?>

<?= form_open('admin/add_product_category/' . $product_id) ?>
<div class="product_input_l">
   
    <div class="label">Product Category</div>

    <input name="product_category" value=""/>

    
    <input  type="hidden" name="product_id" value="<?= $product_id ?>"/>
</div>  
<input type="submit" />     
<?= form_close() ?>

<!--end of product categories-->