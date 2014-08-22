<?php
/* Custom class used to interact with the Event custom post type. */
/* Author: jeremy@prod4ever.com */

require_once('wp_object.php');

class Event extends WP_Object {

    static $_post_type = 'tour_dates';

    function __construct($event_post) {
        parent::__construct($event_post);
    }

    function __get($column) {
        $correspondences = array(
        );

        if (array_key_exists($column, $correspondences))
            return parent::__get($correspondences[$column]);

        switch ($column) {
            
        }

        return parent::__get($column);
    }

    public function generate_map_data() {

        $images = get_field('gallery_image',$this->ID);
        $photos= sizeof($images)." Photos";

        $date = $this->event_date;
        $pretty_date = date("M d Y", strtotime($date));
        $venue = $this->venue;
        $event_vip_tickets_url = $this->event_vip_tickets_url;
        $event_buy_tickets_url = $this->event_buy_tickets_url;
        $event_pre_sales_tickets_url = $this->event_pre_sales_tickets_url;
        $event_custom_buttons = $this->event_custom_buttons;
        
        //Physical location

        $location_data = $this->get_location;
        $city_state = $location_data["address"];


        $lat = $location_data['lat'];
        $lng = $location_data['lng'];
        $location = array("lat" => $lat, "lng" => $lng, "city_state" => $city_state);

        //$fb_event_link = $this->fb_event_link;
        $sold_out = $this->sold_out[0] == "Sold Out";

        $event_data = array(
            "sold_out" => $sold_out,
            "permalink" => $this->get_permalink(),
            "date" => $pretty_date,
            "location" => $location,
            "venue" => $venue,
            "event_vip_tickets_url" => $event_vip_tickets_url,
            "event_buy_tickets_url" => $event_buy_tickets_url,
            "event_pre_sales_tickets_url" => $event_pre_sales_tickets_url,
            "event_custom_buttons" => $event_custom_buttons,
            "photos" => $photos
            );

        return $event_data;
    }

    public function is_upcoming() {
        return strtotime($this->event_date) >= strtotime("today");
    }

    //Compares event dates
    public static function order_events_by_date($a, $b) {
        return strtotime($a["date"]) > strtotime($b["date"]);
    }
    public static function reverse_order_events_by_date($a, $b) {
        return strtotime($a["date"]) < strtotime($b["date"]);
    }
/*
    public static function print_event_row($event_array, $c = 0, $single=0) {
        //print_r($event_array);
        //Assigns variables based on the event_array.
        /*
         * EXAMPLE:
          Array
          (
          [link] => http://www.bandsintown.com/event/5702882/buy_tickets?app_id=DefJam&amp;artist=Rihanna
          [link_text] => TIX
          [artist] => Rihanna
          [date] => Apr 11 2013
          [img] => http://defjam.localhost.com/wp-content/uploads/2013/03/rihanna2-150x150.jpg
          [location] => Array
          (
          [lat] => 32.7537930
          [lng] => -117.2111500
          [city_state] => San Diego, CA
          )
          [fb_link] => http://www.bandsintown.com/event/5702882/facebook_rsvp?app_id=DefJam&amp;artist=Rihanna&amp;came_from=67
          [venue] => Valley View Casino Center formerly San Diego Sports Arena
          )
         *//*
        $cebra = '#F6F6F6';
        if ($c % 2 == 0) {
            $cebra = '#FFF';
        }

        if (!is_array($event_array)) {
            return;
        }
        extract($event_array, EXTR_PREFIX_SAME, "def_");
        //TODO: Pass this in as part of the array instead of looking up here.  Possible speed enhancement?
        ?>
        <div class='eventRow' style="background-color: <?php echo $cebra ?>;">
            <div class='eventRow-date hidden-phone'>
                <?php
                list($e_month, $e_day, $e_year) = explode(" ", $date);
                echo "<span class='eventRow-month'>$e_month</span>";
                echo "<span class='eventRow-day'>$e_day</span>";
                echo "<span class='eventRow-year'>$e_year</span>";
                ?>
            </div>
            <div class="eventRow-content">
                <a href='<?php echo $permalink; ?>'>
                    <div class='eventRow-details'>
                        <div class="eventRow-date visible-phone">
                            <?php
                            list($e_month, $e_day, $e_year) = explode(" ", $date);
                            echo "<span class='eventRow-month'>$e_month</span>";
                            echo "<span class='eventRow-day'>$e_day</span>";
                            ?>
                        </div>
                        <div class="eventRow-location">
                            <?php
                            if (isset($location["city_state"])) {
                                echo "<span class='eventRow-cityState'>";
                                echo $location["city_state"];
                                echo "</span>";
                            }
                            ?>
                            <br> <span class="eventRow-venue">
                                <?= $venue; ?>
                            </span>
                        </div>
                    </div>
                </a>                
            </div>
            <?php
                if($single==0){
                    $wrap_start = '<div class="eventRow-actions">
                                    <div class="eventRow-actions-inner">';
                    $wrap_end = "</div></div>";
                } else {
                    $wrap_start = '</div><div class="group-btb">';
                    $wrap_end = "</div>";
                }

                echo $wrap_start;              
                    if ($event_custom_buttons) {
                        foreach($event_custom_buttons as $row)
                        {
                        ?>
                        <a class="btn_"  style="background-color:<?php echo $row['tour_button_color']; ?>;" href="<?php echo $row['tour_button_url']; ?>"><?php echo $row['tour_button_text']?></a>
                        <?php
                        }
                    }
                    if ($event_vip_tickets_url != '') {
                        ?>
                        <a class="btn_ mod1" href="<?php echo $event_vip_tickets_url; ?>">VIP TICKETS</a>
                        <?php
                    }
                    if ($event_buy_tickets_url != '') {
                        ?>
                        <a class="btn_ mod2" href="<?php echo $event_buy_tickets_url; ?>">BUY TICKETS</a>
                        <?php
                    }
                    if ($event_pre_sales_tickets_url != '') {
                        ?>
                        <a class="btn_ mod2" href="<?php echo $event_pre_sales_tickets_url; ?>">PRE-SALE</a>
                        <?php
                    }                    
                    if ($sold_out != '') {
                        ?>
                        <div class="btn_ mod3">SOLD OUT</div>
                        <?php
                    }

                echo $wrap_end;
                ?>
        <?php if($single == 0) { ?>
            <div class="eventRow-more"><a href="#" class="more_link">MORE</a></div>
        <?php }?>

        </div> <!-- /eventRow -->
        <?php
    }
*/
    /* static function find_all()
      {
      //print_r(DefArtist::find_all());
      $custom_events = Event::find_all_by_artists(DefArtist::find_all());
      print_r($custom_events);
      echo "123";
      } */

    //Gets all upcoming events for the given artists, or all artists if no artists specified
    public static function get_events($past = False) {
        if($past){
            $custom_events = Event::find($_GET['filter']);
        }else{
            $custom_events = Event::find_all();
        }
        
        $master_events = array();
        foreach ($custom_events as $event) {
            $location = get_field('get_location',$event->ID);
            if(!empty($location['lat']) && !empty($location['lng'])){               
                if($past){
                     $master_events[] = $event->generate_map_data();
                }else{
                    if (!$past && $event->is_upcoming()) {
                        $master_events[] = $event->generate_map_data();
                    } if ($past && !$event->is_upcoming()) {
                        $master_events[] = $event->generate_map_data();
                    }                     
                }
         
            }
        }
        return $master_events;
    }

    /*public static function print_events_paged($offset = 0, $num = 10, $past = false) {
        if (isset($_POST["offset"])) {
            $offset = $_POST["offset"];
            $past = (bool)$_POST['past'];
            $ajax = true;
        } else {
            $ajax = false;
        }

        $master_events = Event::get_events($past);


        //Sort events by date
        if(!$past) {
            usort($master_events, array("Event", "order_events_by_date"));
        } else {
            usort($master_events, array("Event", "reverse_order_events_by_date"));
        }

        $ctr = 0;
        $all_upcoming_events = $master_events;

        $upcoming_events_with_offset = array_slice($master_events, $offset, $num); //$all_upcoming_events = $master_events;
        //$all_upcoming_events = $master_events;
        //Use only the desired number of events starting at offset and continue to $num.
        //$upcoming_events_with_offset = array_slice($all_upcoming_events, $offset, $num);

        if ($ajax) {
            ob_start();
        }
        echo "<div class='eventListing'>";
        // print_r($upcoming_events_with_offset);
        foreach ($upcoming_events_with_offset as $e) {
            if ($ctr < $num) {
                Event::print_event_row($e, $ctr);
                $ctr++;
            } else {
                break;
            }
        }
        echo "</div> <!-- /eventListing -->";
        $more_posts = count($all_upcoming_events) - $offset - $num;
        if ($ajax) {
            $events_html = ob_get_contents();

            $events_return_data = array("html" => $events_html, "more_posts" => $more_posts);
            //print_r($events_return_data);
            ob_end_clean();
        }
        if (!is_front_page()) {
            if (!$ajax) {
                echo "<script>var events = " . json_encode($all_upcoming_events) . "</script>";
            } else {
                //echo $ctr . " - " . $offset . " - " . $more_posts;
                //print_r(json_encode($events_return_data));
                echo json_encode($events_return_data);
                exit;
            }
        }

        return array("more_posts" => $more_posts, "found_posts" => count($upcoming_events_with_offset));
    }*/

    public static function json_events() {
        global $post;
        $upcoming_events = FALSE;

        //if (is_post_type_archive("tour_dates")) {
         if (is_page("tour-map")){
            ////$upcoming_events = get_transient("all_upcoming_events");
            ////if(!$upcoming_events) {
            $status = False;
            if($_GET['filter']!="")
                $status = True;
                
            $upcoming_events = Event::get_events($status);
            ////set_transient("all_upcoming_events", $upcoming_events);
            ////}
        } else if (is_single() & $post->post_type == "tour_dates") {
            $this_event = new Event($post);
            $upcoming_events = Array($this_event->generate_map_data($this_event));
        }

        if ($upcoming_events) {
            echo "<script>var events = " . json_encode($upcoming_events) . "</script>";
        }
    }

}

add_action('wp_head', array("Event", "json_events"));

add_action('wp_ajax_get-more-events', array('Event', 'print_events_paged'));
add_action('wp_ajax_nopriv_get-more-events', array('Event', 'print_events_paged'));
