<?php
/**
 * London Spa Company functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package London_Spa_Company
 */

if ( ! function_exists( 'london_spa_company_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function london_spa_company_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on London Spa Company, use a find and replace
	 * to change 'london-spa-company' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'london-spa-company', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'london-spa-company' ),
		'mobile' => esc_html__( 'Mobile', 'london-spa-company' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'london_spa_company_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'london_spa_company_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function london_spa_company_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'london_spa_company_content_width', 640 );
}
add_action( 'after_setup_theme', 'london_spa_company_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function london_spa_company_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'london-spa-company' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'london-spa-company' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'london_spa_company_widgets_init' );




/**
 * Enqueue scripts and styles.
 */
function london_spa_company_scripts() {


	wp_enqueue_style( 'london-spa-company-fonts', 'https://fonts.googleapis.com/css?family=Crimson+Text' );
	wp_enqueue_style( 'london-spa-company-style', get_stylesheet_directory_uri() . '/style.css' );
	//wp_enqueue_style( 'london-spa-company-fullpage-css', get_template_directory_uri() . '/css/jquery.fullpage.css' );
	wp_enqueue_script( 'london-spa-company-jquery', get_template_directory_uri() . '/js/jquery-1.9.js', array(), '20160713', false );
	
	if ( is_page_template( 'template-scrolling-sections.php' ) ) {
		wp_enqueue_script( 'london-spa-company-fullpage-js', get_template_directory_uri() . '/js/jquery.fullpage.js', array('london-spa-company-jquery'), '20160713', false );
		wp_enqueue_script( 'london-spa-company-fullpage-init-js', get_template_directory_uri() . '/js/jquery.fullpage.init.js', array('london-spa-company-fullpage-js'), '20160713', false );
	}

	wp_enqueue_script( 'london-spa-company-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );	
	wp_enqueue_script( 'london-spa-company-trunk', get_template_directory_uri() . '/js/trunk.js', array('london-spa-company-jquery'), '20160713', false );
	wp_enqueue_script( 'london-spa-company-html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '20160713', true );
	wp_enqueue_script( 'london-spa-company-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'london_spa_company_scripts' );







/**
 * Hide editor for specific page templates.
 *
 */
add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
	// Get the Post ID.
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	if( !isset( $post_id ) ) return;

	// Get the name of the Page Template file.
	$template_file = get_post_meta($post_id, '_wp_page_template', true);
    
    if($template_file == 'template-scrolling-sections.php'){ // edit the template name
    	remove_post_type_support('page', 'editor');
    }
}









add_filter( 'nav_menu_link_attributes', 'wpse121123_contact_menu_atts', 10, 3 );
function wpse121123_contact_menu_atts( $atts, $item, $args )
{
  // The ID of the target menu item
  $menu_target = 'menu-item-27';

  // inspect $item
  if ($item->ID == $menu_target) {
    $atts['data-toggle'] = 'modal';
  }
  return $atts;
}






function mbm_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/style-login.css' );
    //wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'mbm_login_stylesheet' );


function mbm_login_items_header(){
	echo '';

	$site_url = get_site_url();
	?>
	<div id="page" class="site">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
			<?php echo '<a id="logo" href="'. $site_url .'"><img src="'. get_stylesheet_directory_uri() .'/img/lsco-logo-gold.png" alt="TUK Professional" width="175"></a>'; ?>
			</div>
		</header>
<?php
}
add_action('login_head', 'mbm_login_items_header');


function mbm_login_items_footer(){
	echo '<div class="login_copyright">';
	lsco_copyright();
	echo '</div>';
}
add_action('login_footer', 'mbm_login_items_footer');




function registerCustomAdminCss(){
	$src = get_stylesheet_directory_uri() . '/css/admin.css';
	$handle = "customAdminCss";
	wp_register_script($handle, $src);
	wp_enqueue_style($handle, $src, array(), false, false);
}
add_action('admin_head', 'registerCustomAdminCss');





// COPYRIGHT FOR FOOTER - CALLED IN FOOTER.PHP
if ( ! function_exists( 'lsco_copyright' ) ) {
	function lsco_copyright() {
		$year = current_time( 'Y', 1 );
		if($year > '2016'){ echo 'Copyright 2016-' . $year . ' London Spa Company®'; }
		else{ echo 'Copyright ' . $year . ' London Spa Company®'; }

	}
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load CMB2 file.
 */
require_once get_template_directory() . '/inc/cmb2.php';
