<?php get_header();?>
<?php                
  if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
      <div class="wrap-featured">
        <div class="wrapper">
        <div class="row">
          <div class="entry_image col-md-8">
            <?php 
            $images = get_field('galleria_de_imagenes');
            if(get_field('video_youtube_id')==""){
             if ( has_post_thumbnail()) {
              $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' );
              ?>
             <a class="fancybox-gallery" rel="gallery<?php echo get_the_ID();?>" href="<?php echo $thumb['0']; ?>">
               <?php echo get_the_post_thumbnail(get_the_ID(), 'featured-image'); ?>
               </a>
               <?php
             }              
              if( $images ): ?>
                <?php foreach( $images as $image ): ?>
                        <a class="fancybox-gallery" rel="gallery<?php echo get_the_ID();?>" href="<?php echo $image['sizes']['large']; ?>" style="display:none;"></a>
                <?php endforeach; ?>
              <?php endif; 
            }else{ ?>
            <iframe width="100%" height="380" src="//www.youtube.com/embed/<?php the_field('video_youtube_id');?>" frameborder="0" allowfullscreen></iframe>
            <?php }
            ?>           
          </div>
          <div class="entry_content col-md-4">
            <h1 class="entry-title"><?php the_title();?></h1>
            <?php the_content();?>
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
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page'=>40);                 
  $myposts = new WP_Query( $args );  
  if ( $myposts->have_posts() ) :
    while ( $myposts->have_posts() ) : $myposts->the_post(); ?>
      <div class="col-md-3 entry-thumbnail">
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