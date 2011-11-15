<div  id="sidebox">
<img  id="opener" src="<?=base_url()?>images/template/flyerdirect/quotebutton.png" />

<a href="<?=base_url()?>design"><img src="<?=base_url()?>images/template/flyerdirect/design.png" /></a>
<a href="<?=base_url()?>print"><img src="<?=base_url()?>images/template/flyerdirect/print.png" /></a>
</div>

<div id="dialog" title="Get a Free Quote" style="display:none; ">
    

    
    
<div id="quote_form">
	<?=form_open('email/quote');?>
	<br/>
        <p class="form_name">
            <?=form_label('Full Name')?><br/>
	<?=form_input('name', set_value('name'))?>
	</p>
        
        <p class="form_phone">
            <?=form_label('Phone Number')?><br/>
	<?=form_input('phone', set_value('phone'))?>
	</p>
	<p class="form_email">
            <?=form_label('Email')?><br/>
	<?=form_input('email', set_value('email'))?>
	</p>
        <?=form_label('Subject')?>
	<p class="form_subject">
	<?=form_input('qsubject', set_value('qsubject'))?>
	</p>
	
	<p class="form_message">
	<?=form_textarea('qmessage', set_value('qmessage'))?>
	</p>
	
Enter the word you see below<br/>



<input type="text" name="captcha" value="" /><br/>
                <?=form_label($captcha['image'])?>
</div>
	<?=form_hidden('ip_address', $this->input->ip_address())?>
	<?=form_hidden('time', $captcha['time'])?>
<div id="contact_submit"><?=form_submit('submit', 'Submit')?></div><br/>
	<?=form_close()?>
    
    
</div>