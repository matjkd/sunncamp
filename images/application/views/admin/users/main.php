
<div>




        <div id="generic_form">


            <div style="width:50%; float:left;">
             
                         <?=$this->load->view('admin/users/update_company')?>

            </div>



            <div style="width:45%; float:left;">
          

                    <?=$this->load->view('admin/users/list_company_users')?>

  <?=$this->load->view('admin/users/add_category_to_company')?>

            </div>

            <div style="clear:both;"></div>

        </div>

   

</div>

<div>
   <a href="<?= base_url() ?>user/user_admin/create_company"> <button> Create Company</button></a>
</div>
<table id="company_table" width=100%>
    <thead>
        <tr>
            <td>
                Company Name
            </td>
            <td>
                Company Type
            </td>

            <td>
                Visible on site
            </td>

            <td>
                Actions
            </td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($companies as $row): ?>

            <tr id="row_<?= $row->company_id ?>">
                <td>
                    <?= $row->company_name ?>
                </td>

                <td>
                    <?= $row->company_type_name ?>
                </td>

                <td>
                    <?= $row->visible_on_site ?>
                </td>

                <td>
                    <a href="<?= base_url() ?>user/user_admin/list_companies/<?= $row->company_id ?>">view</a>

                    |



                    <span class="spanlink" onclick="deleteCompany(<?= $row->company_id ?>)">delete</span>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
