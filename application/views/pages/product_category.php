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
        <img height="100px" width="135px" src="<?= base_url() ?>images/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>" /></br>
        <?= $row->product_name ?> 
        </a>
    </div>
<?php endforeach; ?>

