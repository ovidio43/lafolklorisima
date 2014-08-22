
<?php get_header(); ?>

<section class="main-content">
  <div id="content-wrapper">
    <section class="video-wrap single-content">
        <?php //custom_post_nav();?>  
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); 
          $url = get_image_catch(get_the_ID(), "full");
        ?>
          <article class="single-post">
            <div class="entry-content">
              <?php print_video_html(get_the_ID());?>
              <img src="<?php echo $url;?>"> 
              <div class="entry-title">
                <i class="icon-play-s"></i> <h1><?php the_title(); ?></h1>
              </div>
            </div>          
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <article class="news-post">
          <p>Sorry, but the requested resource was not found on this site.</p>
          <?php get_search_form(); ?>
        </article>
      <?php endif; ?>
    </section>
  </div>
</section>

<?php get_footer(); ?>