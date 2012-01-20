
<!--add attributes/options and stock level MOVE TO SIDE BOX-->



<?= form_open('admin/add_attribute/' . $product_id) ?>
<div class="product_input_l" style="width:98%; margin-top:10px;">
    If this product has no options, just enter the stock level. 
    <div class="label">Attribute Category (eg. colour)</div>

    <input id="autocompleteoptions" name="option_category" value=""/>

    <div class="label">Attribute (eg. red)</div>

    <input  name="option" value=""/>

    <div class="label">Stock Level</div>

    <input name="stock_level" value=""/>
    <input  type="hidden" name="product_id" value="<?= $product_id ?>"/>
</div>  
<input type="submit" />     
<?= form_close() ?>
<!--end of adding options-->

<div id="attributes">
    <div id="label_attribute">Cat.</div>  <div id="label_attribute">Option</div>  <div id="label_attribute">Stock</div> <div id="label_attribute">Action</div>
    <?php if ($attributes != NULL) {
        foreach ($attributes as $row): ?>
            <?= form_open('admin/edit_attribute/') ?>
            <input name="option_category" value="<?= $row->option_category ?>"/><input name="option" value="<?= $row->option ?>"/><input name="stock_level" value="<?= $row->stock_level ?>"/>
            <input  type="hidden" name="option_id" value="<?= $row->option_id ?>"/>
            <input  type="hidden" name="product_id" value="<?= $row->product_id ?>"/>
            <input type="submit" name="submit" value="Update" />   
            <input style="width:12px; padding-left: 1px;" class="deletebutton" type="submit" name="submit" value="X" /> 
            <br/>
            <?= form_close() ?>
        <?php endforeach;
    } ?>
</div>

<!--set product categories-->

<hr/>

<div class="ui-widget">

    <div class="label">Product Category</div>

    <input  id="autocompletecategories" name="product_category" value=""/>

   
    <span style="width:18px; float:right;" class="ui-icon ui-icon-circle-plus spanlink" onclick="addCategorytoProduct(<?= $product_id ?>)" ></span>

</div>  
<input  type="hidden" name="product_id" value="<?= $product_id ?>"/>



<div id="categories">      
    <?php if ($categories != NULL) {
        foreach ($categories as $row): ?>
          

<div class="cattable" id="categorylink_<?= $row->category_link_id ?>"><?= $row->product_category_name ?>
              <span  style="width:18px; float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteCategoryfromProduct('<?= $product_id ?>', '<?= $row->category_link_id ?>')" >X</span></div>

            
        <?php endforeach;
    } ?>
</div>
<!--end of product categories-->

<!--set product features-->

<hr/>
<?= form_open('admin/add_product_feature/' . $product_id) ?>
<div class="ui-widget">

    <div class="label">Product Features</div>

    <select name="product_feature">
        <?php foreach ($allfeatures as $row): ?>
<option value="<?= $row->feature_id ?>"><?= $row->feature_name ?></option>
        <?php endforeach; ?>
    </select>
        <input type="submit" />  
        
        
</div>  
<input  type="hidden" name="product_id" value="<?= $product_id ?>"/>

<?= form_close() ?>

<div id="attributes">      
    <?php if ($features != NULL) {
        foreach ($features as $row): ?>
            <?= form_open('admin/remove_feature/' . $product_id) ?>
            <input style="width:190px" disabled="disabled" value="<?= $row->feature_name ?>"/>
            <input  type="hidden" name="feature_link_id" value="<?= $row->feature_link_id ?>"/>





            <input style="width:15px;" class="deletebutton" type="submit" value="X" /> <br/>
            <?= form_close() ?>
        <?php endforeach;
    } ?>
</div>
<!--end of product features-->
<hr/>




<?=
$this->load->view('admin/dashboard')?>
