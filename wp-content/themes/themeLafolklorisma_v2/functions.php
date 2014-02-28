<?php
require_once(get_template_directory() . '/library/post-type.php');
register_nav_menu( 'primary', __( 'Primary Menu', 'folkTheme' ) );
add_theme_support( 'post-thumbnails' );

function custom_size_image() {
    add_image_size('crop_thumbnail', 320, 200, true);
    add_image_size('featured-image', 680, 385, true);
   // add_image_size('thumb-news', 294, 9999, false);  //news thumbs
}
add_theme_support( 'post-formats', array( 'video','gallery' ) );
add_action('init', 'custom_size_image', 0);