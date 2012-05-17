[
<?php foreach($source as $row):?>
{ "id": "<?=$row['option_id']?>", "label": "<?=$row['option_category']?>", "value": "<?=$row['option_id']?>" }
<?php endforeach; ?>
]