<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php 
wp_head(); 

if(has_post_thumbnail()){
	$img_id = get_post_thumbnail_id( get_the_ID() );
	$img_url = wp_get_attachment_image_url( $img_id, 'banner', '', array( 'class' => 'full-width' ) );
	if(is_front_page()){ $heading = get_bloginfo('description'); }else{ $heading = get_the_title(); }
	
}


?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#sections_nav">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		
		<div class="site-branding">

			<?php 
			$theme_options = get_option('mbm_theme_settings');
			$mbm_logo = $theme_options['mbm_theme_logo'];
			if( !empty($mbm_logo) ){ 
				$mbm_logo = '<a class="site-title" title="' . get_bloginfo( 'name' ) . '" rel="home" href="' . esc_url( home_url( '/' ) ) . '"><img class="logo" src="' . wp_get_attachment_url( $mbm_logo ) . '"></a>';
				echo($mbm_logo);
				 
			} else { 
				$mbm_logo = get_bloginfo('stylesheet_directory') . '/images/logo.svg'; 
				$mbm_logo = '<a class="site-title" title="' . get_bloginfo( 'name' ) . '" rel="home" href="' . esc_url( home_url( '/' ) ) . '"><img class="logo" src="' . $mbm_logo . '"></a>';
				echo($mbm_logo);
			}

			echo '<div class="phone">01753 694422</div>';


			?>

		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', '_s' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<!-- <div class="background" style="background-image:url(<?php echo $img_url; ?>);"></div> -->

		<h1 style="background-image:url(<?php echo $img_url; ?>);" class="section-heading"><?php echo $heading; ?></h1>
	</header><!-- #masthead -->

	<?php 
	// mbm_auto_sticky_nav(); 
	?>

	<div id="content" class="site-content">
