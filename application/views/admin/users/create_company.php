<h2>Create Company</h2>
<div id="generic_form">

    <?php echo form_open('user/user_admin/add_company'); ?>

    <p>

        <input type="text" name="company_name" />
        <label>Company Name</label>
    </p>
    <p>

        <input type="text" name="phone"/>
        <label>Phone</label>
    </p>
    <p>

        <input type="text" name="webaddress" />
        <label>Web Address</label>
    </p>
    <p>

        <input type="text" name="address1" />
        <label>Address 1</label>
    </p>
    <p>

        <input type="text" name="address2"/>
        <label>Address 2</label>
    </p>
    <p>

        <input type="text" name="address3" />
        <label>Address 3</label>
    </p>
    <p>

        <input type="text" name="address4" />
        <label>Address 4</label>
    </p>
    <p>

        <input type="text" name="address5" />
        <label>Address 5</label>
    </p>
    <p>

        <input type="text" name="postcode" />
        <label>Postcode</label>
    </p>

    <p>

        <select name="company_type">
            <option value="1">Stockist</option>
            <option value="2">Supplier</option>
            <option value="10">Other</option>
        </select>
        <label>Company Type</label>
    </p>
    <p>

        <select name="visible">
            <option value="0">No</option>
            <option value="1">Yes</option>
          
        </select>
        <label>Visible on site (under stockists, if stockist)</label>
    </p>
    <input type="submit" value="submit" />

</form>
</div>