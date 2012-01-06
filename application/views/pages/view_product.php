<div class="clearfix" id="content" style="margin-top:0px;margin-left:0px; " >


    



    <div class="clearfix" style="margin-left:15px;">
        <h1><?=$product_name?></h1>

        <?php foreach ($defaultimage as $row): ?>
            <a href='<?= base_url() ?>images/products/<?= $row->product_id ?>/<?= $row->filename ?>' class = 'cloud-zoom' id='zoom1'
               rel="adjustX: 0, adjustY:0, position: 'inside', ">
                <img src="<?= base_url() ?>images/products/<?= $row->product_id ?>/medium/<?= $row->filename ?>" alt='' />
            </a>
        <?php endforeach; ?>
    </div>



    <br/>
    <!-- "previous page" action -->
    <a class="prev browse left"></a>

    <!-- root element for scrollable -->
    <div class="scrollable">   

        <!-- root element for the items -->
        <div class="items">

            <?php
            $x = 0;
            $y = 0;
            foreach ($images as $row):

                if ($x == 0) {
                    echo "<div>";
                }
                if ($x==0 && $y==1) { $y=0;}
                
                $x = $x + 1;
                ?>



                <a href='<?= base_url() ?>images/products/<?= $row->product_id ?>/<?= $row->filename ?>' class='cloud-zoom-gallery' title='Thumbnail 1'
                   rel="useZoom: 'zoom1', smallImage: '<?= base_url() ?>images/products/<?= $row->product_id ?>/medium/<?= $row->filename ?>' ">
                    <img src="<?= base_url() ?>images/products/<?= $row->product_id ?>/thumbs/<?= $row->filename ?>" alt = "Thumbnail 1"/></a>




                <?php
                if ($x == 4) {
                    echo "</div>";
                    $y = 1;
                    $x = 0;
                }


            endforeach;
            if ($y == 0) {
                echo "</div>";
            }
            ?>

<!-- end of root element for items -->
        </div>
    </div>

    <!-- "next page" action -->
    <a class="next browse right"></a>
<br clear="all" />
</div>


