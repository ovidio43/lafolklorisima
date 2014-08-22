
<?php get_header(); ?>

<section class="main-content">
  <div id="content-wrapper">
    <section class="news-wrap single-content">
        <?php //custom_post_nav();?>  
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="music-head">
            <div class="entry-image">
              <?php the_post_thumbnail(get_the_ID(),"medium");?>
            </div>
            <div class="entry-content">
              <div class="wrap-entry">
                <?php 
                $url = get_image_catch(get_the_ID(), 'large');
                print_shareuri(get_permalink(), $url, get_the_title());
                ?>
                <a href="/albums/" class="return-home"><i class="title-icon"></i></a>
                <h1><?php the_title(); ?></h1>              
                  <?php 
                  $rows = get_field('repeat_url');
                  if($rows)
                  { ?>
                 <div class="dropdown">
                    <a class="dropdown-toggle btb_green_s" data-toggle="dropdown" href="#">
                      <i class="spotify-icon">LISTEN</i> 
                    </a>                
                    <ul class="dropdown-menu" role="menu">
                    <?php foreach($rows as $row)
                    { ?>
                      <li><a target="_blank" href="<?php echo $row['url_repeat'];?>"><?php echo $row['title_repeat'];?></a></li>
                    <?php } ?>
                    </ul>
                  </div>
                  <?php } ?>
                <?php 
                  $buyurl = get_field('ak_store').get_field('buy_cd_vendor').get_field('vendor_two');
                  if($buyurl!=""){
                ?>                
                  <div class="dropdown">
                      <a class="dropdown-toggle btb_red_s" data-toggle="dropdown" href="#">
                        BUY IT NOW 
                      </a>
                      <ul class="dropdown-menu" role="menu">
                        <?php if(get_field('ak_store')!=""){?>
                          <li><a target="_blank" href="<?php the_field('buy_digital_url');?>"><?php the_field('ak_store');?></a></li>
                        <?php }if(get_field('buy_cd_vendor')!=""){?>
                          <li><a target="_blank" href="<?php the_field('cd_url');?>"><?php the_field('buy_cd_vendor');?></a></li>
                        <?php }if(get_field('vendor_two')!=""){?>
                          <li><a target="_blank" href="<?php the_field('vendor_two_url');?>"><?php the_field('vendor_two');?></a></li>
                        <?php }?>
                      </ul>
                  </div>
                <?php }?>         
              </div>
            </div>
          </div>
          <article class="list-song">
            <?php
            $c=0;
            $idalbum=get_the_ID();
            $posts = get_field('songs_list');
            if( $posts ): ?>
                <ul>
                <?php $ctr=0; foreach( $posts as $post):?>
                    <?php  setup_postdata($post); 
                      if($c==0){
                        $c=1;
                        $color = "grey1";
                      }else{
                        $c=0;
                        $color = "grey2";
                      }
                    ?>
                      <?php
                      // print_play_button(); ?>
                      <li class="<?=$color?>">
                        <div class="wrap-songlist">
                          <?php
                          if (get_field("soundcloud_stream_url", $post->ID)) {
                              echo "<span class='song-item' ><i class='play play-toggle'  data-song-title='" . $post->post_title . "' data-audio-url='" . get_field("soundcloud_stream_url", $post->ID) . "' data-song-idx='$ctr'></i></span>";
                              $ctr++;
                          }
                          ?>
                          <a href="<?php the_permalink(); ?>?album=<?php echo $idalbum;?>"><?php the_title(); ?></a>
                          <a href="<?php the_permalink(); ?>?album=<?php echo $idalbum;?>" class="more-detail"></a>
                        </div>
                    </li> 
                <?php  endforeach; ?>
                </ul>
                <?php wp_reset_postdata();?>
            <?php endif; ?>              
          </article>
          <?php printRelatedPots(get_the_ID());?>
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