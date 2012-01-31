
<table id="box-table-a">

    <?php foreach ($cart_list as $row): ?>

        <tr>
            <td>
                <?= $row->firstname ?>
            </td>
            
             <td>
              <a href="<?=base_url()?>backend/cart_admin/view_cart/<?= $row->cart_user_id ?>"> View Cart</a>
            </td>
            
             <td>
              <a href="<?=base_url()?>backend/cart_admin/view_orders/<?= $row->cart_user_id ?>"> View Orders</a>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
