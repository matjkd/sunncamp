[
<?php foreach($source as $row):?>
{ "id": "<?=$row['spec_id']?>", "label": "<?=$row['spec_desc']?>", "value": "<?=$row['spec_id']?>" }
<?php endforeach; ?>
]