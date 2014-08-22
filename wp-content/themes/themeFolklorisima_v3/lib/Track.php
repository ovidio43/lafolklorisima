<?php

/* Custom class used to interact with the Song custom post type in Katy Perry.  Adapted from Defjam.com site code */
/* Author: jeremy@prod4ever.com */

require_once('wp_object.php');

class Track extends WP_Object {

    static $_post_type = 'songs';

    function __construct($track_post) {
        parent::__construct($track_post);
    }

    function __get($column) {
        $correspondences = array(
            'name' => 'post_title'
        );

        if (array_key_exists($column, $correspondences))
            return parent::__get($correspondences[$column]);

        switch ($column) {
            //Custom get methods.
            /* case 'video':
              return $this->get_video();
              break;
             */
            case 'duration':
                return get_field("song-duration", $this->ID);
            case 'album':
                $all_albums_featuring_this_song = $this->get_albums();
                if ($all_albums_featuring_this_song) {
                    return $all_albums_featuring_this_song[0];
                };
                break;
            case 'all_albums':
                return $this->get_albums();
                break;
            case 'is_soundcloud':
                if ($this->raw_audio_url) {
                    return stripos($this->raw_audio_url, "soundcloud") !== false;
                }
                return false;
                break;
            case 'raw_audio_url':
                return get_field("audio_url", $this->ID);
                break;
            case 'audio_url':
                if ($this->is_soundcloud) {
                    //$sc_data = new ProdSoundCloud($this->raw_audio_url);
                    //$sc_stream_url = $sc_data->get_stream_url();
                    //return $sc_stream_url;
                    return get_field("soundcloud_stream_url", $this->ID);
                } else {
                    return $this->raw_audio_url;
                }
                break;
        }

        return parent::__get($column);
    }

    //Prints a single track object with play button
    public function print_list_item() {


        $release_id = "";
        $release_link = "";
        $release_name = "";

        if ($this->album) {
            $release_id = $this->album->ID;
            $release_link = $this->album->get_permalink();
            $release_name = $this->album->post_title;
        }

        $audio_class = "";
        if (!$this->audio_url) {
            $audio_class = "no-audio";
        }
        echo "<li class='kt-track' data-track-id='" . $this->ID . "' data-track-title='" . $this->post_title . "' data-audio-url='" . $this->audio_url . "' data-release-id='$release_id' data-release-img='' data-release-link='$release_link' data-release-name='$release_name'>";
        echo "<span class='listen'>";
        if ($this->audio_url) {
            echo "<span class='icon-play play-song-small'></span>";
            echo "<span class='icon-pause'></span>";
        }

        echo "</span>";
        echo "<div class='track-info $audio_class'>";
        echo "<span class='track-title track-placeholder'>";
        echo '<a href="' . get_permalink($this->ID) . '" class="display-song">';
        echo $this->post_title;
        if ($this->duration) {
            echo " (" . $this->duration . ")";
        }
        echo "</a>";
        //if($this->note) {
        //    echo "<span>(". $this->note .")</span>";
        //}
        echo "</span>";
        echo "</div>";
        echo "</li>";
    }

    public function print_play_button() {
 

        $playlist_tracks = get_field('song_selection', $post->ID);

        $ctr = 0;
        if ($playlist_tracks):
            ?>
            <div class="wrap-songs">
                <?php foreach ($playlist_tracks as $track): // variable must be called $post (IMPORTANT)  ?>
                    <?php //setup_postdata($track); ?>
                    <div class="item-song">
                        <?php

                        if (get_field("soundcloud_stream_url", $track->ID)) {
                            echo "<span class='play play-toggle' data-song-title='" . $track->post_title . "' data-audio-url='" . get_field("soundcloud_stream_url", $track->ID) . "' data-song-idx='$ctr'></span>";
                            $ctr++;
                        }
                        ?>
                        <span class="title-song"><?php echo $track->post_title; ?></span>
                        <?php
                        $rows = get_field('song_buy_buttons', $track->ID);
                        if ($rows) {
                            ?>
                            <div class="wrap-dropdown">
                                <span class="btb-buy dropdown">                     
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Buy</a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($rows as $row) {
                                            ?>
                                            <li><a href="<?php echo $row['song_buy_button_url']; ?>"><?php echo $row['song_buy_button_text']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </span>                 
                            </div>                              
                        <?php } ?>                          
                    </div>      
                <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly  ?>
        <?php endif; ?>
     <?php
}
/*
        $release_id = "";
        $release_link = "";
        $release_name = "";

        if ($this->album) {
            $release_id = $this->album->ID;
            $release_link = $this->album->get_permalink();
            $release_name = $this->album->post_title;
        }

        if ($this->audio_url) {
            echo "<li class='kt-track' data-track-id='" . $this->ID . "' data-track-title='" . $this->post_title . "' data-audio-url='" . $this->audio_url . "' data-release-id='$release_id' data-release-img='' data-release-link='$release_link' data-release-name='$release_name'>";
            echo "<span class='listen'>";

            echo "<span class='icon-play play-song-mid'></span>";
            echo "<span class='icon-pause'></span>";

            echo "</span>";
            echo "</li>";
        }
    }
*/
    /* public function print_video_link() {
      echo "<a href='".get_permalink($this->video)."' class='btn btn-faded btn-small' title='Video'><i class='icon-video'></i></a>";
      }

      public function print_lyrics_link() {
      echo "<a href='".$this->lyrics_link."' class='btn btn-faded btn-small'><i class='icon-text'></i></a>";
      } */

    /* public function get_video() {
      $all_artist_videos = $this->artist->get_posts("music-video", -1);

      foreach($all_artist_videos as $vid) {
      $related_track = get_field("related_track", $vid->ID);

      if($related_track && $related_track[0]->ID == $this->ID) {
      return $vid;
      }
      }
      return false;
      } */

    public function get_albums() {
        $albums = array();
        $all_albums = get_posts(array("post_type" => "albums", "posts_per_page" => -1, "post_status" => "publish"));
        foreach ($all_albums as $album) {
            $kt_album = new Release($album);

            if ($kt_album->track_exists($this)) {
                $albums[] = $kt_album;
            }
        }
        if (count($albums) > 0) {
            return $albums;
        }
        return false;
    }

    public static function on_save_track($post_id) {

        if (!wp_is_post_revision($post_id) && !isset($_GET["page"]) && $_POST["post_type"] == Track::$_post_type) {
            $raw_sc_url = get_field("audio_url", $post_id);

            $sc_stream_exists = get_field("sc_stream_exists", $post_id);

            if ($raw_sc_url && !$sc_stream_exists) {

                if (stripos($raw_sc_url, "soundcloud") !== false) {
                    $sc = new ProdSoundCloud($raw_sc_url);

                    $sc_stream_url = $sc->get_stream_url();

                    update_field("soundcloud_stream_url", $sc_stream_url, $post_id);
                } else {
                    update_field("soundcloud_stream_url", "", $post_id);
                }
            }
        }
    }

}

//V4 of acf
add_action('acf/save_post', array("Track", "on_save_track"));

//V3 of acf
//add_action('acf_save_post', array("DefTrack", "on_save_track"));