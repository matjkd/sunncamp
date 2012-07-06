<div class="stockistMenu">
	<?php foreach($category_parents as $row):?>
	<div class="stockistButton" id="<?=$row->parent?>">
		<?=$row->parent_name?>
		<br />
	</div>
	<?php endforeach;?>
	<div style="clear: both"></div>
</div>
<div style="clear:both">
<?php foreach($stockists as $row):?>
<div class="stockist <?=$row->parent?>" style="display: none;">
	<strong><?=$row->company_name?> </strong> <br />

	<?php if($row->address1 != NULL) {?>
	<?=$row->address1?>
	<br />
	<?php } ?>

	<?php if($row->address2 != NULL) {?>
	<?=$row->address2?>
	<br />
	<?php } ?>

	<?php if($row->address3 != NULL){?>
	<?=$row->address3?>
	<br />
	<?php } ?>

	<?php if($row->address4 != NULL){?>
	<?=$row->address4?>
	<br />
	<?php } ?>

	<?php if($row->address5 != NULL){?>
	<?=$row->address5?>
	<br />
	<?php } ?>

	<?php if($row->company_phone != NULL){?>
	<?=$row->company_phone?>
	<br />
	<?php } ?>

	<?php if($row->postcode != NULL){?>
	<?=$row->postcode?>
	<br />
	<?php } ?>

	<?php if($row->company_web != NULL){?>
	<a href="http://<?=$row->company_web?>"><?=$row->company_web?> </a>
	<?php } ?>
</div>
<?php endforeach;?>
</div>