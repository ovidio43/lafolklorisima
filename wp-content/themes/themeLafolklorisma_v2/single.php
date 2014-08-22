<?php get_header();?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php                
  if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
      <div class="wrap-featured">
        <div class="wrapper">
        <div class="row">
          <div class="entry_image col-md-8">
            <?php 
            $images = get_field('galleria_de_imagenes');
            if($images==""){
              $images = get_field('image_gallery_photos');
            }
            
            $video = get_field('video_youtube_id');
            if($video==""){
              $video = $_GET['v'];
              if($video==""){
                $rows_v = get_field('codigo_de_video_youtube');
                $video = $rows_v[0]['id_youtube_folk'];
              }
            }
            if($images!=""){
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

              <iframe width="100%" height="380" src="//www.youtube.com/embed/<?php echo $video;?>" frameborder="0" allowfullscreen></iframe>
              <?php $rows = get_field('codigo_de_video_youtube');
              
              if(count($rows)>1)
              { ?>
              <div class="more_videos">
                <ul>
                <?php
                foreach($rows as $row)
                {?>
                <li><a href="?v=<?php echo $row['id_youtube_folk'];?>"><img width="120" src="//i1.ytimg.com/vi/<?php echo $row['id_youtube_folk'];?>/default.jpg" alt="" data-thumb="//i1.ytimg.com/vi/<?php echo $row['id_youtube_folk'];?>/default.jpg" data-group-key="thumb-group-0"><?php echo $row['titulo_de_video_youtube'];?><a></li>
                <?php }?>
                 </ul>
              </div>
              <?php }?>          
            <?php }
            ?>           
          </div>
          <div class="entry_content col-md-4">
            <h1 class="entry-title"><?php the_title();?></h1>
            <?php the_content();?>
            <div class="fb-comments" data-href="<?php the_permalink();?>" data-width="390" data-numposts="5" data-colorscheme="dark"></div>

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
  $type=array('post','fotos','videos');
  $args=array(
    'post_type' => $type,
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
            $type=get_post_type();
            if($type=="post")
            $type=get_post_format();           
             echo get_the_post_thumbnail($post->ID, 'crop_thumbnail'); ?>
             <span class="icon-<?php echo $type;?>"></span>
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