<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package London_Spa_Company
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<!-- <script>
jQuery(document).ready(function( $ ) {
    $(function() {
        $.scrollify({
            section : ".section",
        });
    });
});
</script> -->




<?php wp_head(); ?>




</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'london-spa-company' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) {
				echo '<h1 class="site-title"><a title="'. get_bloginfo( 'name' ) .'" href="'. esc_url( home_url( '/' ) ) .'"><img src="'. get_stylesheet_directory_uri() .'/img/lsco-logo-gold.png" alt="'. get_bloginfo( 'name' ) .'"></a></h1>';
			} else {
				echo '<span class="site-title"><a title="'. get_bloginfo( 'name' ) .'" href="'. esc_url( home_url( '/' ) ) .'"><img src="'. get_stylesheet_directory_uri() .'/img/lsco-logo-gold.png" alt="'. get_bloginfo( 'name' ) .'"></a></span>';
			}


			/*			
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) {
				echo '<p class="site-description">'. $description .'</p>';
			} */


			?>


		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">

		<script>
			jQuery(document).ready(function(){
				jQuery('#nav-icon1,.menu-toggle').click(function(){
					jQuery(this).toggleClass('toggled');
				});
			});
		</script>

			<button class="menu-toggle hamburger hamburger--slider" aria-controls="primary-menu" aria-expanded="false">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
			<?php 
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); 
			wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_id' => 'mobile-menu' ) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
