<?php 
/*
* template name: tour events
*/
get_header(); ?>

<section class="main-content home-news">
  <?php

  if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); 
    $url = get_image_catch(get_the_ID(), 'large');
    list($width, $height) = getimagesize($url);
    ?> 
      <article class="event-head">
        <div class="entry-image">
          <img src="<?php echo $url;?>" style="max-width:<?php echo $width; ?>px;">
        </div>
        <div class="caption">
          <h1><?php echo get_field('main_title_feature');?></h1>
          <h2><?php echo get_field('headline_title_featured');?></h2>
          <p><?php echo get_field('aditional_text_featured');?></p>
        </div>
        <i class="play-icon"></i>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
   <?php wp_reset_query(); ?> 
  <nav class="nav-tour">
    <ul>
      <li><a href="/events/" class="active">CURRENT TOURS & EVENTS </a></li>
      <li><a href="/tour-map/">TOUR MAP</a> </li>
    </ul>
  </nav>
  <div id="content-wrapper">
    <section class="news-wrap">
        <?php
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        query_posts( 
          array( 
            'post_type' => 'tour_dates', 
            'posts_per_page' => 10,
            'caller_get_posts' => 1,
            'paged' => $paged,
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'value' => date("Ymd"),
                    'compare' => '>='
                )
            )
          )
        ); 

        if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); 
        ?> 
          <article id="post-<?php the_ID(); ?>" class="item-event">
            <div class="wrap-event"> 

              <div class="date-event">
                <span class="month"><?php echo date('M',strtotime(get_field('event_date')));?></span>
                <span class="day"><?php echo date('d',strtotime(get_field('event_date')));?></span>
                <span class="year"><?php echo date('Y',strtotime(get_field('event_date')));?></span>
              </div>
              <div class="event-content">
                <div class="table">
                  <div class="table-cell text-content">
                    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                    <span class="venue-info"><?php echo get_field('venue');?></span>
                    <?php if(get_field('fb_event_id')!=""){?>
                    <div class="wrap-rsvp">
                      <a class="btb-rsvp" href="https://www.facebook.com/events/<?php the_field('fb_event_id');?>/" target="_blank">RSVP</a>
                    </div>
                    <?php }?>
                  </div>
                  <div class="table-cell btb-content">
                    <?php
                    $status = get_field('show_status');
                    if($status=="on_sale"){
                      $rows = get_field('list_tickets_url');
                      if($rows)
                      { ?>
                        <div class="dropdown">
                          <a class="dropdown-toggle btb_red_s" data-toggle="dropdown" href="#">TICKETS</a>                
                          <ul class="dropdown-menu" role="menu">
                          <?php foreach($rows as $row)
                          { ?>
                            <li><a target="_blank" href="<?php echo $row['ticket_url'];?>"><?php echo $row['title_ticket'];?></a></li>
                          <?php } ?>
                          </ul>
                        </div>
                      <?php }
                    }else if($status=="sold_out"){ ?>
                      <span class="btb_red_s">SOLD&nbsp;OUT</span> 
                    <?php } else if($status=="presale"){ ?>
                      <a class="btb_red_s" href="<?php the_field('presale_link')?>" target="_blank">PRESALE</a> 
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
        <?php custom_page_nav();?>
      <?php else : ?>
          <article id="post-<?php the_ID(); ?>" class="item-event">
            <div class="wrap-event"> 
              <div class="event-content">
                <div class="table">
                  <div class="table-cell text-content">
                    <h2>There are no Events</h2>
                    <span class="venue-info">There are no Events at this moment</span>
                  </div>
                </div>
              </div>
            </div>
          </article>
      <?php endif; ?>
       <?php wp_reset_query(); ?> 
    </section>
    <?php get_sidebar(); ?>
  </div>
</section>

<?php get_footer(); ?>