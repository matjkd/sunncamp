
<!-- Javascript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery. fall back to local if necessary -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?= base_url() ?>js/libs/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>



<!-- scripts concatenated and minified via ant build script-->
<script src="<?= base_url() ?>js/wymeditor/jquery.wymeditor.min.js"></script>

<script src="<?= base_url() ?>js/plugins.js"></script>
<script src="<?= base_url() ?>js/sunncamp/plugins.js"></script>
<script src="<?= base_url() ?>js/jeditable.js"></script>



<script src="<?= base_url() ?>js/script.js"></script>
<script src="<?= base_url() ?>js/sunncamp/script.js"></script>

<?php if (isset($imagezoom) && $imagezoom == TRUE) { ?>
    <script src="<?= base_url() ?>js/jquery.jqzoom-core-pack.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('.jqzoom').jqzoom({
                zoomType: 'innerzoom',
                lens:true,
                preloadImages: false,
                alwaysOn:false,
                 showEffect : 'fadein',  
            hideEffect: 'fadeout'  
            });
        	
        });


    </script>

<?php } ?>

<script>


    $(document).ready( function(){	
        $('#lofslidecontent45').lofJSidernews( {
            interval:10000,
            direction:'opacity',
            duration:1000,
            easing:'easeInOutQuad'
        } );						
    });
</script>




<!-- end concatenated and minified scripts-->


<!--[if lt IE 7 ]>
  <script src="<?= base_url() ?>js/libs/dd_belatedpng.js"></script>
  <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->


