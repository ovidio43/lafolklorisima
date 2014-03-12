<?php
/*
* template name: transmicion en vivo
*/
 get_header();?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=494354033983356";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

      <div class="wrap-featured">
        <div class="wrapper">
          <div class="row">
            <div class="entry_image col-md-6">

<object type="application/x-shockwave-flash" height="322" width="400" id="live_embed_player_flash" data="http://es.justin.tv/widgets/live_embed_player.swf?channel=rtpbolivia" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://es.justin.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=es.justin.tv&channel=rtpbolivia&auto_play=false&start_volume=25" /></object>

    <div class="canales-referencia">
    <h3>Otros Canales de Television que estan transmitiendo Desde Oruro y Santa Cruz son:</h3>
    <a href="http://www.reduno.com.bo/" target="_blank">Red Uno</a>|<a href="http://www.unitel.tv/" target="_blank">Unitel</a>|<a href="http://www.rtpbolivia.com/vivo.html" target="_blank">RTP</a>|<a href="http://www.atb.com.bo/" target="_blank">ATB</a>|</div>
            </div>
            <div class="entry_content col-md-6">

<div class="fb-comments" style="background:#fff;" data-href="http://lafolklorisima.com/" data-width="580" data-numposts="3" data-colorscheme="light"></div>

            </div>
          </div>
        </div>
      </div>      




<div class="wrapper">
  <div class="row article">
  <?php
  $args=array(
    'post_type' => "fotos",
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page'=>2);                 
  $myposts = new WP_Query( $args );  
  if ( $myposts->have_posts() ) :
    while ( $myposts->have_posts() ) : $myposts->the_post(); ?>
      <div class="col-md-3 entry-thumbnail">
          <?php 
           if ( has_post_thumbnail()) { ?>
           <a href="<?php the_permalink();?>">
           <?php
             echo get_the_post_thumbnail($post->ID, 'crop_thumbnail'); ?>
             <span class="icon-"></span>
             </a>
           <?php }
          ?>
          <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
      </div>      
    <?php endwhile;
  endif;
  ?>
  <?php
  $args=array(
    'post_type' => "videos",
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page'=>2);                 
  $myposts = new WP_Query( $args );  
  if ( $myposts->have_posts() ) :
    while ( $myposts->have_posts() ) : $myposts->the_post(); ?>
      <div class="col-md-3 entry-thumbnail">
          <?php 
           if ( has_post_thumbnail()) { ?>
           <a href="<?php the_permalink();?>">
           <?php
             echo get_the_post_thumbnail($post->ID, 'crop_thumbnail'); ?>
             <span class="icon-"></span>
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
             <span class="icon-"></span>
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