<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>

        <?= $this->load->view('template/flyer/header') ?>

    </head>

    <body>

        <div id="header">

            <div id="logo" class="container_24">
                <div class="grid_18">
                    <img src="/images/template/flyerdirect/logo.png" width="188" height="66"/>
                </div>

                <div class="grid_6">
                    <img src="/images/template/flyerdirect/contact.png" />
                </div>

            </div>
            <div style="clear:both"></div>

            <div id="menutop">

                <div style="width:960px; margin:0 auto;">
                    <div style="float:left;">
                        <a href="http://mytrackpanel.com/trackit247/">Tracking</a>
                    </div>
                    <?= $this->load->view('global/flyer/menu') ?>
                </div> 
            </div>

            <?= $this->load->view('slideshow/flyer/slideshow') ?>

        </div>
        <div id="container">


            <div id="bodycontainer" class="container_24">

                <div class="clear"></div>

                <div id="textcontainer">
                    <?php
                    if (isset($sidebox) && $sidebox != NULL) {
                        $mainsize = "grid_12";
                    } else {
                        $mainsize = "grid_17";
                    }
                    ?>

                    <div class="grid_6">

<?= $this->load->view('sidebox/flyer') ?>
                    </div >





                    <div class="<?= $mainsize ?>">
<?= $this->load->view('global/alert') ?>
                        <?= $this->load->view($main_content) ?>


                    </div>

<?php if (isset($sidebox) && $sidebox != NULL) { ?>
                        <div class="grid_6">

    <?= $this->load->view($sidebox) ?>


                        </div>
<?php } ?>

                    <div class="clear"></div>
                </div>

            </div>

            <div class="container_24" id="footer">
                <div class="grid_18">
<?= $this->load->view('global/flyer/links') ?>
                </div>
                <div class="grid_6">
<?= $this->load->view('global/flyer/social_icons') ?>
                </div>
            </div>



        </div> 

        <div  id="backfooter" >
            <div class="container_24" >
                <div class="grid_14">
<?= $this->load->view('global/flyer/seo_menu') ?>

                </div>

                <div class="grid_10">
<?= $this->load->view('global/flyer/footer_menu') ?>
                </div>

            </div>
        </div>

        <!--! end of #container -->
<?= $this->load->view('template/flyer/footer') ?>

    </body>
</html>