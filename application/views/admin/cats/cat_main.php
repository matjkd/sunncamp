<?php
if (isset($cat_id)) {
    $cat_parent = $cat_id;
} else {
    $cat_parent = 0;
}
?>

<style>
  .sorting ul{ list-style-type: none; margin: 0; padding: 0; float: left; margin-right: 10px; }
    .sorting li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
</style>
<div style="clear:both; width:700px;">
    <h1>Create New Category Parent</h1>

    <?= form_open('backend/category_admin/add_category_parent/') ?>
    <div class="ui-widget">

        <div class="label">Parent Category</div>

        <input   name="category_parent" value=""/>

        <input type="submit" />  

    </div>  


    <?= form_close() ?>
</div>

<h1> Organise Categories</h1>
<div style="clear:both; width:700px;" class="sorting">







    <?php foreach ($category_parents as $row): ?>
        <ul id="<?=$row->parent_id?>"  class="connectedSortable " name="<?=$row->parent_name?>">
            <li id ="<?= $row->parent_id ?>" class="ui-state-default"><?= $row->parent_name ?></li>

            <?php
            foreach ($categories as $row2):

                if ($row2->parent == $row->parent_id) {
                    ?>

                    <li id="<?=$row2->product_category_name?>"  class="ui-state-highlight"><a href="<?= base_url() ?>products/category/<?= $row2->product_category_name ?>"><?= $row2->product_category_name ?></a></li>
                <?php }
            endforeach; ?>

        </ul>
    <?php endforeach; ?>

</div>

