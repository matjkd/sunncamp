<h2>Categories</h2>
<p>If this company is a stockist, add the categories of products they stock here:</p>

<div id="generic_form">
    <?= form_open('user/user_admin/add_cat_to_company') ?>
    <div class="ui-widget">
        <label>Category: </label>
        <select name="category_id" id="combobox">
            <option value="">Select one...</option>
            <?php foreach ($categories as $row): ?>

                <option value="<?= $row->product_category_id ?>"><?= $row->product_category_name ?></option>

            <?php endforeach; ?>
        </select>
    </div>
    <?php foreach ($company as $row): ?>  
        <input type='hidden' value='<?= $row->company_id ?>' name="company_id"/>
    <?php endforeach; ?>
        <input class="button" type="submit" value="Add Category" />
    <?= form_close() ?>
</div>


<?php foreach($company_categories as $row):?>

<div class="product_cat_list">
<?=$row->product_category_name?>
</div>

<?php endforeach; ?>
