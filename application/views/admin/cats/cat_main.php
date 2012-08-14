<div style="float:left; clear:both;">
<?php
if (isset($cat_id)) {
    $cat_parent = $cat_id;
} else {
    $cat_parent = 0;
}
?>

<style>
    .sorting ul{ list-style-type: none; margin: 0; padding: 0; float: left; margin-right: 5px; min-height:50px; }
    .sorting li { margin: 0 3px 3px 3px; padding: 5px; font-size: 0.9em; line-height:10px; width: 132px;  }
</style>
<div >
    <h2>Create New Category Parent</h2>

    <?= form_open('backend/category_admin/add_category_parent/') ?>
    <div class="ui-widget">

        <div class="label">Parent Category</div>

        <input   name="category_parent" value=""/>

        <input type="submit" />  

    </div>  


    <?= form_close() ?>
</div>

<h2> Organise Categories</h2>
<div  class="sorting" style="clear:both;">






<?php $catcount = 1; ?>
    <?php foreach ($allcategory_parents as $row): ?>
    <?php if($catcount == 1) { 
        $div = "open";?>
    <div style="clear:both;" id="catdivider" >
    <?php } ?>
        <ul id="<?= $row->parent_id ?>"  class="connectedSortable " name="<?= $row->parent_name ?>">
        
            <li id ="<?= $row->parent_id ?>" class="ui-state-default"><?= $row->parent_name ?></li>

            <?php
            foreach ($allcategories as $row2):

                if ($row2->parent == $row->parent_id) {
                    ?>

                    <li id="<?= $row2->product_category_name ?>"  class="ui-state-highlight"><a href="<?= base_url() ?>products/category/<?= $row2->category_safename ?>"><?= $row2->product_category_name ?></a></li>
                <?php }
                
                
            endforeach; ?>

        </ul>
        <?php 
        $catcount = $catcount + 1; 
        if($catcount == 5 ) { 
         $catcount = 1;
         $div = "closed";?>
         
       
    </div>
        <?php } ?>
    <?php endforeach; ?>
    
<?php if($div = "open") { ?>
</div>
    <?php } ?>
    <div style="clear:both;"></div>
</div>

