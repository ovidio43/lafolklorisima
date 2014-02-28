<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
       <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>  
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
<!-- Opera Speed Dial Favicon -->
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png" />
            
<!-- Standard Favicon -->
  <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

<!-- For iPhone 4 Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-114x114-precomposed.png">

<!-- For iPad: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-72x72-precomposed.png">

<!-- For iPhone: -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-57x57-precomposed.png">
  
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancyapps/source/jquery.fancybox.css?v=<?php echo date('ymdhis')?>">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?v=<?php echo date('ymdhis')?>">

        <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
<header>
  <div class="wrapper">
    <div class="top-nav">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"> </a>
    </div>
    <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => '', 'container' => 'nav','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>')); ?>  
  </div>
</header>
