<div id="sidecats">
    product categories<br/>
    
    <?php foreach($categories as $row): ?>

    <p><a href="<?=base_url()?>products/category/<?=$row->product_category_name?>"><?=$row->product_category_name?></a></p>

<?php endforeach; ?>
</div>