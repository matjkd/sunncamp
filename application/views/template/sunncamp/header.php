<meta charset="utf-8">

<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
     Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php if(isset($title)) { echo $title; } else { echo "Welcome to SunnCamp";} ?></title>
<meta name="description" content="">
<meta name="author" content="">


<!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->



<!-- CSS : implied media="all" -->

<link rel="stylesheet" href="<?= base_url() ?>css/grid.css">
<link rel="stylesheet" href="<?= base_url() ?>css/style.css?v=2">
<link rel="stylesheet" href="<?= base_url() ?>css/cloud-zoom.css"  type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>css/tooltipster.css">
<!--datatables stylesheets-->
<link rel="stylesheet" href="<?= base_url() ?>css/demo_table.css">
<link rel="stylesheet" href="<?= base_url() ?>css/demo_table_jui.css">


<link rel="stylesheet" href="<?= base_url() ?>css/sunncamp/scrollable.css">
<link rel="stylesheet" href="<?= base_url() ?>css/custom-theme/jquery-ui-1.8.17.custom.css">
<link rel="stylesheet" href="<?= base_url() ?>css/sunncamp/template.css">

<!--[if IE 6]>
<link rel="stylesheet" href="<?=base_url()?>css/sunncamp/ie.css" /> 
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" href="<?=base_url()?>css/sunncamp/ie.css" /> 
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="<?=base_url()?>css/sunncamp/ie.css" /> 
<![endif]-->


<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
<script src="<?= base_url() ?>js/libs/modernizr-1.6.min.js"></script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19623681-18']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
