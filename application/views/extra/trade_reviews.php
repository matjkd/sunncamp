
<?php foreach($extra as $row):?>


<a href="https://s3-eu-west-1.amazonaws.com/<?=$bucket?>/trade_reviews/<?=$row->trade_review_filename?>"><?=$row->trade_review_title?></a><br/>

<?php endforeach; ?>
