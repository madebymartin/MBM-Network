<?php
/**
 * Implementation of the Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package paloma
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses paloma_header_style()
 * @uses paloma_admin_header_style()
 * @uses paloma_admin_header_image()
 */
function paloma_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'paloma_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 3000,
		'flex-height'            => true,
		'height'                 => 1700,
		'flex-height'            => true,
		'wp-head-callback'       => 'paloma_header_style',
		'admin-head-callback'    => 'paloma_admin_header_style',
		'admin-preview-callback' => 'paloma_admin_header_image',
		'video' 				 => true,
	) ) );
}
add_action( 'after_setup_theme', 'paloma_custom_header_setup' );

if ( ! function_exists( 'paloma_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see paloma_custom_header_setup().
 */
function paloma_header_style() {
	$header_text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}

	<?php endif; ?>
	</style>
	<?php
}
endif; // paloma_header_style

if ( ! function_exists( 'paloma_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see paloma_custom_header_setup().
 */
function paloma_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // paloma_admin_header_style

if ( ! function_exists( 'paloma_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see paloma_custom_header_setup().
 */
function paloma_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // paloma_admin_header_image

/**
 * Add class to body when header video active AND uploaded in customizer
 *
 */
		add_filter( 'body_class', 'paloma_header_video_active_class' ); //Add class to body
	    function paloma_header_video_active_class( $classes ) {
				if ( is_header_video_active() && has_header_video()) {
		     	   $classes[] = 'header-video';
		    	}
		    	return $classes;
			} 

/**
 * Add class to body when header video active AND uploaded in customizer
 *
 */
		add_filter( 'body_class', 'paloma_custom_header_class' ); //Add class to body
	    function paloma_custom_header_class( $classes ) {
				if ( has_custom_header() && is_front_page()) {
		     	   $classes[] = 'custom-header-active';
		    	}
		    	return $classes;
			} 

/**
 * Add class to body when header display style set in customizer
 *
 */
		add_filter( 'body_class', 'paloma_header_style_class' ); //Add class to body
	    function paloma_header_style_class( $classes ) {
	    	$stnsvn_header_style = get_theme_mod('stnsvn_header_style', 'height');
				if ( $stnsvn_header_style == 'height') {
		     	   $classes[] = 'full-height-header';
		    	}
		    	return $classes;
			} 

/**
 * Customize video settings for custom header.
 *
 * @param array $settings Video settings.
 */
function paloma_video_settings( $settings ) {
	$settings['minWidth'] = '768';
	return $settings;
}
add_filter( 'header_video_settings', 'paloma_video_settings' );

