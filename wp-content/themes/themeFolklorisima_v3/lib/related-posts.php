<?php
function printRelatedPots($postID, $title=false){
    //if ( 'post' == get_post_type() ) {
        $taxs = wp_get_post_tags($postID);
        if ( $taxs ) {
            $tax_ids = array();
            foreach( $taxs as $individual_tax ) $tax_ids[] = $individual_tax->term_id;
            $args = array(
                'post_type'             => array('post','video','passion_items','photo-gallery', 'albums'),
                'tag__in'               => $tax_ids,
                'post__not_in'          => array($postID),
                'showposts'             => 5,
                'ignore_sticky_posts'   => 1
            );
            $my_query = new wp_query( $args );
            if( $my_query->have_posts() ) {
                echo '<div class="related-posts">';?>
                <?php if($title!=""){?>
                    <span class="related-title"><?php echo $title;?></span>
                <?php }?>
                <?php 
                    while ( $my_query->have_posts() ) :
                    $my_query->the_post();
                    $url = get_image_catch(get_the_ID(), 'medium');
                    $video="";
                    if(get_post_type()=="video"){
                        $video ='<i class="icon-play-s"></i>';
                    }
                ?>
                  <article  class="news-post item-pasions type-<?php echo get_post_type();?>">
                    <div class="flip-container">
                      <div class="flipper">
                        <div class="front">
                          <div class="entry-image">
                            <img src="<?php echo $url;?>">
                            <?php echo $video;?>
                          </div>
                          <div class="caption-news">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                          </div>                   
                        </div>
                        <div class="back">
                          <div class="caption-news">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            <p><?php the_excerpt();?></p>
                            <a href="<?php the_permalink();?>" class="read-more">Read More<i class="arrow-red-s"></i></a>
                          </div>                  
                        </div>                
                      </div>
                    </div>
                  </article>                
                <?php endwhile;
                echo '</div>';
            }
            wp_reset_query();
             
        }
    //}
}
