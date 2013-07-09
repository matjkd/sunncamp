

<div style="padding:25px;">
    <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:0px;">
            <h1><?=$title?></h1>
        </div>
    </div>
    <div class="right_column">
        <?= $this->load->view('cart/frontcart') ?>
    </div>

    <div class="clearfix" >    </div>
    <hr/>
    <div class="grid_16">


       <?php if($user_data[0]->address1 == NULL) { ?>
       	
       	
     <?=$this->load->view('cart/add_address')?>
       	
       	
       	<? } ?>
       
       
      <?php foreach($user_data as $row): ?>
      <h4>Shipping</h4>	
      	First Class
      	<?php endforeach; ?>
      	<br/>
      	
      	
      	
<hr>
      	<a href="<?=base_url()?>usercart/shipping_address"><- Address</a> | <a href="<?=base_url()?>usercart/checkout">Checkout -></a>
    </div>
    <div class="right_column">
<?= $this->load->view('sidebox/product_cats') ?>
    </div>


