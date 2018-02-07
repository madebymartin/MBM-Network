<?php
/**
 * Germaine de Capuccini functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Germaine_de_Capuccini
 */

if ( ! function_exists( 'germaine_de_capuccini_setup' ) ) :



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function germaine_de_capuccini_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Germaine de Capuccini, use a find and replace
	 * to change 'germaine-de-capuccini' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'germaine-de-capuccini', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'germaine-de-capuccini' ),
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
	add_theme_support( 'custom-background', apply_filters( 'germaine_de_capuccini_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'germaine_de_capuccini_setup' );




/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function germaine_de_capuccini_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'germaine_de_capuccini_content_width', 640 );
}
add_action( 'after_setup_theme', 'germaine_de_capuccini_content_width', 0 );




/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function germaine_de_capuccini_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'germaine-de-capuccini' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'germaine-de-capuccini' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'germaine-de-capuccini' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here.', 'germaine-de-capuccini' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Treatments Sidebar', 'germaine-de-capuccini' ),
		'id'            => 'sidebar-treatments',
		'description'   => esc_html__( 'Add widgets here.', 'germaine-de-capuccini' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Single Treatment', 'germaine-de-capuccini' ),
		'id'            => 'single-treatment',
		'description'   => esc_html__( 'Add widgets here.', 'germaine-de-capuccini' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );


}
add_action( 'widgets_init', 'germaine_de_capuccini_widgets_init' );




/**
 * Enqueue scripts and styles.
 */
function germaine_de_capuccini_scripts() {
	//wp_enqueue_style( 'germaine-de-capuccini-style', get_stylesheet_uri() );
	wp_enqueue_style( 'germaine-de-capuccini-style', get_stylesheet_directory_uri() . '/css/style.css' );
	//wp_enqueue_style( 'germaine-de-capuccini-responsive-tabs', get_stylesheet_directory_uri() . '/css/woo-responsive-tabs.css' );


	wp_enqueue_script( 'germaine-de-capuccini-fonts', get_template_directory_uri() . '/js/typekit.js', array(), '20151215', false );
	wp_enqueue_script( 'germaine-de-capuccini-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'germaine-de-capuccini-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'germaine-de-capuccini-theme-jquery', get_template_directory_uri() . '/js/theme-jquery.js', array('jquery'), '20151215', false );



	if(is_product_category() || is_page_template( 'template-woocommerce.php' ) ){ wp_enqueue_script( 'germaine-de-capuccini-woocommerce-product_list', get_template_directory_uri() . '/js/resize_grid.js', array('jquery'), '20151215', false ); }
	


	wp_enqueue_script( 'germaine-de-capuccini-responsive-tabs', get_template_directory_uri() . '/js/woo-responsive-tabs.js', array('jquery'), '20151215', true );




	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	if(is_page_template( 'template-spa-finder.php' )){
		wp_enqueue_script( 'googlemaps3' );
		wp_enqueue_script( 'wpgeo' );		
	}
	



}
add_action( 'wp_enqueue_scripts', 'germaine_de_capuccini_scripts' );







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
			<?php echo '<a id="logo" href="'. $site_url .'"><img src="'. get_stylesheet_directory_uri() .'/img/gdc-logo-white.png" alt="Germaine de Capuccini" width="175"></a>'; ?>
			</div>
		</header>
<?php
}
add_action('login_head', 'mbm_login_items_header');





// COPYRIGHT FOR FOOTER - CALLED IN FOOTER.PHP
if ( ! function_exists( 'mbm_copyright' ) ) {
	function mbm_copyright() {
		$year = current_time( 'Y', 1 );
		if($year > '2016'){ echo 'Copyright 2016-' . $year . ' Germaine de Capuccini®'; }
		else{ echo 'Copyright ' . $year . ' Germaine de Capuccini®'; }

	}
}








if ( ! function_exists( 'mbm_get_users_total_credit' ) ) {
	function mbm_get_users_total_credit($user_id){
	    if(empty($user_id)){$user_id = get_current_user_id();}
	    $customer_email = get_userdata( $user_id )->user_email; 
	    $email_for_query = serialize($customer_email);
	    $coupons = new WP_Query( 
	        array(
	        'post_type' => 'shop_coupon',
	        'posts_per_page' => '-1',
	        'orderby' => 'date',
	        'order' => 'DESC',
	        'post_status' => 'publish',
	        'fields' => 'ids',
	        'meta_query' => array(

	                array(
	                    'key'     => 'discount_type',
	                    'value'   => 'smart_coupon',
	                    'compare' => '=',
	                ),
	                array(
	                    'key'     => 'customer_email',
	                    'value'   => $customer_email,
	                    'compare' => 'LIKE',
	                ),

	            ),
	        ) 
	    );
	    $total_credit = 0;
	    if ( $coupons->have_posts() ) {
	        foreach( $coupons->posts as $id ){
	        	$couponamount = get_post_meta($id, 'coupon_amount', true);
	        	$total_credit = $total_credit + $couponamount;
	        }
	        
	    }
	    return round($total_credit, 2);
	}
}


add_action( 'woocommerce_after_my_account', 'mbm_show_user_credit', 10, 1 );
if ( ! function_exists( 'mbm_show_user_credit' ) ) {
	function mbm_show_user_credit($user_id = null) {
		if(empty($user_id)){$user_id = get_current_user_id();}
		if(mbm_get_users_total_credit($user_id)){
			echo '<div class="total-credit"><h3>You have <span class="credit">£' . mbm_get_users_total_credit($user_id) . '</span> credit on your account</h3></div>';
		}
	}
}










function mbm_login_items_footer(){
	echo '<div class="login_copyright">';
	mbm_copyright();
	echo '</div>';
}
add_action('login_footer', 'mbm_login_items_footer');





add_filter( 'body_class','mbm_custom_woo_page_body_classes' );
if ( ! function_exists( 'mbm_custom_woo_page_body_classes' ) ) {
	function mbm_custom_woo_page_body_classes( $classes ) {
	    if ( is_page_template( 'template-woocommerce.php' ) ) {
	        $classes[] = 'woocommerce';
	        $classes[] = 'tax-product_cat';
	    }
	    return $classes;

	}
}





/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/inc/jetpack.php';

/**
 * Load CMB2 file
 */
require_once get_template_directory() . '/inc/meta.php';

/**
 * Load Custom Theme Functions
 */
require_once get_template_directory() . '/inc/functions/customise_woocommerce.php';
require_once get_template_directory() . '/inc/functions/custom_post_types.php';
require_once get_template_directory() . '/inc/functions/widgets.php';
require_once get_template_directory() . '/inc/functions/user_meta.php';






add_action('init', 'mbm_create_posts_to_posts_connections');
function mbm_create_posts_to_posts_connections(){
	p2p_register_connection_type( array( 
	    'name' => 'product-treatment',
	    'from' => 'product',
	    'to' => 'treatment',
	    'reciprocal' => false,
	    'title' => 'Related Product / Treatment'
	) );
	p2p_register_connection_type( array( 
	    'name' => 'spa-treatment',
	    'from' => 'salon',
	    'to' => 'treatment',
	    'reciprocal' => false,
	    'title' => 'Treatment / Spa'
	) );
}

