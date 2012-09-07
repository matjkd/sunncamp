<div>
    
<?php if ($testimonial != NULL) {
    foreach ($testimonial as $row): ?>
<div class="newsDiv">
        

        <div class="newsContent">
            <h2><?= $row->title ?>
            
         
            <?php
            $is_logged_in = $this->session->userdata('is_logged_in');
            if (!isset($is_logged_in) || $is_logged_in == true) {
                echo " - <a href='" . base_url() . "admin/edit/" . $row->content_id . "'>edit</a><br/>";
            }
            ?></h2>
            <?php if($row->news_image != NULL) {?>
               <div class="newsImage">
            <img  src="https://s3-eu-west-1.amazonaws.com/<?= $this->bucket ?>/news/thumb_<?= $row->news_image ?>"/>
        </div>
        <?php }?>
            <?= $row->content ?>
            <p>
            <em><?= $row->added_by ?></em>
            </p>
        </div>
        <div style="clear:both">
        </div>
</div>
    <?php endforeach;
} ?>

</div>