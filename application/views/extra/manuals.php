<ul id="catmenu" class="catmenu noaccordion expandfirst">
    <?php foreach ($extra2 as $row): ?>

        <li style="position:static;">

            <a href="#"><?= $row->manual_cat ?></a>
            <ul style="display:block;">
                <?php
                foreach ($extra as $row2):

                    if ($row2->manual_category == $row->manual_cat_id) {
                        ?>

                        <li><a target="_blank" href="<?= base_url() ?>images/manuals/<?= $row2->manual_filename ?>"><?= $row2->manual_title ?></a></li>
                    <?php } endforeach; ?>
            </ul>
        </li>

    <?php endforeach; ?>
</ul>
