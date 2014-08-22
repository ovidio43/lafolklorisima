<?php
/*
 * template name: Tumblr page
 */
get_header();
?>

<section class="main-content home-media">
    <div id="content-wrapper" class="content-wrapper">
        <?php
        /* collect categories */
        $key = "pJmj9fuKfcf5nnpNIf1XhiJvYonbaZijHmMo8Nsy0ibe0gqtcS";
        $paged = isset($_GET['next']) ? $_GET['next'] : 0;

        $ak_tumblr = new ProdTumblr($post->ID, "thekeysofalicia.tumblr.com", $key, 12, $paged * 12);
        $tumblr_content = $ak_tumblr->get_feed();
        // print_r($tumblr_content);
        if (count($tumblr_content) > 0) {
            foreach ($tumblr_content as $item) {
                echo'<div class="item-tumblr">';
                if ($item['type'] == "photo") {
                    echo '<div class="photo">';
                    echo '<a href="' . $item['permalink'] . '" target="_blank">';
                    echo "<img src='" . $item['photo'] . "' />";
                    echo '</a>';
                } else if ($item['type'] == "text") {
                    echo '<div class="text">';
                    echo '<a href="' . $item['permalink'] . '" target="_blank">';
                    if (isset($item['title'])) {
                        echo $item['title'];
                    }
                    if (isset($item['body'])) {
                        echo $item['body'];
                    }
                    echo '</a>';
                } else if (isset($item['video_embed'])) {
                    echo '<div class="video">';
                    echo '<a href="' . $item['permalink'] . '" target="_blank">';


                    echo "<img src='" . $item['photo'] . "' /><i class='play-icon'></i>";
                    echo '</a>';
                    
                    //$item['video_embed']
                } else {
                    echo '<div>';
                    //var_dump($item);
                }
                echo '</div></div>';
            }
        }
        ?>

        <nav class="pagination">
            <p>
                <?php
                global $post;
                $next_page = $paged + 1;
                echo "<a href='/" . $post->post_name . "?next=" . $next_page . "' class='no-ajax'>Load More</a>";
                ?>
            </p>
        </nav>
    </div>
</section>

<?php get_footer(); ?>