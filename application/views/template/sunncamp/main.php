<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>

        <?= $this->load->view('template/sunncamp/header') ?>

    </head>

    <body>
          <input type="hidden" id="baseurl" value="<?=base_url()?>"/>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=172890976123402";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
    
      <?php $is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if($is_logged_in != NULL && $role < 2)
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
                        <img style="margin-top:45px;" src="<?= base_url() ?>images/template/sunncamp/tagline.png"/>
                    </div>

                    <div id="logo" class="grid_7">

                    </div>

                </div>
                <div style="clear:both"></div>

                <div id="menutop">

                    <div style="width:960px; margin:0 auto;">

                        <?= $this->load->view('global/sunncamp/menu') ?>
                    </div> 
                </div>



            </div>
        </div>   
        <div id="container">

            <?php if (isset($slideshow) && $slideshow != NULL) { ?>
                <div id="slideshow_container" class="container_24">
                    <?= $this->load->view($slideshow) ?>
                </div>
            <?php } ?>

            <div id="bodycontainer" class="container_24">

                <div class="clear"></div>

                <div id="textcontainer">
                    <?php
                    if (isset($sidebox) && $sidebox != NULL) {
                        $mainsize = "container_24";
                    } else {
                        $mainsize = "container_24";
                    }
                    ?>

         





                    <div class="<?= $mainsize ?>" >
                        <div style="padding:0px;">
                        <?= $this->load->view('global/alert') ?>
                        <?= $this->load->view($main_content) ?>
                           
                           
                        </div>

                    </div>

                  


                </div>
                <div class="clear"></div>
            </div>

            <div class="container_24" >
                 <div id="footer">
                
                    <?= $this->load->view('global/sunncamp/social_icons') ?>
                </div>
            </div>



        </div> 





        <!--! end of #container -->
        <?= $this->load->view('template/sunncamp/footer') ?>


    </body>
</html>
