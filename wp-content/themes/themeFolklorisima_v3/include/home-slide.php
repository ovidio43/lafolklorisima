<?php 
  $args = array(
    'post_type' => 'slide',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' =>-1
    );
  $the_query = new WP_Query($args);
if ($the_query->have_posts()) : ?>
<ul id="homeslide" class="slide-home">
	<?php while ($the_query->have_posts()) : $the_query->the_post();
	  $imgsrc_1 = wp_get_attachment_image_src(get_field('image_slide_1'), 'full');
	  $imgsrc_2 = wp_get_attachment_image_src(get_field('image_slide_2'), 'full');
	  $type='class="regular"';
	?>
		<li class="slide slide<?php the_field('style_slide');?>">
			<?php if($imgsrc_2[0]!=""){?>
			<img id="shadowcontainer" src="<?=$imgsrc_2[0]?>" />
			<?php $type='id="alicia"'; }?>
			<?php if($imgsrc_1[0]!=""){?>
			<img <?php echo $type;?> src="<?=$imgsrc_1[0]?>" />
			<?php }?>
			<div class="slidecont">
				<h1><?php the_title();?></h1>
				<div class="wrap-arrowright">
					<h3><a href=""><?php the_field('headline_slide');?></a><i class="arrow" href=""></i></h3>
					<div id="newsletter_form">
						<a href="#newsletter-form" alt="Sign Up for Alicia Keys Updates" title="Sign Up for Alicia Keys Updates" class="btb_red_s updates-launcher">GET Updates Click Here</a>
					</div>
				</div>
			</div>
			<div class="bg_video">
				<?php print_video_html(get_the_ID());?>	
			</div>			
		</li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>



