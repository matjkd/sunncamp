<!--Main content page for sunncamp site-->

<?php foreach($content as $row):?>
<div style="padding:0px;">
  <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:10px;">
           <h1><?=$row->title?></h1>
        </div>
    </div>
    <div class="grid_8">
        <?=$this->load->view('cart/frontcart')?>
    </div>

    <div class="clearfix" >    </div>
    <hr/>
 <div class="grid_16">
<?php if(isset($row->image_strip)) { ?>
<img src="<?=base_url()?>images/titles/<?=$row->image_strip?>"/>
<?php } else { ?>

<?php } ?>
<?php 
$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in == true)
		{
			echo "<a href='".base_url()."admin/edit/".$row->content_id."'>edit this page</a><br/>";
		}	

?>

<?php if(isset($age)) { $body = str_replace("[age]", "$age", "$row->content"); }
else {
	$body = $row->content;
}?>


<?php  $body = str_replace("sunncamp", "<strong>SunnCamp</strong>", "$body");?>

<?=$body?>

<?php endforeach;?>


	<?php foreach($content as $row):?>
			<?php if($row->extra != NULL) {?>
			<?=$this->load->view('extra/'.$row->extra)?>
			<?php }?>
	<?php endforeach;?>
</div>
<div class="grid_8">
<?=$this->load->view('sidebox/product_cats')?>
</div>
</div>
