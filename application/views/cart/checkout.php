
<div style="padding:25px;">
    <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:0px;">
            <h1>Checkout</h1>
        </div>
    </div>
    <div class="right_column">
        <?= $this->load->view('cart/frontcart') ?>
    </div>

    <div class="clearfix" >    </div>
    <hr/>
    <div class="grid_16">


        <table id="box-table-a">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Product Ref</th>

                    <th>Type</th>
                   <th>Item Cost</th>
                    <th>Total Cost</th>
                    
                    <th>In Cart</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($cart != NULL) {
                	$totalcost = NULL;
                    foreach ($cart as $row): ?>
                        <tr>
                            <td>
                                <a href="<?= base_url() ?>products/show/<?= $row->product_id ?>"><?= $row->product_name ?></a>
                            </td>

                            <td>
                                [<?= $row->product_ref ?>] <?= $row -> cart_id ?>
                            </td>

                            <td>
        <?= $row->option_category ?>: <?= $row->option ?>
                            </td>



      <td>
	<?=$this->currencybefore?><?=round($row->price*$this->convert, 2)?><?=$this->currencyafter?>
</td>                 

<td>
	<?=$this->currencybefore?><?php $thisprice = $row->quantity*$row->price; echo round($thisprice*$this->convert, 2);?><?=$this->currencyafter?>
</td>

                            

                            <td>
                                <span id="cart_<?= $row->option_id ?>"><?= $row->quantity ?></span>
                            </td> 








                        </tr>
    <?php 
    $totalcost = $totalcost + $thisprice;
	
    endforeach;
	$tax = $totalcost*0.2;
	$shipping = 10*$this->convert;
	$totalfinal = $shipping+$tax+$totalcost;
} ?>
<tr>
	<td></td>
<td></td>
<td></td>
<td>Tax (20%)</td>
<td><?=$this->currencybefore?><?=round($tax,2)?><?=$this->currencyafter?></td>
<td></td>
</tr>
<tr>
<tr>
	<td></td>
<td></td>
<td></td>
<td>Shipping</td>
<td><?=$this->currencybefore?><?=round($shipping, 2)?><?=$this->currencyafter?></td>
<td></td>
</tr>
<tr>
	<td></td>
<td></td>
<td></td>
<td>Total</td>
<td><?=$this->currencybefore?><?=round($totalfinal, 2)?><?=$this->currencyafter?></td>
<td></td>
</tr>
            </tbody>
        </table>
        <?php if ($cart == NULL) { ?>
            <p>Your Cart is empty</p>
        <?php } else { ?>
        
       
        <?=form_open(base_url().'usercart/process_payment')?>
        <?=form_hidden('cost', $totalfinal)?>
        <?=form_submit('mysubmit', 'pay with paypal')?>
        
        <?=form_close()?>
        <?php } ?>
        
        <hr>
       	<a href="<?=base_url()?>usercart/choose_shipping"><- Shipping</a>
    </div>
    <div class="right_column">
<?= $this->load->view('sidebox/product_cats') ?>
    </div>

