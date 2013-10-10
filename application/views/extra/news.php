<div>
    
<?php if ($news != NULL) {
    foreach ($news as $row): ?>
<div class="newsDiv">
        

        <div class="newsContent">
            <h1><?= $row->title ?>
            
         
            <?php
            $is_logged_in = $this->session->userdata('is_logged_in');
            if (!isset($is_logged_in) || $is_logged_in == true) {
                echo " - <a href='" . base_url() . "admin/edit/" . $row->content_id . "'>edit</a><br/>";
            }
            ?></h1>
              
            <img  class="newsImage" src="https://s3-eu-west-1.amazonaws.com/<?= $this->bucket ?>/news/thumb_<?= $row->news_image ?>"/>
        
            <?= $row->content ?>
        </div>
        <div style="clear:both">
        </div>
</div>
    <?php endforeach;
} ?>

</div>