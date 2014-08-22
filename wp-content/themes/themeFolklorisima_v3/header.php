<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
        <meta name="description" content="">

        <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" size="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">

        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/bxslider/jquery.bxslider.css">

        <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 480px)" href="<?php bloginfo('template_directory'); ?>/css/flipper.css">

        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/leaflet-0.7.3/leaflet.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fotorama/fotorama.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancyapps/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/main.css">

        <script src="<?php bloginfo('template_directory'); ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="<?php bloginfo("template_directory"); ?>/js/jquery-migrate-1.0.0.js"></script>
        <script>window.jQuery || document.write('<script src="<?php bloginfo("template_directory"); ?>/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>    
        <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> 
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header id="header">
            <div class="wrap-banner">
                <?php
                if (is_home() || is_front_page()) {
                    //include('include/home-slide.php');
                } elseif (is_page('events') || is_page('tour-map') || is_page('media') || is_single()|| is_page('store')) {
                    echo "";
                }else if(is_post_type_archive('passion_items')){ ?>
                  <img src="<?php bloginfo('template_directory'); ?>/img/pasions-banner.jpg">
                <?php } else {
                    ?>
                    <img src="<?php bloginfo('template_directory'); ?>/img/internal-banner.jpg">
                <?php } ?>
            </div>
            <nav class="main-nav">
                <a id="navlogo" href="<?php bloginfo('url'); ?>/home/" alt="Click to return home" title="Click to go to Alicia Keys Home Page"></a>
              <?php        
              $defaults = array(
                'theme_location'  => 'Primary',
                'container'       => '',
                'menu_class'      => '',
                'items_wrap'      => '<ul class="desktop-nav">%3$s</ul>'
              );
              wp_nav_menu( $defaults );         
              ?>
                <i class="mobile-nav"></i>
                <ul id="social-header">
                    <li id="newsletter"><a id="newsletter-button" href="#newsletter-form" title="Sign Up for Alicia Keys Updates" class="no-ajax updates-launcher">GET EMAIL UPDATES</a> </li>
                    <li class="facebook_link"><a href="https://www.facebook.com/aliciakeys" target="_blank">Facebook</a></li>
                    <li class="twitter_link"><a href="http://twitter.com/aliciakeys" target="_blank">Twitter</a></li>
                    <li class="tumblr_link"><a href="http://thekeysofalicia.tumblr.com/" target="_blank">Tumblr</a></li>
                </ul>
            </nav>    
        </header>
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
