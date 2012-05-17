<?php foreach($extra as $row):?>


<a href="<?=base_url()?>images/trade_reviews/<?=$row->trade_review_filename?>"><?=$row->trade_review_title?></a><br/>

<?php endforeach; ?>
