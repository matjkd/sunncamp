<script type="text/javascript">

    function confirmation(id) {
        var answer = confirm("Are you sure you want to delete this product (including all variations)?")
        if (answer){
		
        
            $.post("/admin/delete_product/", { product_id: id } );
            window.location = "/admin/list_products/";
        }
        else{
            alert("nothing deleted!")
        }
    }
</script>
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
                <td><a href='#' onclick='confirmation(<?= $row->product_id ?>)'>DELETE</a> </td>
            </tr>




<?php endforeach;  }?>

    </tbody>



</table>
