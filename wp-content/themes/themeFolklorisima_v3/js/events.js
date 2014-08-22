var map = null;
function alicia_events() {
    // Please lint me with JSHint.
    'use strict';
    /* JSHint directives */
    /* global Modernizr, idj, jwplayer, enquire, L */
    /* exported idj */
    /* jshint browser:true, jquery:true */



    // create a map in the "map" div, set the view to the USA.
    //We check here if the map html is on the page or not.
    // If yes, (map was filtered) then we do not need to recreate the map, only redraw the markers.
    // If no (new page load via ajax) then we create a new map.
    if($("#map").length > 0) {


        var map_tiles = L.tileLayer('https://{s}.tiles.mapbox.com/v3/jeremyicon.j22fmbg2/{z}/{x}/{y}.png', {
            attribution: ''
        });

        //map = L.map('map', {center: [35, -33], zoom: 2})//, layers: [map_style]/*, minZoom: 2*/});//.setView([37, -96], 4);*/
        map = L.map('map', {center: [35, -33], zoom: 3}).addLayer(map_tiles);

        /*var map_style = L.tileLayer('http://{s}.tile.cloudmade.com/{key}/{styleId}/256/{z}/{x}/{y}.png', {
            attribution: '',
            key: "eebc37434ed84128a3212bca58739b4e",
            styleId: 113529,
            maxZoom: 19,
            minZoom: 2
        }).addTo(map);*/




        var MapIcon = L.DivIcon.extend({
            options:  {
                iconSize: [40,41],
                iconAnchor: [0, 41],
                popupAnchor: [0, -23],
                className: "map-icon"
            }
        });

        var SoldOutIcon = MapIcon.extend({
            options: {
                className: "sold-out"
            }
        });

        map.event_icon = new MapIcon();

        map.event_sold_out_icon = new SoldOutIcon();

        //Clears map and draws markers based on events
        setTimeout(function(){ $(window).trigger("draw_markers");},200);

    } 
    //else {
       // $(window).trigger("draw_markers");
    //}
}


//TODO: Create this markup the jquery way.
function generate_map_marker_popup(event_obj) {
    // Please lint me with JSHint.
    'use strict';
    /* JSHint directives */
    /* global idj, enquire, L */
    /* exported idj */
    /* jshint browser:true, jquery:true */

    var output = "<div class='eventPopup'>";

        output += "<div class='eventPopup-text'>";
            output += "<div class='eventPopup-details'>";

                output += "<div class='eventPopup-location'>";
                    output += "<div class='eventPopup-cityState'>" + event_obj.location.city_state + "</div>";
                    output += "<div class='eventPopup-venue'>" + event_obj.venue + "</div>";
                output += "</div>";
            output += "</div>";
            output += "<div class='eventPopup-actions'>";
                /*if(event_obj.event_buy_tickets_url !== null) {
                    output += "<a href='"+event_obj.event_buy_tickets_url+"' class='btn btn-muted btn-mini ticket-link'>Buy Tickets</a>";
                }*/
                output += "<a href='"+event_obj.permalink+"' class='ticket-link'>"+event_obj.photos+"</a>";
            output += "</div>";
        output += "</div>";
    output += "</div>";

    return output;
}

function reset_map(results) {
    // Please lint me with JSHint.
    'use strict';
    /* JSHint directives */
    /* global idj, enquire, L */
    /* exported idj */
    /* jshint browser:true, jquery:true */

    /*if(results !== undefined && !results) {
        events = undefined;
        //map = undefined;
    }*/
    if(map !== undefined) {
        map.markers_cluster.clearLayers();
    }

}

function remove_map() {
    'use strict';
    /* JSHint directives */
    /* global idj, enquire, L */
    /* exported idj */
    /* jshint browser:true, jquery:true */
    alert("remove");
    if(map !== undefined) {
        map = undefined;
    }
}

function dateToYMD(date) {
    var d = date.getDate();
    var m = date.getMonth() + 1;
    var y = date.getFullYear();
    return (m<=9 ? '0' + m : m) + (d <= 9 ? '0' + d : d) + y;
}

//Adds markers to map from events
$(window).on('draw_markers',function(event) {

    // Please lint me with JSHint.
    'use strict';
    /* JSHint directives */
    /* global idj, enquire, L */
    /* exported idj */
    /* jshint browser:true, jquery:true */

    if(map !== null) {

        if(map.markers_cluster === undefined) {
            ////Uncomment this line and comment the next to enable marker clustering.
            //map.markers_cluster = new L.MarkerClusterGroup({spiderfyOnMaxZoom: true, showCoverageOnHover: false, zoomToBoundsOnClick: false});
            map.markers_cluster = new L.layerGroup();
        } else {
            window.console.log("reset");
            reset_map();
        }

        //Currently, we only add events to the map that have a physical location/address
        if(events !== undefined && events.length > 0 && map !== undefined) {

            $(events).each(function() {
                //window.console.log(this);
                //window.console.log(this);
                if(this.location.lat !== null) {
                    var the_icon = map.event_icon;

                    if(this.sold_out) {
                        the_icon = map.event_sold_out_icon;
                    }
                    var detail_link = this.permalink;
                    var new_marker = new L.marker([this.location.lat, this.location.lng], {icon: the_icon}).bindPopup(generate_map_marker_popup(this), {maxWidth: 415, minWidth: 280});

                    //If we're on the event archive page, map markers should link to thier detail page.
                    if($(".single-event").length == 0) {
                        new_marker.on("click", function(e) { window.location.href = detail_link; });
                        new_marker.on("mouseover", function(e) {
                            e.target.openPopup();
                        });
                    }

                    //new_marker.on("mouseout", function(e) {
                   //     e.target.closePopup();
                    //});
                    map.markers_cluster.addLayer(new_marker);
                }
            });
            if(!map.hasLayer(map.markers_cluster)) {
                map.addLayer(map.markers_cluster);
            }
            ////map.fitBounds(map.markers_cluster.getBounds());
        } else {
            map.setView([35, -33], 2);
        }

        /*map.markers_cluster.on('clusterclick', function (a) {
            a.layer.spiderfy();
        });*/

        /*map.markers_cluster.on('click', function (a) {
            $(".leaflet-marker-icon").removeClass("expanded");
            $(a.originalEvent.target).addClass("expanded");
        });*/

        /*map.on("click", function(e) {
            $(".leaflet-marker-icon").removeClass("expanded");
        });*/
    } else {
        reset_map(false);
    }
});

