
<?php get_header(); ?>

<section class="main-content">
  <div id="content-wrapper">
    <section class="gallery-wrap single-content">
        <?php //custom_post_nav();?>  
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); 
        ?>
          <article class="single-post">
            <div class="entry-content">
          
              <div class="entry-title">
              </div>
            <?php 
            $images = get_field('gallery_image');
            if( $images ): ?>
                <div class="fotorama" class="fotorama" data-swipe="true" data-hash="true" data-width="100%" data-height="600" data-nav="thumbs" data-thumbheight="120">
                    <?php foreach( $images as $image ): 
                    $img = wp_get_attachment_image_src( $image['id'],"large");
                    $imgthumb = wp_get_attachment_image_src( $image['id'],"thumbnail");
                    ?>
                      <a href="<?php echo $img[0]; ?>" data-thumb="<?php echo $imgthumb[0]; ?>">
                         <img  src="<?php echo $imgthumb[0]; ?>" width="144" height="96" alt="<?php echo $image['alt']; ?>"/>
                      </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>                
           
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