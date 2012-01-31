
<div style="padding:25px;">
    <div class="clearfix" >    </div>
    <div class="grid_16">
        <div style="padding:0px;">
            <h1>Your Cart</h1>
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
                    <th>In Stock</th>
                    <th>Quantity</th>
                    <th>In Cart</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($cart != NULL) {
                    foreach ($cart as $row): ?>
                        <tr>
                            <td>
                                <a href="<?= base_url() ?>products/show/<?= $row->product_id ?>"><?= $row->product_name ?></a>
                            </td>

                            <td>
                                [<?= $row->product_ref ?>]
                            </td>

                            <td>
        <?= $row->option_category ?>: <?= $row->option ?>
                            </td>



                            <td>
                                <span style="color:#555555;" id="stock_<?= $row->option_id ?>"><?= $row->stock_level ?>   </span>
                            </td>



                            <td>
                                <span  style="width:18px; float:left;" class="ui-icon ui-icon-circle-minus spanlink" onclick="lowerstock('<?= $user_id ?>', '<?= $row->option_id ?>')" ></span>  

                                <span  style="width:18px; float:left;" class="ui-icon ui-icon-circle-plus spanlink" onclick="raisestock('<?= $user_id ?>', '<?= $row->option_id ?>')" ></span> 

                            </td> 

                            <td>
                                <span id="cart_<?= $row->option_id ?>"><?= $row->quantity ?></span>
                            </td> 








                        </tr>
    <?php endforeach;
} ?>
            </tbody>
        </table>
        <?php if ($cart == NULL) { ?>
            <p>Your Cart is empty</p>
        <?php } else { ?>
        
        <a href="<?=base_url()?>usercart/make_order">Place Order</a>
        
        <?php } ?>
        
        <?=$this->load->view('cart/view_orders')?>
    </div>
    <div class="right_column">
<?= $this->load->view('sidebox/product_cats') ?>
    </div>

