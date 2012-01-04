<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Select Cateogry</h2>
<?=form_open('/admin/list_products')?>

<?php $cat[0] = 'All'; ?>
<?php foreach($categories as $row): ?>

<?php $cat[$row->product_category_id] = $row->product_category_name; ?>

<?php endforeach; ?>
<?=form_dropdown('cats', $cat)?>
<?=form_submit('submit', 'Submit')?>
<?=form_close()?>
