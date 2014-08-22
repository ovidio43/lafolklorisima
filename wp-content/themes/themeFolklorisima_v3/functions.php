<?php
require_once(get_template_directory() . '/lib/post-type.php');
require_once(get_template_directory() . '/lib/Track.php');
require_once(get_template_directory() . '/lib/Event.php');
require_once(get_template_directory() . '/lib/related-posts.php');
add_theme_support('post-thumbnails');
register_nav_menu('Primary', 'Main Menu');
function catch_that_image($content) {
    //global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    $first_img = $matches[1][0];
    if (empty($first_img)) {
        $first_img = "/path/to/default.png";
    }
    return $first_img;
}

function content($limit, $content) {
    $content = explode(' ', $content, $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/\[.+\]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function custom_post_nav() {
    $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous) {
        return;
    }
    ?>
    <div class="single-navigation" role="navigation">
        <?php
        if (is_attachment()) :
            previous_post_link('%link', __('<span class="meta-nav nav-prev">Published In</span>%title', ''));
        else :
            previous_post_link('%link', __('<span class="meta-nav nav-prev">Previous Post</span>%title', ''));
            next_post_link('%link', __('<span class="meta-nav nav-next">Next Post</span>%title', ''));
        endif;
        ?>
    </div><!-- .navigation -->
    <?php
}
function custom_post_nav_song($idalbum, $currentID){
    //echo $id;
    //echo $currentID;
    $posts = get_field('songs_list',$idalbum);
    for($c=0;$c<count($posts);$c++){
        if($posts[$c]->ID==$currentID){
            $prevtitle=$posts[$c-1]->post_title;
            $prevlink=$posts[$c-1]->ID;
            $nexttitle=$posts[$c+1]->post_title;
            $nextlink=$posts[$c+1]->ID;
            break;
        }
    }
    ?>
    <div class="single-navigation" role="navigation">
        <?php if($prevlink!=""){?>
        <a href="<?php echo get_permalink($prevlink);?>?album=<?php echo $idalbum;?>" rel="prev"><span class="meta-nav nav-prev">Previous</span><?php echo $prevtitle;?></a>
        <?php }?>
        <?php if($nexttitle!=""){?>
        <a href="<?php echo get_permalink($nextlink);?>?album=<?php echo $idalbum;?>" rel="next"><span class="meta-nav nav-next">Next</span><?php echo $nexttitle; ?></a>
        <?php }?>
    </div>    
    <?php
}
function custom_page_nav() { ?>
        <nav class="pagination">
          <!--div class="alignleft"><?php previous_posts_link('&laquo; Previous Page') ?></div-->
          <div class="alignright"><?php next_posts_link('Load More','') ?></div>
        </nav>
<?php }
function get_image_catch($postid, $size) {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($postid), $size);
    $url = "";
    if (empty($img)) {
        $url = catch_that_image(get_post_field('post_content', $postid));
    } else {
        $url = $img[0];
    }
    if ($url == "/path/to/default.png") {
        $dir = get_template_directory_uri();
        $url = $dir . "/img/default.jpg";
    }
    return $url;
}

if (function_exists('register_sidebars')) {
    register_sidebars(4, array(
        'name' => 'sidebar %d',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}
function print_shareuri($urlshare=false, $image_url=false, $image_caption=false) {

    $iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");

    if ($iphone || $android || $palmpre || $ipod || $berry == true) {
        $url = 'http://m.facebook.com/sharer.php?u=' . $urlshare;
    } else {
        $url = 'https://www.facebook.com/dialog/feed?app_id=705097732903575&redirect_uri='.$urlshare.'&link=' . $urlshare . '&picture='. $image_url . '&caption=' . $image_caption;
    }
    ?>
      <div class="wrap-share">  
        <a class="share-icon twitter"
           href="http://twitter.com/intent/tweet?text=<?php echo $urlshare;?>"
           target="_blank"
           data-url="<?php echo $urlshare;?>"
           title="Share on Twitter"
           >
               Share on Twitter
        </a>
        <a class="share-icon facebook"
           href="<?php echo $url;?>"
           target="_blank"
           data-url="<?php echo $url;?>"
           title="Share on Facebook">
               Share on Facebook
        </a>
      </div>    
<?php }

function print_video_html($v_id) {
    $bc_id = get_post_meta($v_id, "brightcove_id", true);
    $youtube_url = get_post_meta($v_id, "youtube_url", true);
    $vimeo_url = get_post_meta($v_id, "vimeo_url", true);
    //$thumb = wp_get_attachment_image_src($v_id, "thumbnail");
    //print_r($thumb);
    //$thumb = $thumb[0];

    $thumb = wp_get_attachment_thumb_url(get_post_thumbnail_id($v_id));

    if ($bc_id !== "") {
        echo <<<EOF
<!-- Start of Brightcove Player -->

<div style="display:none">

</div>

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C 
found at https://accounts.brightcove.com/en/terms-and-conditions/. 
-->


<div class='video-frame'>
<object id="myExperience$v_id" class="BrightcoveExperience">
  <param name="bgcolor" value="#000000" />
  <param name="width" value="600 />
  <param name="height" value="400" />
  <param name="playerID" value="900222770001" />
  <param name="playerKey" value="AQ~~,AAAAAAAA5vE~,Eeb-O-20Rk-SF4hPepY0lXx-sheoXNz1" />
  <param name="isVid" value="true" />
  <param name="isUI" value="true" />
  <param name="dynamicStreaming" value="true" />
  
  <param name="@videoPlayer" value="$bc_id" />
</object>
</div>
<div class='royalCaption'>
EOF;
//prod_share($v_id);
        echo <<<EOF
</div>

<!-- 
This script tag will cause the Brightcove Players defined above it to be created as soon
as the line is read by the browser. If you wish to have the player instantiated only after
the rest of the HTML is processed and the page load is complete, remove the line.
-->
<script type="text/javascript">brightcove.createExperiences();</script>

<!-- End of Brightcove Player -->
EOF;
    } else if ($youtube_url !== "") {

        //var_dump($youtube_url);
        if (strpos($youtube_url, "youtu.be") !== false) {
            $youtube_id = end(split("/", $youtube_url));
            $youtube = true;
        } else if (strpos($youtube_url, "youtube.com/watch?v=") !== false) {
            //$youtube_id = end(split("v=", $v_url));
            //var_dump($v_url);
            preg_match("/v\=(.*)&?/", $youtube_url, $youtube_id);
            $youtube_id = $youtube_id[1];
            $youtube = true;
        }
        if ($youtube) {
            $embed_url = "http://www.youtube.com/embed/" . $youtube_id . "?autoplay=0&controls=0&showinfo=0";
            $embed_code = "<div class='video-frame'><iframe src='$embed_url' frameborder='0' allowfullscreen></iframe></div>";
        }

        echo $embed_code;
        echo "<div class='royalCaption'>";
        //prod_share($v_id);
        echo "</div>";

        /*
          echo "<div class='video-frame'>";
          echo $embed_code;
          prod_share($v_id);
          echo "</div>";
         */
    } else if ($vimeo_url !== "") {
        //preg_match("/(vimeo\.com)\/(\d*)/", $vimeo_url, $vimeo_id);
        //var_dump($vimeo_id);
        //$vimeo_id = $vimeo_id[2];
        $vimeo_id = str_replace("vimeo.com/", "", str_replace("www.", "", str_replace("http://", "", $vimeo_url)));
        $embed_url = "http://player.vimeo.com/video/$vimeo_id?title=0&amp;byline=0&amp;portrait=0";
        $embed_code = '<div class="video-frame"><iframe src="' . $embed_url . '" width="400" height="300" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe></div>';
        echo $embed_code;
        echo "<div class='royalCaption'>";
        //prod_share($v_id);
        echo "</div>";
    }
}
