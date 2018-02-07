<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GdC2016
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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'germaine-de-capuccini' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php global $woocommerce; ?>

		<div class="site-branding">
			<?php

			echo '<a id="logo" href="'. esc_url( home_url( '/' ) ) .'"><img src="'. get_stylesheet_directory_uri() .'/img/gdc-logo-white.png" alt="'. get_bloginfo( 'name' ) .'" width="200"></a>';

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; 

			if(! is_cart()){ mbm_cart_link(); }

			?>


		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->
	
		<?php 

$fallback_image = get_stylesheet_directory_uri() . '/img/banner.jpg';




	if (is_shop( )){ 
		get_template_part( 'template-parts/banners', 'home' );
	}

	/*
	else{
		if(is_singular( 'product' )){ 
			$categories = get_the_terms( $post->ID , 'pa_product_range' );
			// if (is_array($categories)) {
			// 	foreach($categories as $category) {
			//  	$tax_term_id = $category->term_taxonomy_id;
			//  	$images = get_option('taxonomy_image_plugin');
			//  	$imgsrc = wp_get_attachment_image_src( $images[$tax_term_id], 'full' );
			//  	$bgimage = $imgsrc['0'];
			// }
			if(empty($bgimage)){$bgimage = $fallback_image;} else{$bgimage = $bgimage;}
			
			
			$h1 = get_the_title();
		}
		

		if (is_tax( 'product_cat' )){ 
			$prodcat_id = get_queried_object()->term_id;
			$term = get_term_by( 'id', $prodcat_id, 'product_cat');
			$term_name = $term->name;
			$thumbnail_id = get_woocommerce_term_meta( $prodcat_id, 'thumbnail_id', true ); 
		    $image = wp_get_attachment_url( $thumbnail_id );
		    if(!empty($image)){$bgimage = $image;}
		    else{$bgimage = $fallback_image;}
		    $h1 = $term_name;
		}

		elseif (is_tax( )){ 
			$term_id = get_queried_object()->term_id;
			$h1 = get_the_title($term_id);
			$bgimage = apply_filters( 'taxonomy-images-queried-term-image-url', '', array( 'image_size' => 'full' ) ); 
		}

		elseif(is_singular( 'treatments' )){ 
			$post_thumbnail_id = get_post_thumbnail_id( '53');
			$thumb_url = wp_get_attachment_image_src($post_thumbnail_id,'full', true);
			$bgimage = $thumb_url['0'];
			$h1 = get_the_title();
		}

		elseif (is_singular( 'pressarticle' )){ 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id('3659'), '' );
			$bgimage = $thumb['0'];
			$h1 = get_the_title();
		}

			
		elseif (is_shop( )){ 
			$bgimage = $fallback_image; 
			$h1 = get_the_title();
		}

		else{
		// none of the above
			if ( has_post_thumbnail() ) { 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
			$bgimage = $thumb['0'];
			}
			else { 
				$bgimage = $fallback_image;
			} 			
			$h1 = get_the_title();
		}

		echo '<div id="banner" style="background-image:url('. $bgimage .')"><h1>' . $h1 . '</h1></div>';
	}*/ 
	?>		
	

	<div id="content" class="site-content">
	<?php 
	if(is_product_category() || is_page_template( 'template-woocommerce.php' ) ){
		do_action('mbm_before_main_content'); 
	}
	
	?>