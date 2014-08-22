<?php
/*
* template name: media
*/
get_header(); 
?>

<section class="main-content home-media">
  <div id="content-wrapper">
    
        <?php 
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
query_posts( array( 'post_type' => array('video','photo-gallery'), 'posts_per_page' => 20, 'caller_get_posts' => 1, 'paged' => $paged ) );          
        if (have_posts()) : ?>
        <div id="wrap-media-all" class="news-wrap">
          <?php while (have_posts()) : the_post();
            if(get_post_type()=="video"){
              $size="medium";
              $readmore="Show Video";
            }else{
              $images = get_field('gallery_image');
              $size="medium";
              $readmore= sizeof($images)." Photos";
            }
            $url = get_image_catch(get_the_ID(), $size);
            list($width, $height) = getimagesize($url);
          ?>
            <article class="item-media media-<?=get_post_type()?>" style="width:<?=$width?>px;">
              <div class="entry-image">
                <img src="<?php echo $url;?>">
                <i class="icon-play-s"></i>
                <div class="caption">
                  <span class="date-publish"><?php echo get_the_date('M d y');?></span>
                  <h2><?php the_title(); ?></h2>
                  <a href="<?php the_permalink() ?>" rel="bookmark" class="read-more"  title="<?php the_title_attribute(); ?>"><?php echo $readmore;?><i class="arrow-red-s"></i></a>
                </div>
              </div>
            </article>
          <?php endwhile; ?>
          <?php custom_page_nav();?>
        </div>
        
      <?php endif; ?>
    
  </div>
</section>

<?php get_footer(); ?>