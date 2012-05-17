<div id="sidecats">
    <div style="padding:0 5px;">
        <h3>Please Choose from the products below</h3> 
    </div>
<ul id="catmenu" class="catmenu noaccordion expandfirst">
    <?php foreach ($extra2 as $row): ?>

        <li style="position:static;">

            <a href="#"><?= $row->manual_cat ?></a>
            <ul style="display:block;">
                <?php
                foreach ($extra as $row2):

                    if ($row2->manual_category == $row->manual_cat_id) {
                        ?>

                        <li><a target="_blank" href="https://s3-eu-west-1.amazonaws.com/<?=$bucket?>/manuals/<?= $row2->manual_filename ?>"><?= $row2->manual_title ?></a></li>
                    <?php } endforeach; ?>
            </ul>
        </li>

    <?php endforeach; ?>
</ul>
</div>