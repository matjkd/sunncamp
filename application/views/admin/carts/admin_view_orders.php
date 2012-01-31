<h2>Ordered</h2>   
<table id="box-table-a">
    <thead>
        <tr>
            <th>Product</th>
            
            <th>Product Ref</th>
 <th>Date Ordered</th>
            <th>Type</th>
            <th>In Stock</th>

            <th>In Cart</th>

            <th>Order Status</th>
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
                       date ordered
                    </td>
                    
                    <td>
                        <?= $row->option_category ?>: <?= $row->option ?>
                    </td>



                    <td>
                        <span style="color:#555555;" id="stock_<?= $row->option_id ?>"><?= $row->stock_level ?>   </span>
                    </td>




                    <td>
                        <span id="cart_<?= $row->option_id ?>"><?= $row->quantity ?></span>
                    </td> 


                    <td>
                        Order status
                    </td> 





                </tr>
            <?php endforeach;
        } ?>
    </tbody>
</table>
<?php if ($cart == NULL) { ?>
    <p>Your Cart is empty</p>
<?php } ?>
