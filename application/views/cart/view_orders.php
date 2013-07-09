
<?php if ($order != NULL) { ?>
    <h3>Previous Orders</h3>
     <?php foreach ($order_ids as $row2): ?>
     	
     	Order ID:<?= $row2 -> order_id ?>. 
     	
     	 <?php
							$datestring = " %d/%m/%Y - %h:%i %a";
							$time = $row2 -> date_created;

							$data['datetime'] = mdate($datestring, $time);
                        ?>

                        <?= $data['datetime'] ?>
     	
    <table id="box-table-a">
        <thead>
            <tr>

                <th>Product</th>
                <th>Product Ref</th>
                
                <th>Type</th>

                <th>Quantity</th>
                <th>Cost</th>
               

            </tr>
        </thead>
        <tbody>


            <?php foreach ($order as $row): ?>
            	<?php if($row->order_id == $row2->order_id) { ?>
                <tr>
                    <td>
                        <a href="<?= base_url() ?>products/show/<?= $row -> product_id ?>"><?= $row -> product_name ?></a>
                    </td>

                    <td>
                        [<?= $row -> product_ref ?>] <?= $row -> cart_id ?>
                    </td>

                    
                       
                   

                    <td>
        <?= $row -> option_category ?>: <?= $row -> option ?>
                    </td>









                    <td>
                        <span id="cart_<?= $row -> option_id ?>"><?= $row -> quantity ?></span>
                    </td>
                     
 					<td>
        <?= $row -> orderedprice * $row -> quantity ?>
                    </td>
                    
                   






                </tr>
                <?php } ?>
    <?php endforeach; ?>

        </tbody>
    </table>
    
     Order Status: <?= $row2 -> status_of_order ?> (Paypal Ref:<?= $row2 -> paypalref ?>)
    <hr>
<?php endforeach; ?>
<?php } ?>
