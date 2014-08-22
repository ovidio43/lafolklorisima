
<?php get_header(); ?>
<?php //get_template_part('include/updates-form'); ?>
<section class="carrousel-slide">
    <ul class="carrousel">
        <?php
        function newsData($posts, $tumblr) {
            $data = array();
            $i = 0;
            foreach ($posts as $post) {
                $data[$i]['title'] = $post->post_title;
                $data[$i]['date'] = strtotime($post->post_date);
                $data[$i]['content'] = content(20, strip_tags($post->post_content));
                $data[$i]['permalink'] = get_permalink($post->ID);
                $data[$i]['src'] = get_image_catch($post->ID, 'large');
                $data[$i]['type'] = "post";
                $i++;
            }
            /*foreach ($tumblr as $tp) {
                if($tp['photo']!=""){
                    $data[$i]['title'] = content(8, strip_tags($tp['caption']));
                    $data[$i]['date'] = $tp['created'];
                    $data[$i]['content'] = $tp['caption'];
                    $data[$i]['permalink'] = $tp["permalink"];
                    $data[$i]['src'] = $tp['photo'];
                    $data[$i]['type'] = 'thumblr';
                    $i++;                    
                }
            }*/
            return $data;
        }

        $query = new WP_Query(array('post_type' => 'post'));
        $posts = $query->get_posts();

        $key = "pJmj9fuKfcf5nnpNIf1XhiJvYonbaZijHmMo8Nsy0ibe0gqtcS";
        $ak_tumblr = new ProdTumblr($post->ID, "thekeysofalicia.tumblr.com", $key, 16);
//        $tumblr_posts = $ak_tumblr->get_data();
        $tumblr_posts = $ak_tumblr->get_feed();
        $count = count(newsData($posts, $tumblr_posts));
        $data = newsData($posts, $tumblr_posts);

        $arr = array();
        foreach ($data as $k => $v) {
            $arr[$k] = $v['date']; //or $k if your date is the index
        }
        array_multisort($arr, SORT_DESC, $data);
        for ($i = 0; $i < $count; $i++) {
            ?>
            <li class="type-<?php echo $data[$i]['type'];?>">
                <div class="flip-container">
                    <div class="flipper">
                        <a class="front" href='<?php echo $data[$i]['permalink']; ?>' rel='bookmark' target="<?= $target ?>">
                            <div class="entry-image"><img src="<?= $data[$i]['src']; ?>"></div>
                            <div class="caption">
                                <h2><?php echo $data[$i]['title']; ?></h2>
                            </div>
                        </a>
                        <a class="back" href='<?php echo $data[$i]['permalink']; ?>' rel='bookmark' target="<?= $target ?>">
                            <div class="entry-image"><img src="<?= $data[$i]['src']; ?>"></div>
                            <div class="caption">
                                
                                <h2>
                                <?php if($data[$i]['type']!="thumblr"){?>
                                <?php echo $data[$i]['title'] ?>
                                <?php }else{?>
                                &nbsp;
                                <?php }?>
                                </h2>
                                
                                <p><?php echo strip_tags($data[$i]['content']); ?></p>
                                
                                
                                <span class="read-more" title="read more of the post" alt="read more" href="<?php $data[$i]['permalink']; ?>">read more <i class="arrow-red-s"></i></span>
                            </div>                  
                        </a>              
                    </div>
                </div>                
            </li> 
            <?php
        }
        ?>

    </ul>    
</section>
<section class="main-content">
    <div class="home-footer">
        <?php $img = wp_get_attachment_image_src(get_field('image_banner','option'), 'full');?>
        <img src="<?php echo $img[0]; ?>">
        <div class="vault_link">
            <h1><?php echo get_field('title_banner','option');?></h1>
            <h2><?php echo get_field('headline_banner','option');?></h2>
            <a href="<?php echo get_field('url_banner','option');?>"><?php echo get_field('url_text_banner','option');?><i class="arrow-red-s"></i></a>
        </div>

    </div>
</section>
<?php
get_footer();
