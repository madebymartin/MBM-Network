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

<body <?php body_class(); ?>>


<?php 
	$thumb_id = get_post_thumbnail_id( get_the_ID() );
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$img_url = $thumb_url_array[0];
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'intuity' ); ?></a>

	<?php
/*		if ( has_post_thumbnail( get_the_ID() ) ) { echo '<header id="masthead" class="site-header" role="banner" style="background-image:url(' . $img_url . ');">'; }
		else{ echo '<header id="masthead" class="site-header" role="banner">'; }*/


		
	?>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">

			<a id="home" href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/img/intuity-logo-white.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>


			<?php
/*			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;*/

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle hamburger" aria-controls="primary-menu" aria-expanded="false"><span></span><span></span><span></span></button>

			<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'intuity' ); ?></button> -->
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->


		<?php 

		if(is_shop()){ $heading = 'Calendar'; }
		elseif(is_product_category()){ 
			$id = $wp_query->get_queried_object()->term_id;
			$term = get_term_by('id', $id, 'product_cat');
			$termname = $term->name;
			$heading = $termname;  
		}
		else{ $heading = get_the_title(); }


		echo '<h1 class="entry-title fade-in">'. $heading .'</h1>';

		?>

		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
