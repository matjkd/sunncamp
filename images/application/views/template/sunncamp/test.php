<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>

        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
             Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?= $title ?></title>
        <meta name="description" content="">
        <meta name="author" content="">


        <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="<?= base_url() ?>favicon.ico">
        <link rel="apple-touch-icon" href="<?= base_url() ?>apple-touch-icon.png">


        <!-- CSS : implied media="all" -->

        <link rel="stylesheet" href="<?= base_url() ?>css/grid.css">
        <link rel="stylesheet" href="<?= base_url() ?>css/style.css?v=2">

        <link rel="stylesheet" href="<?= base_url() ?>css/sunncamp/template.css">

        <link rel="stylesheet" href="<?= base_url() ?>css/black_blue/jquery-ui-1.8.16.custom.css">



        <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
        <script src="<?= base_url() ?>js/libs/modernizr-1.6.min.js"></script>


    </head>

    <body>
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
                        $mainsize = "grid_12";
                    } else {
                        $mainsize = "grid_17";
                    }
                    ?>

                    <div class="grid_6">

                      

                            <div class="ui-widget">
                                <label for="tags">Tags: </label>
                                <input id="tags">
                            </div>
                    

                    </div><!-- End demo -->


                    <!--! end of #container -->

                    <!-- Javascript at the bottom for fast page loading -->

                    <!-- Grab Google CDN's jQuery. fall back to local if necessary -->

                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"></script>
                    <script>!window.jQuery && document.write(unescape('%3Cscript src="<?= base_url() ?>js/libs/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script>

                    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>



                    <script type="text/javascript">
                        $(function() {
                            var availableTags = [
                                "ActionScript",
                                "AppleScript",
                                "Asp",
                                "BASIC",
                                "C",
                                "C++",
                                "Clojure",
                                "COBOL",
                                "ColdFusion",
                                "Erlang",
                                "Fortran",
                                "Groovy",
                                "Haskell",
                                "Java",
                                "JavaScript",
                                "Lisp",
                                "Perl",
                                "PHP",
                                "Python",
                                "Ruby",
                                "Scala",
                                "Scheme"
                            ];
                            $( "#tags" ).autocomplete({
                                source: availableTags
                            });
                        });

                    </script>



                    </body>
                    </html>