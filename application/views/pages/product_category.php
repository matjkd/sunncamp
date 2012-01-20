<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?= $title ?></h1>

<?php foreach ($products as $row): ?>

    <div id="productview" >
        <a href="<?=base_url()?>products/show/<?= $row->product_id ?>">
        <div style="border:1px solid #333333; background:url('/images/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>'); height:100px; width:100px;"></div>
    
        <?= $row->product_name ?>
        </a>
    </div>
<?php endforeach; ?>

