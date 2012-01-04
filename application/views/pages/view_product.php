<style type="text/css">

    body{margin:0px;padding:0px;font-family:Arial;}
    a img,:link img,:visited img { border: none; }
    table { border-collapse: collapse; border-spacing: 0; }
    :focus { outline: none; }
    *{margin:0;padding:0;}
    p, blockquote, dd, dt{margin:0 0 8px 0;line-height:1.5em;}
    fieldset {padding:0px;padding-left:7px;padding-right:7px;padding-bottom:7px;}
    fieldset legend{margin-left:15px;padding-left:3px;padding-right:3px;color:#333;}
    dl dd{margin:0px;}
    dl dt{}

    .clearfix:after{clear:both;content:".";display:block;font-size:0;height:0;line-height:0;visibility:hidden;}
    .clearfix{display:block;zoom:1}


    ul#thumblist{display:block;}
    ul#thumblist li{float:left;margin-right:2px;list-style:none;}
    ul#thumblist li a{display:block;border:1px solid #CCC;}
    ul#thumblist li a img{width:70px; height:70px;}
    ul#thumblist li a.zoomThumbActive{
        border:1px solid red;
    }

    .jqzoom{

        text-decoration:none;
        float:left;
    }

</style>


<div class="clearfix" id="content" style="margin-top:50px;margin-left:0px; height:500px;width:500px;" >
    <div class="clearfix">
        <?php foreach($defaultimage as $row): ?>
        <a href="<?= base_url() ?>images/products/<?=$row->product_id?>/<?=$row->filename?>" class="jqzoom" rel='gal1'  title="<?=$row->filename?>" >
            <img height="300px" src="<?= base_url() ?>images/products/<?=$row->product_id?>/medium/<?=$row->filename?>"  title="<?=$row->filename?>"  style="border: 4px solid #666;">
        </a>
     <?php endforeach; ?>
    </div>
    <br/>
    <div class="clearfix" >
        <ul id="thumblist" class="clearfix" >
<?php foreach($images as $row): ?>
            
            <li><a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?= base_url() ?>images/products/<?=$row->product_id?>/medium/<?=$row->filename?>',largeimage: '<?= base_url() ?>images/products/<?=$row->product_id?>/<?=$row->filename?>'}">
                    <img src='<?= base_url() ?>images/products/<?=$row->product_id?>/thumbs/<?=$row->filename?>'>
                </a>
            </li>
            
            <?php endforeach; ?>

          
        </ul>
    </div>
</div>

