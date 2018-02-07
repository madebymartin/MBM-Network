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

<link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/img/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
<link rel="manifest" href="/img/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">



<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<?php 
	

	if ( class_exists( 'WooCommerce' ) ) {
		if( is_product_category() ){
			global $wp_query;
		    $cat = $wp_query->get_queried_object();
		    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		    $img_url = wp_get_attachment_url( $thumbnail_id );

		}
	}
	else{
		$thumb_id = get_post_thumbnail_id( get_the_ID() );
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$img_url = $thumb_url_array[0];
	}
	

?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'intuity' ); ?></a>

<div class="pagetop">


	<header id="masthead" class="site-header-fullpage" role="banner">
		<div class="site-branding">

		<a id="home" href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/img/kylawilliams-heart.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle hamburger" aria-controls="primary-menu" aria-expanded="false"><span></span><span></span><span></span></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->


	<div class="header-bg" style="background-image:url(<?php echo $img_url; ?>);">
		
		<?php
		if(is_page()){
			echo '<h1>' . get_the_title() . '</h1>';
		}elseif(is_product()){
			echo '<h1 itemprop="name" class="product_title entry-title">'. get_the_title() .'</h1>';
		}elseif( is_product_category() ){
			$id = get_queried_object_id();
			$term = get_term_by('id', $id, 'product_cat');
			echo '<h1 itemprop="name" class="entry-title">'. $term->name .'</h1>';
		}
		?>

	</div>

</div>

	<div id="content" class="site-content">
