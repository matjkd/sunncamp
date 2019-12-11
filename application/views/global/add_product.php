
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
                            <?php
                
                //check if s3 file exists
                $remoteFile = base_url()."images/products/".$product_id."/thumbs/".$image->filename;
                
                if(getimagesize($remoteFile)){
                 echo "local ".$remoteFile;
                    $fileLocation = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$product_id."/thumbs/".$image->filename;
                } else {
                    echo "s3 ".$remoteFile;
                    $fileLocation = $remoteFile;
                }
               
    
                ?>
                            <img height="100px" width="135px" src="<?=$fileLocation?>" />
                          <!--  <img height="100px" width="135px" src="/images/products/<?= $product_id ?>/thumbs/<?= $image->filename ?>"/> -->
                        </a>


                        <!--   <div style="clear:both; float:left;">Order:</div> 	
                           <div  style="float:left;" class="image_order" id="<?= $image->product_image_id ?>" style="width:150px; float:left;">
                        <?= $image->order ?>
                           </div> -->
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

            <input name="product_ref" value="<?= $row->product_ref ?>"/>
        </div>




        <div style="clear:both;">
            <textarea name="product_desc" id="product_desc"  class="wymeditor" style="width:100%;"><?= $row->product_desc ?></textarea>
        </div>
    </div>
  Active on Site: <?=form_checkbox('active', '1', $row->active)?><br/>
    <br/>
    <input name="Submit" type="submit" class="wymupdate" />


    <?php
    echo form_close();
endforeach;
?>
<!--end of product details-->

<hr/>

<!--set product specs-->



<div class="ui-widget">

    <h3>Product Specifications</h3>

    <input  id="autocompletespecs" name="product_spec" value=""/>
    <input  id="spec_value" name="spec_value" value=""/>

    <span style="width:18px; float:right;" class="ui-icon ui-icon-circle-plus spanlink" onclick="addSpectoProduct(<?= $product_id ?>)" ></span> 
</div>  
<input  type="hidden" name="product_id" value="<?= $product_id ?>"/>

<style>
    #specorder { list-style-type: none; margin: 0; padding: 10px 0 0 0; }
    #specorder li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 0px; font-size: 1.0em; height: 18px; }
    #specorder li span { position: absolute; margin-left: -1.3em; }
</style>
<div id="specs">   
    <ul id="specorder" width="100%">   
    <li>Specs</li>
        <?php if ($specs != NULL) {
            foreach ($specs as $row): ?>
                <li id="spec_<?= $row->spec_link_id ?>" class="cattable">
                    <div style="float:left;" class="ui-icon ui-icon-arrowthick-2-n-s"></div><strong><?= $row->spec_desc ?>:</strong> <?= $row->spec_value ?>
                    <div style="float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteSpecfromProduct(<?= $row->spec_link_id ?>)">x</div>
                </li>


            <?php endforeach;
        } ?> </ul>
</div>
<!--end of product specs-->


<hr/>
<!--other features-->
    <h3>Other Features</h3>
   <input  id="autocompleteotherfeatures" name="other_feature" value=""/>
    <span style="width:18px; float:right;" class="ui-icon ui-icon-circle-plus spanlink" onclick="addOtherFeaturetoProduct(<?= $product_id ?>)" ></span> 

    
    <style>
    #other_feature_order { list-style-type: none; margin: 0; padding: 10px 0 0 0; }
    #other_feature_order li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 0px; font-size: 1.0em; height: 18px; }
    #other_feature_order li span { position: absolute; margin-left: -1.3em; }
</style>
<div id="other_features">   
    <ul id="other_feature_order" width="100%">   
    <li>Other Features</li>
        <?php if ($other_features != NULL) {
            foreach ($other_features as $row): ?>
                <li id="other_feature_<?= $row->other_feature_link_id ?>" class="cattable">
                    <div style="float:left;" class="ui-icon ui-icon-arrowthick-2-n-s"></div><strong><?= $row->other_feature_name ?></strong> 
                    <div style="float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteOtherFeaturefromProduct(<?= $row->other_feature_link_id ?>)">x</div>
                </li>


            <?php endforeach;
        } ?> </ul>
</div>
<!--end of other features-->
