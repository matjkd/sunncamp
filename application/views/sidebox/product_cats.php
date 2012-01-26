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
            <li style="position:static;">

                <a href="#"><?= $row->parent_name ?></a>
                <ul style="display:block;" <?php if ($cat_parent == $row->parent_id) { ?>class="current"<?php } ?>>
                    <?php
                    foreach ($categories as $row2):

                        if ($row2->parent == $row->parent_id) {
                            ?>

                            <li><a href="<?= base_url() ?>products/category/<?= $row2->category_safename ?>"><?= $row2->product_category_name ?></a></li>
                <?php }
            endforeach; ?>
                </ul>
            </li>
<?php endforeach; ?>
    </ul>
</div>
