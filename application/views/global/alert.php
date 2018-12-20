<?php

$notice = "Please Note, we are now closed for Christmas, and will open again on January 2nd 2019";
if (isset($message))
{
?>
		
			<div class="ui-widget" style="padding-bottom:10px;">
				<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'>
					<p>
					<span class='ui-icon ui-icon-alert' style='float:left; margin-top:0px; margin-right:.3em;'></span>
						
						
						<?=$message?>
										
					<a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'>
					<span class='ui-icon ui-icon-circle-close' style='float:right; margin-top:0px; margin-right:.3em;'></span>
					</a>
					</p>
				</div>
			</div>
		
	
<?php } ?>

<?php
if (isset($notice))
{
?>
		
			<div class="ui-widget" id="notice" style="padding-bottom:10px; margin-top:-30px;">
				<div class='ui-state-highlight ui-corner-all' style='padding: .7em;'>
					<div style="float:left; width:90%;">
					
						
						<?=$notice?>
					</div>	
					<div style="float:right;">				
					<a href='#' onclick='closeNotice()'>
					<span class='ui-icon ui-icon-circle-close' style='float:right; margin-top:0px; margin-right:.3em;'></span>
					</a>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		
	
<?php } ?>
<script type="text/javascript">
	
	function closeNotice() {
		
		$('#notice').fadeOut();
		$.ajax({url:"<?=base_url()?>welcome/hidenotice"});
		
	}
	
	
	
	
</script>


