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
        <div id="header_container">
            <div id="header">

                <div  class="container_24" style="height:100px;">
                    <div class="grid_17">
                        <img style="margin-top:75px;" src="<? base_url() ?>images/template/sunncamp/tagline.png"/>
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

                        Side Box
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
                    <?= $this->load->view('global/sunncamp/links') ?>
                </div>
                <div class="grid_6">
                    <?= $this->load->view('global/sunncamp/social_icons') ?>
                </div>
            </div>



        </div> 

        <div  id="backfooter" >
            <div class="container_24" >
                <div class="grid_14">
                    <?= $this->load->view('global/sunncamp/seo_menu') ?>

                </div>

                <div class="grid_10">
                    <?= $this->load->view('global/sunncamp/footer_menu') ?>
                </div>

            </div>
        </div>

        <!--! end of #container -->
        <?= $this->load->view('template/flyer/footer') ?>

    </body>
</html>