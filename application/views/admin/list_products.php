
<table id="product_table" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Column 2</th>
            <th>option type</th>
            <th>option</th>
            <th>stock</th>
            <th>actions</th>
        </tr>
    </thead>


    <tbody>

        <?php
        if($products != NULL) {
        foreach ($products as $row):
            ?>

            <tr>
                <td>  <a href="<?= base_url() ?>admin/add_product/<?= $row->product_id ?>"><?= $row->product_id ?></a> </td>
                <td> <a href="<?= base_url() ?>admin/add_product/<?= $row->product_id ?>"><?= $row->product_name ?></a></td>
                <td><?= $row->option_category ?></td>
                <td><?= $row->option ?></td>
                <td><?= $row->stock_level ?></td>
                <td><a href='#' onclick='deleteProduct(<?= $row->product_id ?>)'>DELETE</a> </td>
            </tr>




<?php endforeach;  }?>

    </tbody>



</table>
