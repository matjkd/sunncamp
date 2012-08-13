
<div style="padding: 25px;">
	<div class="clearfix"></div>
	<div class="grid_16">
		<div style="padding: 0px;">
			<h1>
				<?= $title ?>
			</h1>
		</div>
	</div>
	<div class="right_column">
		<?= $this->load->view('cart/frontcart') ?>
	</div>

	<div class="clearfix"></div>
	<hr />
	<div class="grid_16">

		<?php if ($products != NULL) { ?>





		<?php foreach ($products as $row): ?>
		<?php

		list($width, $height, $type, $attr) = getimagesize("https://s3-eu-west-1.amazonaws.com/<?=$bucket?>/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>");

		echo $width;
		?>

		<?php if($row->order == 0 ) { ?>
		<div id="productview">
			<a href="<?= base_url() ?>products/show/<?= $row->product_id ?>">
				<div style="border: 1px solid #999999; height: 106px; width: 134px; overflow: hidden; display:table; ">
					<div style="display:table-cell; vertical-align:middle; text-align: center;">
					<img  src="https://s3-eu-west-1.amazonaws.com/<?=$bucket?>/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>" />
					
</div>
				</div> <?= $row->product_name ?>
			</a>
		</div>
		<?php } ?>
		<?php endforeach; ?>

		<?php }else { ?>

		There are no Products in this Category, please check back soon.
		<?php } ?>
	</div>
	<div class="right_column">
		<?= $this->load->view('sidebox/product_cats') ?>
	</div>
</div>

