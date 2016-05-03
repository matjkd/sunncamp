<style type="text/css">
	.brochureLinks {
		float: left;
		width:120px;
		text-align: center;
		padding: 10px 0px 10px 0px;
	}
	.brochureLinks img {
		width: 100px;
		height: 100px;
		-moz-box-shadow: 10px 6px 29px #ddd;
-webkit-box-shadow: 10px 6px 29px #ddd;
box-shadow: 10px 6px 29px #ddd;
	}
</style>

<div class="brochureLinks stockistButton" id="9">
	<img src="https://s3-eu-west-1.amazonaws.com/sunncamp/images/trailerTents.jpg"/>
	<br/>
	
	</div>
<div class="brochureLinks  stockistButton" id="10">
	<img src="https://s3-eu-west-1.amazonaws.com/sunncamp/images/awnings.jpg"/>
	<br/>
	
</div>
<div class="brochureLinks  stockistButton" id="15">
	<img src="https://s3-eu-west-1.amazonaws.com/sunncamp/images/accessories.jpg"/>
	<br/>
	
</div>
<div class="brochureLinks  stockistButton" id="21">
	<img src="https://s3-eu-west-1.amazonaws.com/sunncamp/images/tents.jpg"/>
	<br/>
	
</div>

<div class="brochureLinks  stockistButton" id="34">
	<img src="/images/icons/partytents.jpg"/>
	<br/>
	
</div>





<div style="clear:both">
<?php foreach($stockists as $row):?>

<div class="stockist <?=$row->parent_id?>" style="display: none;">
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

	

	<?php if($row->postcode != NULL){?>
	<?=$row->postcode?>
	<br />
	<?php } ?>
	
	<?php if($row->company_phone != NULL){?>
	<span class="highlight"><?=$row->company_phone?></span>
	<br />
	<?php } ?>

	<?php if($row->company_web != NULL){?>
	<a href="http://<?=$row->company_web?>"><?=$row->company_web?> </a>
	<?php } ?>
</div>
<?php endforeach;?>
</div>