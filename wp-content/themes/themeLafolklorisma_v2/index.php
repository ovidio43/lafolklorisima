<?php get_header();?>
<?php
$args=array(
    'post_type' => $type,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page'=>1);                 
  $myposts = new WP_Query( $args );
  if ( $myposts->have_posts() ) :
    while ( $myposts->have_posts() ) : $myposts->the_post(); ?>
      <div class="wrap-featured">
        <div class="wrapper">
          <div class="row">
            <div class="entry_image col-md-8">
              <?php 
               if ( has_post_thumbnail()) {
                 echo get_the_post_thumbnail(get_the_ID(), 'featured-image'); 
               }
              ?>            
            </div>
            <div class="entry_content col-md-4">
              <h1 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
              <?php the_excerpt();?>
            </div>
          </div>
        </div>
      </div>      
    <?php endwhile;
  endif;
?>
<?php wp_reset_query(); ?>
<div class="wrapper">
  <div class="row article">
  <?php
  $args=array(
    'post_type' => $type,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'offset' => 1,
    'posts_per_page'=>40);                 
  $myposts = new WP_Query( $args );  
  if ( $myposts->have_posts() ) :
    while ( $myposts->have_posts() ) : $myposts->the_post(); ?>
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