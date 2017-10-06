<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DealWire.co</title>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory') ?>/vendors/fonts/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('stylesheet_directory') ?>/vendors/fonts/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('stylesheet_directory') ?>/vendors/fonts/favicon-16x16.png">
        <link rel="manifest" href="<?php bloginfo('stylesheet_directory') ?>/vendors/fonts/manifest.json">
        <link rel="mask-icon" href="<?php bloginfo('stylesheet_directory') ?>/vendors/fonts/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/vendors/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/vendors/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/vendors/css/animate.css">
        <?php wp_head(); ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

<body <?php body_class(); ?> id="fivehundred">

    <div id="wrapper" class="hfeed">
        <header id="header" class="<?php echo apply_filters('fh_header_class', ''); ?>">
            <?php get_template_part('headerwrapper', 'above'); ?>
            <div class="headerwrapper">
                <input class="nav-check" type="checkbox" name="nav-check">
                <label class="nav-check-label" for="nav-check"></label>
                <?php get_template_part('nav', 'above-mobile'); ?>
                <?php get_template_part('branding'); ?>
                <?php get_template_part('nav', 'above'); ?>
            </div>
            <?php get_template_part('headerwrapper', 'below'); ?>
        </header>
    <?php if (isset($post) && $post->post_type == 'post' && is_home()) { ?>
        <div id="containerwrapper" class="<?php echo (isset($post) ? $post->post_type : ''); ?> containerwrapper-home">
    <?php } else { ?>
    <div id="containerwrapper" class="<?php echo (isset($post) ? $post->post_type : ''); ?> containerwrapper">
    <?php } ?>