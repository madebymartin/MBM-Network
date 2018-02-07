<?php
/**
 * Totally UK functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Totally UK
 */

require_once('inc/cmb/meta.php');





//Custom Login// --------------------------------------------------------------------------------------------------

add_filter( 'login_headerurl', 'w4_login_headerurl');
function w4_login_headerurl(){
	return home_url('/');
}

add_filter( 'login_headertitle', 'w4_login_headertitle');
function w4_login_headertitle(){
	return get_bloginfo('title', 'display' );
}

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return home_url();
		} 
		elseif ( in_array( 'trade-customer', $user->roles ) ) {
			return home_url();
		}
		else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/css/login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );



add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
    return get_stylesheet_directory_uri() . "/img/spinner.gif";
}





if ( ! function_exists( 'totally_uk_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function totally_uk_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Totally UK, use a find and replace
	 * to change 'totally-uk' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'totally-uk', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'totally-uk' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'totally_uk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // totally_uk_setup
add_action( 'after_setup_theme', 'totally_uk_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function totally_uk_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'totally_uk_content_width', 640 );
}
add_action( 'after_setup_theme', 'totally_uk_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function totally_uk_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'totally-uk' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'totally_uk_widgets_init' );





/*
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
return true;
}*/


add_filter( 'gform_confirmation_anchor', '__return_true' );
add_filter("gform_confirmation_anchor", create_function("","return true;"));

add_filter( 'gform_confirmation_anchor', function() {
    return 20;
} );

add_filter( 'gform_validation_error_anchor', function() {
    return 20;
} );



/**
 * Enqueue scripts and styles.
 */
function totally_uk_scripts() {

	// deregister default jQuery included with Wordpress
	//wp_deregister_script( 'jquery' );
	//$jquery_cdn = 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js';
	//wp_enqueue_script( 'jquery2', $jquery_cdn, array(), '20130115', true );



	wp_enqueue_style( 'totally-uk-style', get_stylesheet_uri() );
	wp_enqueue_script( 'totally-uk-modernizr', get_template_directory_uri() . '/js/modernizr.custom.79639.js', array(), '20120206', false );
	wp_enqueue_script( 'totally-uk-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'totally-uk-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	//wp_enqueue_script( 'totally-uk-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '', false );


	wp_enqueue_script( 'totally-uk-ba-cond', get_template_directory_uri() . '/js/jquery.ba-cond.min.js', array('jquery'), '1', true );
	wp_enqueue_script( 'totally-uk-jquery-slitslider', get_template_directory_uri() . '/js/jquery.slitslider.js', array('jquery'), '1', true );
	wp_enqueue_script( 'totally-uk-slitslider', get_template_directory_uri() . '/js/slitslider.js', array('jquery'), '1', true );




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'totally_uk_scripts' );






/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
