
<?php get_header(); ?>

<section class="main-content">
  <div id="content-wrapper" class="passions-wrap">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <?php 
          $img = wp_get_attachment_image_src(get_field('image_banner'), 'full');
          $img_addtional = wp_get_attachment_image_src(get_field('image_aditional'), 'full');
          ?> 

          <?php if($img[0]!=""){?>      
          <div class="head-pasions" style="background-image:url('<?php echo $img[0];?>');">
            <img src="<?php echo $img[0]; ?>" style="visibility:hidden;">
            <div class="vault_link">
                <h1><?php echo get_field('title_banner');?></h1>
                <h2><?php echo get_field('headline_banner');?></h2>
                <?php if($urltext = get_field('url_text_banner')!=""){?>
                <a href="<?php echo get_field('url_banner');?>"><?php echo get_field('url_text_banner');?><i class="arrow-red-s"></i></a>
                <?php }?>
            </div>        
          </div>   
          <?php }?>  

          <section class="news-wrap single-content">  
          <?php custom_post_nav();?>
          <?php if($img_addtional[0]!=""){?>
          <div class="additional-image" style="background-image:url('<?php echo $img_addtional[0];?>');"></div>
          <?php }?>
          <article class="single-post">
            <div class="entry-title">
              <h1><?php the_title(); ?></h1>
            </div>
            <div class="entry-content">
              <?php the_content(); ?>
              <?php
                $url=get_field('url');
                if(!empty($url)){
              ?>
                <p><a href="<?=$url?>" class="read-more" target="_blank">Visit Site</a></p>
              <?php }?>
            </div>          
          </article>
          <?php printRelatedPots(get_the_ID());?>
          </section>
        <?php endwhile; ?>
      <?php endif; ?>
    
  </div>
</section>

<?php get_footer(); ?>