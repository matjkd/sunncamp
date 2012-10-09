    <?php foreach ($company as $row): ?>  
<h2>Company Details</h2>
                <?php echo form_open('user/user_admin/update_company'); ?>
                <input type="hidden" name="address_id" value="<?= $row->address_id ?>"/>
                <input type="hidden" name="company_id" value="<?= $row->company_id ?>"/>
                <p>

                    <input type="text" name="company_name" value="<?= set_value('company_name', $row->company_name) ?>"/>
                    <label>Company Name</label>
                </p>
                <p>

                    <input type="text" name="phone"  value="<?= set_value('phone', $row->company_phone) ?>"/>
                    <label>Phone</label>
                </p>
                <p>

                    <input type="text" name="webaddress" value="<?= set_value('webaddress', $row->company_web) ?>" />
                    <label>Web Address</label>
                </p>
                <p>

                    <input type="text" name="address1" value="<?= set_value('address1', $row->address1) ?>"/>
                    <label>Address 1</label>
                </p>
                <p>

                    <input type="text" name="address2" value="<?= set_value('address2', $row->address2) ?>"/>
                    <label>Address 2</label>
                </p>
                <p>

                    <input type="text" name="address3" value="<?= set_value('address3', $row->address3) ?>"/>
                    <label>Address 3</label>
                </p>
                <p>

                    <input type="text" name="address4" value="<?= set_value('address4', $row->address4) ?>"/>
                    <label>Address 4</label>
                </p>
                <p>

                    <input type="text" name="address5" value="<?= set_value('address5', $row->address5) ?>"/>
                    <label>Address 5</label>
                </p>
                <p>

                    <input type="text" name="postcode" value="<?= set_value('postcode', $row->postcode) ?>" />
                    <label>Postcode</label>
                </p>

                <p>

                    <?php
                    $stockist = "";
                    $supplier = "";
                    $other = "";
                    if ($row->company_type == "1") {
                        $stockist = "selected='selected'";
                    }
                    if ($row->company_type == "2") {

                        $supplier = "selected='selected'";
                    }
                    if ($row->company_type == "10") {
                        $other = "selected='selected'";
                    }
                    ?>
                    <select name="company_type">


                        <option value="1" <?= $stockist ?> >Stockist</option>
                        <option value="2" <?= $supplier ?>>Supplier</option>
                        <option value="10" <?= $other ?>>Other</option>
                    </select>
                    <label>Company Type</label>
                </p>
                <p>
                    <?php
                    $visibleyes = "";
                    $visibleno = "";
                    if ($row->visible_on_site == "0") {
                        $visibleno = "selected='selected'";
                    }
                    if ($row->visible_on_site == "1") {

                        $visibleyes = "selected='selected'";
                    }
                    ?>
                    <select name="visible">
                        <option value="0" <?= $visibleno ?>>No</option>
                        <option value="1" <?= $visibleyes ?>>Yes</option>

                    </select>
                    <label>Visible on site (under stockists, if stockist)</label>
                </p>
                <input type="submit" value="update" />

               <?=form_close()?>
 <?php endforeach; ?>