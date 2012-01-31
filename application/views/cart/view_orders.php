
  <?php if ($order != NULL) { ?>
  <h2>Your Orders</h2>
  <table id="box-table-a">
            <thead>
                <tr>
                
                    <th>Product</th>
                    <th>Product Ref</th>

                    <th>Type</th>
                   
                    <th>Quantity</th>
                    <th>Status</th>
                  
                </tr>
            </thead>
            <tbody>

                
                   <?php foreach ($order as $row): ?>
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
                                <span id="cart_<?= $row->option_id ?>"><?= $row->quantity ?></span>
                            </td> 

<td>
Ordered
</td>






                        </tr>
    <?php endforeach; ?>

            </tbody>
        </table>
        
        <?php } ?>
