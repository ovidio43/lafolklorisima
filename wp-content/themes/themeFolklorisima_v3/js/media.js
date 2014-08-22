var current_playlist = [];
var current_song_idx = 0;
var sc_client_id = "7663a4303179495cb70f00bbb4e20261";
var player = null;

$(document).ready(function() {
    if($(".list-song").length > 0) {
        init_playlist();

        $(".song-item").on("click", ".play-toggle.play", function() {
            current_song_idx = $(this).attr("data-song-idx");
            $(document).trigger("play_track");
            console.log(this);

        });
        $(".song-item").on("click", ".play-toggle.pause", function() {
            $(document).trigger("pause_track");

        });

        $(".music-banner-image .small-play").click(function () {
            $($(".song-item .play-toggle")[0]).click();
        });
    }
});

$(document).bind("play_track", function () {
   $(".song-item .play-toggle").removeClass("pause").addClass("play");
   if(current_playlist !== null && player !== null) {
        //player.play(current_song_idx);
       $("#jquery_jplayer_1").jPlayer("setMedia", current_playlist[current_song_idx]).jPlayer("play"); // Attempts to Auto-Play the media
       $($(".song-item .play-toggle")[current_song_idx]).removeClass("play").addClass("pause");
   }
});
$(document).bind("pause_track", function () {
    //$(".item-song .play-toggle.pause").removeClass("play").addClass("pause");
    if(current_playlist !== null && player !== null) {
        //player.pause();
        player.jPlayer("pause")
        $($(".song-item .play-toggle")[current_song_idx]).removeClass("pause").addClass("play");
    }
});

$(document).bind("play_next", function() {
    if(current_playlist !== null && player !== null) {
        current_song_idx++;
        if(current_song_idx < current_playlist.length) {
            $(document).trigger("play_track");
        }
    }
});


function init_playlist() {
    $(".play-toggle").each(function() {
        if($(this).attr("data-audio-url") !== undefined && $(this).attr("data-audio-url") !== "") {
            console.log($(this).attr("data-audio-url"));

            var modified_audio_url = $(this).attr("data-audio-url");
            if(modified_audio_url.indexOf("soundcloud") !== -1) {
                modified_audio_url += "?client_id="+sc_client_id;
            }
            var track_data = {
                "title": $(this).attr("data-song-title"),
                "mp3": modified_audio_url
            };
            //log("get_current_playlist");
            console.log(track_data);
            current_playlist.push(track_data);
        }
    });

    if (current_playlist.length > 0) {
        /*player = new jPlayerPlaylist(
            {
                jPlayer: "#jquery_jplayer_1",
                cssSelectorAncestor: "#playlist-gui"
            }, current_playlist, {
                playlistOptions : {
                    autoPlay: false
                },
                ready: function() {

                    $("#jquery_jplayer_1").bind($.jPlayer.event.play, function(event) { // Add a listener to report the time play began
                        console.log("playing");
                    });
                    $("#jquery_jplayer_1").bind($.jPlayer.event.ended, function(event) { // Using ".jp-repeat" namespace so we can easily remove this event
                        console.log("ended");
                        player.next();
                    });
                },
                size : { },
                swfPath: "/wp-content/themes/TiestoTheme/js/jplayer",
                supplied: "mp3",
                solution: "flash, html",
                preload: "auto",
                wmode: "window"//Note that the {wmode:"window"} option is set to ensure playback in Firefox 3.6 with the Flash solution. However, the OGA format would be used in this case with the HTML solution. http://www.jplayer.org/latest/developer-guide/#jPlayer-option-wmode
            }
        );*/
        player = $("#jquery_jplayer_1").jPlayer( {
            ready: function() {

                $("#jquery_jplayer_1").bind($.jPlayer.event.play, function(event) { // Add a listener to report the time play began
                    console.log("playing");
                });
                $("#jquery_jplayer_1").bind($.jPlayer.event.ended, function(event) { // Using ".jp-repeat" namespace so we can easily remove this event
                    console.log("ended");
                    $(".play-toggle").removeClass("pause").addClass("play");
                    $(document).trigger("play_next");
                });
            },
            swfPath: "/wp-content/themes/themeAK/js/jplayer",
            supplied: "mp3",
            solution: "flash, html",
            preload: "auto",
            wmode: "window"//Note that the {wmode:"window"} option is set to ensure playback in Firefox 3.6 with the Flash solution. However, the OGA format would be used in this case with the HTML solution. http://www.jplayer.org/latest/developer-guide/#jPlayer-option-wmode
        });
        /*ready: function () {
         $(this).jPlayer("setMedia", {
         m4v: "/media/myVideo.m4v", // Defines the m4v url
         ogv: "/media/myVideo.ogv" // Defines the counterpart ogv url
         }).jPlayer("play"); // Attempts to Auto-Play the media
         },*/

       /* $("#jquery_jplayer_1").bind($.jPlayer.event.ended, function(event) { // Using ".jp-repeat" namespace so we can easily remove this event
            player.next();
        });*/
    }
}