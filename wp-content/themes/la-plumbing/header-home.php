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
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="50">
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'intuity' ); ?></a>

	<header id="masthead" class="site-header-fullpage" role="banner">

			<?php
			$menu_args = array(
				'menu'	=> 'primary',
				'menu_class'	=> 'nav nav-pills',
				'container'	=> 'nav',
				'container_class'	=> 'navbar navbar-default',
				'container_id'	=> 'scrollspy-nav',
			);
			wp_nav_menu($menu_args);
			?>
			<div class="site-branding">

			<a id="home" href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/img/la-plumbing.svg'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>


				<?php
			/*	if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;*/

				$description = get_bloginfo( 'description' );
				//echo '<h2 id="tagline" class="fade-in one">' . $description . '</h2>';
				//echo '<h2 id="tagline" class="fade-in one">Our highly sought-after healing training school opens soon.<br><small>Submit your email address to be among the first to receive details.</small></h2>';
				// echo '<br><div class="fade-in two">' . do_shortcode('[gravityform id="2" title="false" description="false"]') . '</div>';
				/*if ( $description || is_customize_preview() ) {} */
				?>

				
			</div><!-- .site-branding -->

		</header><!-- #masthead -->
	<div class="fullscreen-bg">


		

	</div>

	<div id="content" class="site-content">