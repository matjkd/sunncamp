<?php if (isset($cat_id)) {
    $cat_parent = $cat_id;
} else {
    $cat_parent = 0;
} ?>

<div id="sidecats">
    <div style="padding:0 5px;">
        <h3>Categories</h3> 
    </div>
    <ul id="catmenu" class="catmenu noaccordion expandfirst">
                <?php foreach ($category_parents as $row): ?>
                 <?php if($row->parent_id > 0) {?>
            <li style="position:static;">
<?php $parent_name = str_replace('and', '&amp;', $row->parent_name); ?>
                <a href="#"><?= $parent_name ?></a>
                <ul style="display:block;" <?php if ($cat_parent == $row->parent_id) { ?>class="current"<?php } ?>>
                    <?php
                    foreach ($categories as $row2):

                        if ($row2->parent == $row->parent_id) {
                            ?>
<?php $cat_name = str_replace('and', '&amp;', $row2->product_category_name); ?>
                            <li><a href="<?= base_url() ?>products/category/<?= $row2->category_safename ?>"><?= $cat_name ?></a></li>
                <?php }
            endforeach; ?>
                </ul>
            </li>
            <?php }?>
<?php endforeach; ?>
    </ul>
</div>
