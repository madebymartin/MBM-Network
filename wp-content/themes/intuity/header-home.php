<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Intuity
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:site_name" content="Intuity Healing Academy"/>
<meta property="og:title" content="LOVE, FREEDOM AND ALIVENESS"/>
<meta property="og:image" content="http://intuityhealingacademy.com/assets/sites/3/intuity-poster-1.jpg">
<meta property="og:description" content="The Intuity Healing Academy is dedicated to raising the consciousness and ability of healers across the world"/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">



<?php 
// global $wp_rewrite;
// $wp_rewrite->init(); //important...
// $wp_rewrite->flush_rules();

wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'intuity' ); ?></a>


	<div class="fullscreen-bg">

	


	    <video id="vid" loop="true" muted="true" autoplay="autoplay" poster="<?php echo get_stylesheet_directory_uri() ?>/img/background.png" class="fullscreen-bg__video">   
			<source src="<?php echo get_stylesheet_directory_uri(); ?>/inc/video/intuity_water_drop.webm" type="video/webm">
			<source src="<?php echo get_stylesheet_directory_uri(); ?>/inc/video/intuity_water_drop.mp4" type="video/mp4">
	    </video>




		<header id="masthead" class="site-header-fullpage" role="banner">
			<div class="site-branding">

			<a id="home" href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/img/intuity-logo-white.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>


				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description' );
				echo '<h2 id="tagline" class="fade-in one">' . $description . '</h2>';
				/*if ( $description || is_customize_preview() ) {} */
				?>

				
			</div><!-- .site-branding -->


			<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle hamburger" aria-controls="primary-menu" aria-expanded="false"><span></span><span></span><span></span></button>
<!-- 				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'intuity' ); ?></button>
 -->				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->


			<div class="btn0 begin mobilehide  fade-in two" id="scroll"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/down.png" alt="down"></div>


		<!-- <a class="btn0 begin mobilehide  fade-in two" href="#main"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/down.png" alt="down"></a> -->


		</header><!-- #masthead -->




	</div>



	<div id="content" class="site-content">