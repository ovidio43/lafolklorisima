
<?php get_header(); ?>

<section class="main-content home-news">
  <div id="content-wrapper">
    <section class="news-wrap full-width">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); 
          $url = get_image_catch(get_the_ID(), 'large');
        ?>
          <article id="post-<?php the_ID(); ?>" class="news-post item-pasions">
            <div class="flip-container">
              <div class="flipper">
                <div class="front">
                  <div class="entry-image">
                    <img src="<?php echo $url;?>">
                  </div>
                  <div class="caption-news">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                  </div>
                </div>
                <div class="back">
                  <div class="caption-news">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <p><?php the_excerpt();?></p>
                    <a href="<?php the_permalink();?>" class="read-more">VIEW ALBUM<i class="arrow-red-s"></i></a>                    
                  </div>
                </div>                
              </div>
            </div>     
          </article>
        <?php endwhile; ?>
        <?php custom_page_nav();?>
      <?php endif; ?>
    </section>
  </div>
</section>

<?php get_footer(); ?>