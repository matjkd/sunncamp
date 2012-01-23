<?= $this->load->view('admin/dashboard') ?>
<!--add attributes/options and stock level-->



<div class="product_input_l" style="width:98%; margin-top:10px;">
    <h3>Product Attributes</h3>
    If this product has no options, just enter the stock level. 
    <div class="label">Attribute Category (eg. colour)</div>

    <input id="autocompleteoptions" name="option_category" value=""/>

    <div class="label">Attribute (eg. red)</div>

    <input id="option"  name="option" value=""/>

    <div class="label">Stock Level</div>

    <input id="stock_level" name="stock_level" value=""/>
    <input  type="hidden" name="product_id" value="<?= $product_id ?>"/>

    <span style="width:18px; float:right;" class="ui-icon ui-icon-circle-plus spanlink" onclick="addAttributetoProduct(<?= $product_id ?>)" ></span>   

    <hr/>
    <!--end of adding options-->

    <table id="attributes" width=100%>
        <thead>
            <tr>
                <td>Cat</td>
                <td>Option</td>
                <td>Stock</td>
                <td>Action</td>
            </tr>

        </thead>
        <tbody>


            <?php if ($attributes != NULL) {
                foreach ($attributes as $row): ?>

                    <tr id="row_<?= $row->option_id ?>">
                        <td> <input class="option_input" id="option_category_<?= $row->option_id ?>" name="option_category" value="<?= $row->option_category ?>"/></td>
                        <td> <input class="option_input" id="option_<?= $row->option_id ?>" name="option" value="<?= $row->option ?>"/></td>
                        <td> <input class="option_input" id="stock_level_<?= $row->option_id ?>" name="stock_level" value="<?= $row->stock_level ?>"/></td>

                        <td> <input  type="hidden" name="option_id" value="<?= $row->option_id ?>"/>
                            <input  type="hidden" name="product_id" value="<?= $row->product_id ?>"/>

                            <span  style="width:18px; float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteAttribute('<?= $row->option_id ?>')" ></span>
                            <span  style="width:18px; float:right;" class="ui-icon ui-icon-wrench spanlink" onclick="updateAttribute('<?= $row->option_id ?>')" ></span>


                        </td>
                    </tr>

                <?php endforeach;
            } ?>
        </tbody>

    </table>

</div>

<!--set product categories-->
<div class="product_input_l" style="width:98%; margin-top:10px;">


    <div class="ui-widget">

        <h3>Product Category</h3>

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

</div>
<!--end of product categories-->

<!--set product features-->
<div class="product_input_l" style="width:98%; margin-top:10px;">

    <?= form_open('admin/add_product_feature/' . $product_id) ?>
    <div class="ui-widget">

        <h3>Product Features</h3>

        <div> <select name="product_feature" id="feature_select">
                <?php foreach ($allfeatures as $row): ?>
                    <option value="<?= $row->feature_id ?>"><?= $row->feature_name ?></option>
                <?php endforeach; ?>
            </select> 
            <span style="width:18px; float:right;" class="ui-icon ui-icon-circle-plus spanlink" onclick="addFeaturetoProduct(<?= $product_id ?>)" ></span> 
        </div>



    </div>  
    <input  type="hidden" name="product_id" value="<?= $product_id ?>"/>

    <?= form_close() ?>

    <div id="features">      
        <?php if ($features != NULL) {
            foreach ($features as $row): ?>




                <div class="cattable" id="featurelink_<?= $row->feature_link_id ?>"><?= $row->feature_name ?>
                    <span  style="width:18px; float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteFeaturefromProduct('<?= $product_id ?>', '<?= $row->feature_link_id ?>')" >X</span></div>




            <?php endforeach;
        } ?>
    </div>
</div>
<!--end of product features-->
<hr/>





