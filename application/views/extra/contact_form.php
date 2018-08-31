<div id="contact_form">
    <?= form_open('email/send'); ?>
    <br/>
    <p class="form_name">
        <?= form_label('Full Name *') ?><br/>
        <?= form_input('name', set_value('name')) ?>
    </p>

    <p class="form_phone">
        <?= form_label('Phone Number *') ?><br/>
        <?= form_input('phone', set_value('phone')) ?>
    </p>
    <?= form_label('Email *') ?>
    <p class="form_email">
        <?= form_input('email') ?>
    </p>
    <?= form_label('Address 1 *') ?>
    <p class="form_address">
        <?= form_input('address1') ?>
    </p>
    <?= form_label('Address 2 *') ?>
    <p class="form_address">
        <?= form_input('address2') ?>
    </p>
    <?= form_label('Town *') ?>
    <p class="form_town">
        <?= form_input('town') ?>
    </p>
    <?= form_label('County *') ?>
    <p class="form_address">
        <?= form_input('county') ?>
    </p>
    <?= form_label('Postcode *') ?>
    <p class="form_address">
        <?= form_input('postcode') ?>
    </p>
    <?= form_label('Subject') ?>
    <p class="form_subject">
        <?= form_input('subject') ?>
    </p>
    <?= form_label('Message') ?>
    <p class="form_message">
        <?= form_textarea('message') ?>
    </p>
    <p><div class="g-recaptcha" data-sitekey="6LdsD2YUAAAAACECQ2_K2nPfioNHDKm1w4Ua5J96"></div></p>
* required fields
  </div>
<?= form_hidden('ip_address', $this->input->ip_address()) ?>
<?= form_hidden('time', $captcha['time']) ?>
<div id="contact_submit"><?= form_submit('submit', 'Submit') ?></div><br/>
<?=
form_close()?>
