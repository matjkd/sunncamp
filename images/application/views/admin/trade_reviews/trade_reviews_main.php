
<h2>Add Trade Review</h2>
<div id="generic_form">

    <?php echo form_open_multipart('backend/tradereviews_admin/do_upload'); ?>


    <input type="text" name="name" title="Name"/><br /><br />



    <br /><br/>
    <input type="file" name="userfile" size="20" /><br/>
    <br />

    <input type="submit" value="upload" />

</form>
</div>
<table id="box-table-a">

    <thead>
        <tr>
            <th>Name</th>
            <th>Filename</th>
            <th>Action</th>
        </tr>

    </thead>




    <?php foreach ($trade_reviews as $row2): ?>


        <tr id="row_<?= $row2->trade_review_id ?>">
            <td >
                <?= $row2->trade_review_title ?></td>
            <td><?= $row2->trade_review_filename ?></td>
            <td>
                <div style="float:right;" class="ui-icon ui-icon-circle-close spanlink" onclick="deleteTradeReview(<?= $row2->trade_review_id ?>, '<?= $row2->trade_review_filename ?>')">delete</div>
            </td>
            </td>
        </tr>


    <?php endforeach; ?>


</table>



