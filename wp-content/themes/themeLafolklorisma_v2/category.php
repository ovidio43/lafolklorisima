<?php get_header();?>

<div class="wrapper">
  <div class="row article">
  <?php

  if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
      <div class="col-md-4 entry-thumbnail">
          <?php 
           if ( has_post_thumbnail()) { ?>
           <a href="<?php the_permalink();?>">
           <?php
             echo get_the_post_thumbnail($post->ID, 'crop_thumbnail'); ?>
             </a>
           <?php }
          ?>
          <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
      </div>      
    <?php endwhile;
  endif;
  ?>
  </div>
</div>
<?php get_footer();?>