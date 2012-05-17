<h3>Users</h3>
<table id="box-table-a">
    <thead>

        <tr>
            <th>
                Name
            </th>

            <th>
                Role
            </th>

            <th>
                Actions
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $row): ?>
            <tr id="row_<?= $row->user_id ?>">
                <td><?= $row->firstname ?> <?= $row->lastname ?></td>
                <td><?= $row->role ?> </td>
                <td>
                    <a href="<?=base_url()?>user/user_admin/view_user/<?=$row->user_id?>">edit</a>

                    |

                    <span  style="width:18px; float:right;" class="ui-icon ui-icon-circle-close  spanlink" onclick="deleteUser('<?= $row->user_id ?>')" ></span>
                </td>




            </tr>



        <?php endforeach; ?>
    </tbody>
</table>
<p>
    <span class="spanlink" id="create-user">Add User</span>
</p>

<div id="dialog-form" class="ui-widget">

    <?= $this->load->view('admin/users/create_user_form') ?>

</div>