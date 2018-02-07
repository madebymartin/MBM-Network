<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Totally UK
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <title>Totally UK | Professional Beauty Brands</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Totally UK | Professional Beauty Brands" />
    <meta name="keywords" content="beauty, brands, professional, totally uk" />
    <meta name="author" content="Totally UK" />
    <meta name="google-site-verification" content="hvu86DCQt1v_zr6CxDDP3JtoQ-EiDpjNvhjjijZV49Y" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="../favicon.ico"> 
	<noscript><link rel="stylesheet" type="text/css" href="css/styleNoJS.css" /></noscript>

	<?php 
	gravity_form_enqueue_scripts( 1, true );
	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'totally-uk' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<?php

			if(is_page()){
				echo '<div class="banner"><img src="' . get_stylesheet_directory_uri() . '/img/totally-uk-logo.png" alt="Totally UK"></div>';
			}

			?>
		</header><!-- #masthead -->

		<div id="content" class="site-content">