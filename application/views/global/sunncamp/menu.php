
<ul>
    <li><?= anchor('/', 'Home') ?></li>
    <li><?= anchor('/news', 'News') ?></li>
    <li id="down_products">
       <a>Products</a>



    </li >
    <li class="menu_list_item"><?= anchor('/about', 'Why Choose Sunncamp') ?></li>
    <li><?= anchor('/stockists', 'stockists') ?></li>
    <li><?= anchor('/instruction_manuals', 'Instructions') ?></li>
     <li><?= anchor('/brochures', 'Brochures') ?></li>
    <li><?= anchor('/testimonials', 'Testimonials') ?></li>
    <li><?= anchor('/trade_reviews', 'Trade Reviews') ?></li>
    <li><?= anchor('/faq', 'faq') ?></li>
    <li><?= anchor('/contact', 'Contact') ?></li>
</ul>


<div id="products_mega" style="display: none;">

    <?php
    $countrow = 0;
    $megawidth = 0;
    ?>

    <?php foreach ($category_parents as $parentrow): ?>
 <?php if($parentrow->parent_id > 0) {?>
        <?php if ($countrow == 0) { ?> <div style="float:left; width:190px;"> <?php } ?>
            <div class="mega_container">
           
                <h4> <?= $parentrow->parent_name ?></h4>

                <div class="mega_cats">
                    <?php
                    $countrow = $countrow + 1;
                    foreach ($categories as $row2):

                        if ($row2->parent == $parentrow->parent_id) {
                            $countrow = $countrow + 1;
                            ?>
                            <?php $cat_name = str_replace(' and ', ' &amp; ', $row2->product_category_name); ?>
                            <div class="mega_item"> <a href="<?= base_url() ?>products/category/<?= $row2->category_safename ?>">
                                    <?= $cat_name ?></a></div>
                                <?php }
                            endforeach; ?>
                </div>
              
            </div>
              <?php }?>
            <?php
            if ($countrow > 11) {
                $countrow = 0;
                $megawidth = $megawidth + 190;
                echo "</div>";
            }
            ?>

        <?php endforeach; ?>



    </div>	
    <span class="megawidth" id="<?= $megawidth ?>px"></span> 	

