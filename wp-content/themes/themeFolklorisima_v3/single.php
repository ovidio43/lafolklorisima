
<?php get_header(); ?>

<section class="main-content">
  <div id="content-wrapper">
    <section class="news-wrap single-content">
        <?php
        if(get_post_type()=='songs'){
          custom_post_nav_song($_GET['album'], get_the_ID());
        }else{
          custom_post_nav();
        }
        ?>  
        <?php 
        if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article class="single-post">
            <div class="entry-title">
              <h1><?php the_title(); ?></h1>
              
              <?php 
              $url = get_image_catch(get_the_ID(), 'large');
              print_shareuri(get_permalink(), $url, get_the_title());
              ?>
            </div>

            <div class="entry-content">
              <?php the_content(); ?>
            </div>          
          </article>
          <?php printRelatedPots(get_the_ID(),'Related Articles');?>
        <?php endwhile; ?>
      <?php endif; ?>
    </section>
  </div>
</section>

<?php get_footer(); ?>