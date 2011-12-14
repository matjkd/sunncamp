[
<?php foreach($source as $row):?>
{ "id": "<?=$row['product_category_id']?>", "label": "<?=$row['product_category_name']?>", "value": "<?=$row['product_category_id']?>" }
<?php endforeach; ?>
]