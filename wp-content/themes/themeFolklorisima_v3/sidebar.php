<aside class="sidebar">
        <?php
        $posts_to_show = 5;
        $ctr = 0;
        $social_feed_obj = new ProdTwitter('aliciakeys');
        $social_feed_items = $social_feed_obj->get_feed();?>
        <ul class="tweet-feed">
        <li class="tweet-logo">Twitter</li>
        <?php foreach ($social_feed_items as $feed_item) {
            $tweet_text = "";
            ++$ctr;
            if (!empty($feed_item["tweet"])) {
                $reply = "<a class='reply' href='http://twitter.com/intent/tweet?in_reply_to=" . $feed_item["data_id"] . "' target='_blank'>reply</a>";
                $retweet = "<a class='retweet' href='http://twitter.com/intent/retweet?tweet_id=" . $feed_item["data_id"] . "' target='_blank'>retweet</a>";                
                ?>                
                <li> 
                    <?php
                    $tweet_text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $feed_item["tweet"]);
                    echo $tweet_text;
                    echo "<br>".$reply." ".$retweet;
                    ?>
                </li>
                <?php
                if ($ctr >= $posts_to_show) {
                    break;
                }
            }
        }?>
        </ul>
        <?php if(is_page('events')){?>
        <div class="archives-display">
            <div class="title-sidebar">ARCHIVES</div>
            <div class="archive-description">EXPLORE THE ALICIA KEYS TOUR MAP</div>
            <a href="/tour-map/">Click Here</a>
        </div>
        <?php }?>
</aside>