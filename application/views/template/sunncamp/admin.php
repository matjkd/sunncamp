<!doctype html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<head>

		<?= $this -> load -> view('template/sunncamp/header') ?>

	</head>

	<body>
		<input type="hidden" id="baseurl" value="<?=base_url() ?>"/>
		<?php $is_logged_in = $this -> session -> userdata('is_logged_in');
			$role = $this -> session -> userdata('role');
			if ($is_logged_in != NULL && $role < 2)
			{
				echo "<div class='admin_menu_container'><div class='admin_menu'>";
				echo anchor('/admin/list_products', 'Admin');
				echo anchor('https://www.pivotaltracker.com/projects/446901', 'Support', 'target=_blank');
				echo "</div></div>";
			}
		?>
		<div id="header_container">

			<div id="header">

				<div  class="container_24" style="height:100px;">
					<div class="grid_17" style="margin-left:0;">
						<img style="margin-top:75px;" src="<?= base_url() ?>images/template/sunncamp/tagline.png"/>
					</div>

					<div id="logo" class="grid_7">

					</div>

				</div>
				<div style="clear:both"></div>

				<div id="menutop">

					<div style="width:960px; margin:0 auto;">

						<?= $this -> load -> view('global/sunncamp/menu') ?>
					</div>
				</div>

			</div>
		</div>
		<div id="container">

			<?php if (isset($slideshow) && $slideshow != NULL) { ?>
			<div id="slideshow_container" class="container_24">
				<?= $this -> load -> view($slideshow) ?>
			</div>
			<?php } ?>

			<div id="bodycontainer" class="container_24">

				<div class="clear"></div>

				<div style="padding:25px;">
					<?php
						if (isset($sidebox) && $sidebox != NULL)
						{
							$mainsize = "grid_12";
						}
						else
						{
							$mainsize = "grid_16";
						}
					?>

					<div class="<?= $mainsize ?>">
						<?= $this -> load -> view('global/alert') ?>
						<?= $this -> load -> view($main_content) ?>

					</div>

					<div class="right_column">

						<?php
							if (isset($leftside) && $leftside != NULL)
							{
								$this -> load -> view($leftside);
							}
							else
							{

							}
						?>
					</div >

					<?php if (isset($sidebox) && $sidebox != NULL) {
					?>
					<div class="grid_7">

						<?= $this -> load -> view($sidebox) ?>

					</div>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="container_24" >
				<div id="footer">

					<?= $this -> load -> view('global/sunncamp/social_icons') ?>
				</div>
			</div>

		</div>

		<!--! end of #container -->
		<!-- Javascript at the bottom for fast page loading -->

		<!-- Grab Google CDN's jQuery. fall back to local if necessary -->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"></script>
		<script>
			!window.jQuery && document.write(unescape('%3Cscript src="<?= base_url() ?>
			js / libs / jquery - 1.6
			.2.min.js"%3E%3C/script%3E'))
		</script>

		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>

		<!-- scripts concatenated and minified via ant build script-->
		<script src="<?= base_url() ?>js/wymeditor/jquery.wymeditor.min.js"></script>

		<script src="<?= base_url() ?>js/plugins.js"></script>
		
		<script src="<?= base_url() ?>js/jeditable.js"></script>

		<script src="<?= base_url() ?>js/libs/jquery.dataTables.min.js"></script>

		<script src="<?= base_url() ?>js/script.js"></script>
		<script src="<?= base_url() ?>js/sunncamp/script.js"></script>
		<script src="<?= base_url() ?>js/sunncamp/adminscript.js"></script>

		<!-- end concatenated and minified scripts-->

		<!--[if lt IE 7 ]>
		<script src="<?= base_url() ?>js/libs/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg
		background-images </script>
		<![endif]-->

	</body>
</html>
