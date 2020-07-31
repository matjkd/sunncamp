
<div style="padding: 25px;">
	<div class="clearfix"></div>
	<div class="grid_16">
		<div style="padding: 0px;">
			<h1>
				Search Results
			</h1>
		</div>
	</div>
	<div class="right_column">
		<?= $this->load->view('cart/frontcart') ?>
	</div>

	<div class="clearfix"></div>
	<hr />
	<div class="grid_16">
You searched for "<?=$term?>". <br/>
		<?php if ($products != NULL) { ?>
		
		





		<?php foreach ($products as $row): ?>
		
		<?php
                
                //check if s3 file exists
                $remoteFile = base_url()."images/products/".$row -> product_id."/thumbs/".$row->filename;
                
                if(!getimagesize($remoteFile)){
                // echo "s3 ";
                    $fileThumb = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$row -> product_id."/thumbs/".$row->filename;
                    $fileMedium = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$row -> product_id."/medium/".$row->filename;
                    $fileLarge = "https://s3-eu-west-1.amazonaws.com/".$bucket."/products/".$row -> product_id."/large/".$row->filename;
                
		
		} else {
                 //  echo "local ";
			$fileThumb = base_url()."images/products/".$row -> product_id."/thumbs/".$row->filename;
                    $fileMedium = base_url()."images/products/".$row -> product_id."/medium/".$row->filename;
                    $fileLarge = base_url()."images/products/".$row -> product_id."/large/".$row->filename;
                
                }
               
    
                ?>
		

		<?php if($row->order == 0 ) { ?>
		<div id="productview">
			<a href="<?= base_url() ?>products/show/<?= $row->product_id ?>">
				<div style="border: 1px solid #999999; height: 106px; width: 134px; overflow: hidden; display:table; ">
					<div style="display:table-cell; vertical-align:middle; text-align: center;">
					<img  src="<?=$fileThumb?>" />
					
</div>
				</div> <?= $row->product_name ?>
			</a>
		</div>
		<?php } ?>
		<?php endforeach; ?>

		<?php }else { ?>

		Your search returned no results<br/>
		<?php } ?>
	</div>
	<div class="right_column">
		<?= $this->load->view('sidebox/product_cats') ?>
	</div>
</div>

