<?php
/**
 * The header for paloma theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paloma
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0];
?>

<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:type" content="blog"/>
<meta property="og:title" content="<?php the_title(); ?>"/>
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:image" content="<?php echo $thumb_url; ?>"/>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="masthead" class="site-header" role="banner"
			
			<?php if ( get_header_image() && is_front_page() ){
				echo 'style="background: url(\'' , header_image() , '\'), no-repeat; background-position: 50% 0; background-size: cover;"';
			} ?>
	> 

	<?php //Set anchor for sticky nav ?>
		<span id="sticky-anchor"></span>
	<?php get_template_part( 'template-parts/header', 'nav' ); ?>

	<?php if (is_front_page()){
		the_custom_header_markup();
		} 
	?>

		<div class="site-branding">

			<?php   //If logo is uploaded, display it instead of site title
					$logo_upload = get_theme_mod( 'logo_upload' );
    				if( $logo_upload != '' ) {
						echo '<div class="header-logo" id="body-logo"><a href="' , get_home_url() , '"><img src="' , get_theme_mod('logo_upload') , '" alt="' , get_bloginfo ( 'name' ) , '"></a></div>';
						}					
					else if ( is_front_page() ) : ?>
						
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
						
						<?php //display accent squiggle 
							get_template_part( 'template-parts/content', 'accent' ); 
						?>
						
						
					<?php else : ?>
						<p class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</p>

						<?php //display accent squiggle 
							get_template_part( 'template-parts/content', 'accent' ); 
						?>

					<?php endif; ?>

			<p class="site-description"><?php bloginfo( 'description' ); ?></p>

		</div><!-- .site-branding -->

		<?php if (is_front_page() && has_custom_header()){ ?>

			<?php //Display header overlay text if set in customizer 
				$stnsvn_header_text = get_theme_mod('stnsvn_header_text', '');
				if ($stnsvn_header_text != '') {	
					echo '<div class="header-overlay">' , $stnsvn_header_text , '</div>';
				} 
			?>

			<?php //display the scroll down text/arrow ?>
			<div class="menu-scroll-down">
				<a href="#content">

					<?php $stnsvn_scroll_text = get_theme_mod('stnsvn_scroll_text', 'Scroll for the Good Stuff');
						if ($stnsvn_scroll_text != '') {	
							echo '<h3>' , $stnsvn_scroll_text , '</h3>';
						} 
					?>

					<?php $stnsvn_scroll_arrow = get_theme_mod('stnsvn_scroll_arrow', '1');
						if ($stnsvn_scroll_arrow == '1') { ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="19.7" height="19.8" viewBox="0 0 19.7 19.8">
							  <path d="M.9 9l8.9 9 9-9m-9 8.3V0" class="arrow-svg"/>
							</svg>
						<?php } 
					?>
					
				</a>
			</div>

		<?php } ?>

	</header><!-- #masthead -->

	<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'paloma' ); ?></a>

		<?php //Action to display slider and call to action boxes if enabled ?>
		<?php do_action('stnsvn_pre_content'); ?>

	<div id="content" class="site-content">

		<?php do_action('stnsvn_featured'); ?>