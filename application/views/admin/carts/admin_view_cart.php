<h2>Cart</h2>   
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
        <?php } ?>
