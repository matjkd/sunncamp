<!--Main content page for sunncamp site-->
<div style="padding:25px;">


<?php foreach($content as $row):?>
<?php if(isset($row->image_strip)) { ?>
<img height="209px" width="910px" alt="<?=$row->title?>" src="<?=base_url()?>images/titles/<?=$row->image_strip?>"/>
<?php } else { ?>
<h1><?=$row->title?></h1>
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
