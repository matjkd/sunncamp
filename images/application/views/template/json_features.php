[
<?php foreach($source as $row):?>
{ "id": "<?=$row['feature_id']?>", "label": "<?=$row['feature_name']?>", "value": "<?=$row['feature_id']?>" }
<?php endforeach; ?>
]