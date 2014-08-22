
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
            <?php /* display item event */?>
            <div class="item-event">
              <div class="wrap-event"> 
                <div class="date-event">
                  <span class="month"><?php echo date('M',strtotime(get_field('event_date')));?></span>
                  <span class="day"><?php echo date('d',strtotime(get_field('event_date')));?></span>
                  <span class="year"><?php echo date('Y',strtotime(get_field('event_date')));?></span>
                </div>
                <div class="event-content">
                  <div class="table">
                    <div class="table-cell text-content">
                      <h2><?php the_title();?></h2>
                      <span class="venue-info"><?php echo get_field('venue');?></span>
                      <?php if(get_field('fb_event_id')!=""){?>
                      <div class="wrap-rsvp">
                        <a class="btb-rsvp" href="https://www.facebook.com/events/<?php the_field('fb_event_id');?>/" target="_blank">RSVP</a>
                      </div>
                      <?php }?>
                    </div>
                    <div class="table-cell btb-content">
                      <?php $url = get_image_catch(get_the_ID(), 'large');
                      print_shareuri(get_permalink(), $url, get_the_title());?>
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
            </div>

          </article>
        <?php endwhile; ?>
      <?php endif; ?>
    </section>
  </div>
</section>

<?php get_footer(); ?>