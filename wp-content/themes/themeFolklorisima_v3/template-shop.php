<?php
/*
 * template name: Shop
 */
get_header();
?>
<section class="main-content home-media">
    <div id="content-wrapper" class="content-wrapper">
        <?php 
        if (have_posts()) : ?>
            <div class="wrap-store">
            <?php while (have_posts()) : the_post();
              $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
            ?>
                <img src="<?=$imgsrc[0]?>" />
                <a href="http://www.myplaydirect.com/alicia-keys" class="btb_red left-pos" target="_blank">SHOP MUSIC</a>
                <a href="http://aliciakeys.shop.bravadousa.com/" class="btb_red right-pos" target="_blank">SHOP MERCH</a>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>