<?php
/**
 * paloma functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package paloma
 */

if ( ! function_exists( 'paloma_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function paloma_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'paloma', get_template_directory() . '/languages' );

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
	 * Enable support for Post Thumbnails on posts and pages. Register custom sizes.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'landscape-featured', 750, 520, TRUE );
	add_image_size( 'index-featured', 1000, 695, TRUE );
	add_image_size( 'slider-image', 1875, 750, TRUE );

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'paloma'),
		'footer' => esc_html__( 'Footer Menu', 'paloma'),
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

}
endif; // paloma_setup
add_action( 'after_setup_theme', 'paloma_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paloma_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'paloma_content_width', 1100 );
}
add_action( 'after_setup_theme', 'paloma_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paloma_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'paloma' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Newsletter Footer', 'paloma' ),
		'id'            => 'newsletter-footer',
		'description'   => __('This widgetized area is styled specifically for the Genesis eNews Extended and Station Seven Social Icons widgets only.', 'paloma' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Footer', 'paloma' ),
		'id'            => 'instagram-footer',
		'description'   => __('This widgetized area is styled specifically for the Instagram widget only.', 'paloma' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );		

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'paloma' ),
		'id'            => 'footer-1',
		'description'   => __('This area must be enabled under Appearance > Customize > Footer in order to display.', 'paloma' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'paloma' ),
		'id'            => 'footer-2',
		'description'   => __('This area must be enabled under Appearance > Customize > Footer in order to display.', 'paloma' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'paloma' ),
		'id'            => 'footer-3',
		'description'   => __('This area must be enabled under Appearance > Customize > Footer in order to display.', 'paloma' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'paloma' ),
		'id'            => 'footer-4',
		'description'   => __('This area must be enabled under Appearance > Customize > Footer in order to display.', 'paloma' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'paloma_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function paloma_scripts() {
	wp_enqueue_style( 'paloma-style', get_stylesheet_uri() );

	wp_enqueue_script( 'paloma-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'paloma-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'pinterest', '//assets.pinterest.com/js/pinit.js', '', '', true );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', '', '4.1.1', true );
    wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', '', '2.0.5', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', '', '', true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', '', '0.1.0', true );

    //Only load sticky js and resize sensor if sticky sidebar is enabled
    $stnsvn_sidebar_sticky = get_theme_mod('stnsvn_sidebar_sticky', 0);
    if ($stnsvn_sidebar_sticky != 1) {
	    wp_enqueue_script( 'ResizeSensor', get_template_directory_uri() . '/js/ResizeSensor.min.js', '', '', true );
	   	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', '', '1.6.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'paloma_scripts' );

//Register js parameters for conditional script loading
    //Implement sticky sidebar
    add_action('wp_footer','paloma_sticky_sidebar');
    function paloma_sticky_sidebar() {
        $stnsvn_sidebar_sticky = get_theme_mod( 'stnsvn_sidebar_sticky', 0 );

        //Set variable for sticky
        if ($stnsvn_sidebar_sticky == 1) {
            $stnsvn_is_sticky = 'false';
        } else {
            $stnsvn_is_sticky = 'true';
        }

        //Localize the script
        wp_localize_script( 'main', 'palomaSidebar', array('sticky' => $stnsvn_is_sticky) );
    }

    //Implement sticky back to top button
    add_action('wp_footer','paloma_sticky_btt');
    function paloma_sticky_btt() {
        $stnsvn_btt_sticky = get_theme_mod( 'stnsvn_btt_sticky', 0 );

        //Set variable for sticky
        if ($stnsvn_btt_sticky == 1) {
            $stnsvn_btt_sticky = 'false';
        } else {
            $stnsvn_btt_sticky = 'true';
        }

        //Localize the script
        wp_localize_script( 'main', 'palomaBtt', array('sticky' => $stnsvn_btt_sticky) );
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
 * Load Jetpack compatibility file (if Jetpack active).
 */
if( class_exists( 'Jetpack' )){
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Station Seven Functions Begin
 *
 * 
 */

/*
 * If WooCommerce installed, load WC functions.
 */
if (class_exists( 'WooCommerce' )){
require get_template_directory() . '/inc/woocommerce.php';
}

/*
 * Setup third party plugins
 */
require_once('inc/plugins/tgm-plugin-activation/tgm-plugin-activation-config.php');


/*
 * Setup one click install
 */

function stnsvn_import_files() {
  return array(
    array(
      'import_file_name'           => 'Demo Content Import',
      'import_file_url'            => 'http://www.updates.stnsvn.com/paloma/demo/content.xml',
      'import_widget_file_url'     => 'http://www.updates.stnsvn.com/paloma/demo/widgets.json',
      'import_customizer_file_url' => 'http://www.updates.stnsvn.com/paloma/demo/customizer.dat',
      'import_preview_image_url'   => 'http://www.your_domain.com/ocdi/preview_import_image1.jpg',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'stnsvn_import_files' );

// Set front page/posts page after demo data import
function stnsvn_after_import_setup() {

	// Menus to import and assign
	$main_menu   = get_term_by('name', 'Primary Menu', 'nav_menu');
	$secondary_menu   = get_term_by('name', 'Footer Menu', 'nav_menu');

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
			'footer' => $secondary_menu->term_id
		)
	);

    // Assign front page and posts page.
    $front_page_id = get_page_by_title( 'Landing Page' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'stnsvn_after_import_setup' );

//Disable click-to-tweet after content import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Load Jetpack plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugins/plugin-enhancements/plugin-enhancements.php';

/**
* Load Google Fonts
*/
add_action( 'wp_enqueue_scripts', 'paloma_enqueue_fonts' );
function paloma_enqueue_fonts() {
    wp_enqueue_style( 'paloma-google-fonts', '//fonts.googleapis.com/css?family=Poppins:300,400,500,700', array(), null );
}

/**
* Load Font Awesome
*/
add_action( 'wp_enqueue_scripts', 'paloma_font_awesome' );
function paloma_font_awesome() {
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}

//Manage Featured Slider customizer actions

    //Implement featured slider settings
    add_action('wp_footer','paloma_featured_autoscroll');
    function paloma_featured_autoscroll() {
        $paloma_autoscroll_delay = get_theme_mod( 'paloma_autoscroll', 0 );
        $paloma_draggable = get_theme_mod( 'paloma_draggable', 0);
        $paloma_slider_arrows = get_theme_mod( 'paloma_slider_arrows', 0);

        //Set variable for draggable
        if ($paloma_draggable == 1) {
            $paloma_is_draggable = 'false';
        } else {
            $paloma_is_draggable = 'true';
        }

        //Set variable for arrow toggle
        if ($paloma_slider_arrows == 1) {
            $paloma_has_arrows = 'false';
        } else {
            $paloma_has_arrows = 'true';
        }

        //Localize the script
        wp_localize_script( 'main', 'palomaSlider', array('delay' => $paloma_autoscroll_delay, 'draggable' => $paloma_is_draggable, 'arrows' => $paloma_has_arrows) );
    }

//Register slider display
add_action( 'stnsvn_pre_content', 'stnsvn_display_slider', 10 );

function stnsvn_display_slider(){
	$slider_home = get_theme_mod( 'slider_home', 1 );
	if ($slider_home == 1 && is_home()) {
		get_template_part( 'template-parts/content', 'slider' );
	}
}

//Register call to action boxes 
add_action( 'stnsvn_pre_content', 'stnsvn_display_cta', 20 );

function stnsvn_display_cta(){
	$stnsvn_cta_display = get_theme_mod('stnsvn_cta_display', 0); 
	if (is_home() && ($stnsvn_cta_display == 1)) {
		get_template_part( 'template-parts/content', 'cta-boxes' );
	}
}

/**
* Customize excerpt read mores
*/
// Changing excerpt more
   function paloma_excerpt_more($more) {
   global $post;
   return '';
   }
   add_filter('excerpt_more', 'paloma_excerpt_more');

// Changing excerpt more
   function paloma_custom_excerpt_more($more) {
   global $post;
   $paloma_readmore = get_theme_mod('paloma_readmore', 'Read More');
   $paloma_archive_readmore = get_theme_mod('paloma_archive_readmore', 'Read More');
	if ($paloma_readmore && is_home()) {
	   return $more . '<h4 class="read-more"><a href="'. get_permalink($post->ID) . '">' . $paloma_readmore . '</a></h4>' . paloma_accent_small();

	} elseif ($paloma_archive_readmore && is_archive()) {
	   return $more . '<h4 class="read-more"><a href="'. get_permalink($post->ID) . '">' . $paloma_archive_readmore . '</a></h4>' . paloma_accent_small();

	} else {
   		return $more;
   	}
}
add_filter('the_excerpt', 'paloma_custom_excerpt_more');

/**
* Customize the Read More quicktag
*/
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
	global $post;
	$paloma_readmore = get_theme_mod('paloma_readmore', 'Read More');
	$paloma_archive_readmore = get_theme_mod('paloma_archive_readmore', 'Read More');
	
	if ($paloma_readmore && is_home()) {
   		return '<h4 class="read-more"><a href="'. get_permalink($post->ID) . '">' . $paloma_readmore . '</a></h4>' . paloma_accent_small();
   	} elseif ($paloma_archive_readmore && is_archive()) {
	   	return '<h4 class="read-more"><a href="'. get_permalink($post->ID) . '">' . $paloma_archive_readmore . '</a></h4>' . paloma_accent_small();
	} else {
   		return;
   	}
}

/* Display small accent*/
function paloma_accent_small(){
	$display_accent = get_theme_mod('display_read_more_accent', 1);
	if ($display_accent == 1) {
		return '<div class="paloma-accent accent-small">
					<svg xmlns="http://www.w3.org/2000/svg" width="41.4" height="9.5" viewBox="0 0 41.4 9.5">
					  <path d="M40.7 8.1L34 1.4l-6.6 6.7-6.7-6.7L14 8.1 7.4 1.4.7 8.1" class="st0"/>
					</svg>
				</div>';
			}
}

/**
* Customize # of posts in archives
*/
function stnsvn_archive_posts($query){
	$paloma_archive_number_posts = get_theme_mod('paloma_archive_number_posts', '9');
    if ($paloma_archive_number_posts && $query->is_archive && $query->is_main_query() && !(class_exists( 'WooCommerce' ) && is_woocommerce() )) {
            $query->set('posts_per_page', $paloma_archive_number_posts);
   }
    return $query;
}
 add_filter('pre_get_posts', 'stnsvn_archive_posts', 20);

/**
* Customize Jetpack "Older Posts"
*/
function paloma_filter_jetpack_is( $settings ) {
	$settings['text'] = __( 'Load More', 'paloma' );
	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'paloma_filter_jetpack_is' );

/**
* Control Sidebar Layouts
*/

//Single Posts and Portfolio Pages
	//Add sidebar class to body
		add_filter( 'body_class', 'paloma_post_sidebar_classes' ); //Add class to body
	    function paloma_post_sidebar_classes( $classes ) {
	    	$paloma_single_layout = get_theme_mod( 'paloma_display_style', 'sidebar');
	    	$paloma_portfolio_layout = get_theme_mod( 'paloma_portfolio_display_style', 'full_width');
				if ( ($paloma_single_layout == 'sidebar' && is_singular('post') ) || ($paloma_portfolio_layout == 'sidebar' && is_singular('jetpack-portfolio') ) ) {
		     	   $classes[] = 'sidebar-layout';
		    	}
		    	return $classes;
			} 

	//Render Sidebar
		add_action('single_sidebar', 'do_single_sidebar');
		function do_single_sidebar() {
			$paloma_single_layout = get_theme_mod( 'paloma_display_style', 'sidebar');
			$paloma_portfolio_layout = get_theme_mod( 'paloma_portfolio_display_style', 'full_width');
			if ( ($paloma_single_layout == 'sidebar' && is_singular('post') ) || ($paloma_portfolio_layout == 'sidebar' && is_singular('jetpack-portfolio') ) ) {
					get_sidebar();
				} 
			}

//Single Pages
	//Add sidebar class to page
		add_filter( 'body_class', 'paloma_page_sidebar_classes' ); //Add class to body
	    function paloma_page_sidebar_classes( $classes ) {
	    	$paloma_page_layout = get_theme_mod( 'paloma_page_display_style', 'full_width');
				if ( $paloma_page_layout == 'sidebar' && is_singular('page') && !is_page_template('page-builder.php') && !(class_exists( 'WooCommerce' ) && (is_checkout() || is_cart() ) )) {
		     	   $classes[] = 'sidebar-layout';
		    	}
		    	return $classes;
			} 

	//Render sidebar
		add_action('page_sidebar', 'do_page_sidebar');
		function do_page_sidebar() {
			 $paloma_page_layout = get_theme_mod( 'paloma_page_display_style', 'full_width');
			 $paloma_wc_layout = get_theme_mod( 'paloma_woocommerce_style', 'full_width');
			if ( $paloma_page_layout == 'sidebar' && !(class_exists( 'WooCommerce' ) && (is_checkout() || is_cart() ) )) {
				get_sidebar(); //Do sidebar if sidebar enabled
			} elseif ( 
				$paloma_wc_layout == 'sidebar' && (class_exists( 'WooCommerce' ) && (is_checkout() || is_cart()))) {
				get_sidebar(); //Do WooCommerce sidebar if sidebar enabled
			}
		}

//Archive Pages
//Add sidebar class to body
		add_filter( 'body_class', 'paloma_archive_sidebar_classes' ); //Add class to body
	    function paloma_archive_sidebar_classes( $classes ) {
	    	$paloma_page_layout = get_theme_mod( 'paloma_archive_display_style', 'full_width');
				if ( $paloma_page_layout == 'sidebar' && is_archive() && !(class_exists( 'WooCommerce' ) && is_woocommerce()) ) {
		     	   $classes[] = 'sidebar-layout';
		    	}
		    	return $classes;
				} 

	//Render sidebar
	add_action('archive_sidebar', 'do_archive_sidebar');
	function do_archive_sidebar() {
		$paloma_page_layout = get_theme_mod( 'paloma_archive_display_style', 'full_width');
			if ( $paloma_page_layout == 'sidebar') {
					get_sidebar(); //Do sidebar if sidebar enabled
				}
			}


//Blog Page
	//Add sidebar class to body
	add_filter( 'body_class', 'paloma_blog_sidebar_classes' ); //Add class to body
    function paloma_blog_sidebar_classes( $classes ) {
    	$paloma_page_layout = get_theme_mod( 'paloma_blog_display_style', 'sidebar');
			if ( $paloma_page_layout == 'sidebar' && (is_home() || is_search())) {
	     	   $classes[] = 'sidebar-layout';
            }
	    	return $classes;
		} 

	//Render sidebar
	add_action('blog_sidebar', 'do_blog_sidebar');
	function do_blog_sidebar() {
		$paloma_blog_layout = get_theme_mod( 'paloma_blog_display_style', 'sidebar');
		if ( $paloma_blog_layout == 'sidebar') {
				get_sidebar();
			} 
	}

/*
* Control post layouts for blog archive.php and index.php
*/

//Select layout type for archive.php and display posts
add_action('paloma_archive_layout', 'paloma_archive_do_posts');
function paloma_archive_do_posts() {
		//Grab different content parts depending on layout selection 
		$paloma_archive_style = get_theme_mod('paloma_archive_layout', 'grid');
		if ($paloma_archive_style == 'grid'){
			get_template_part( 'template-parts/content', 'blocks' );
		} elseif ($paloma_archive_style == 'standard') {
			get_template_part( 'template-parts/content', 'posts' );
		} else {
			get_template_part( 'template-parts/content' );
		}
	}

//Select layout type for index.php and display posts
add_action('paloma_index_layout', 'paloma_index_do_posts');
function paloma_index_do_posts() {
		global $wp_query;

		$paloma_blog_style = get_theme_mod('paloma_blog_layout', 'grid_featured'); 
		if ($paloma_blog_style == 'grid_featured') {
			while ( have_posts() ) : the_post();
				/*Display featured post if enabled*/
				if ( is_home() && $wp_query->current_post == 0 && !is_paged() ) {
					get_template_part( 'template-parts/content', 'featured-post' );

					//set unordered list to support grid layout
					echo '<ul class="clear grid-container">';
				} 
				/*Then display standard grid posts*/
				else {
					get_template_part( 'template-parts/content', 'blocks' );
				}

			endwhile;
			//end unordered list
			echo '</ul>';
		}

		elseif ($paloma_blog_style == 'featured') {
			while ( have_posts() ) : the_post();
				/*Display featured post if enabled*/
				if ( is_home() && $wp_query->current_post == 0 && !is_paged() ) {
					get_template_part( 'template-parts/content', 'featured-post' );
				} 
				/*Then display standard grid posts*/
				else {
					get_template_part( 'template-parts/content' );
				}

			endwhile;
		}

		elseif ($paloma_blog_style == ('grid')){
			echo '<ul class="clear grid-container">';
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'blocks' );
				endwhile;
			echo '</ul>';
		} 
		elseif ($paloma_blog_style == 'standard'){
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'posts' );
			endwhile;
		} 
		else {
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
		}
}

/**
* Add author box to single posts
*/

add_action('paloma_after_entry', 'paloma_author_box', 1);
function paloma_author_box() {
	$display_author_box = get_theme_mod('display_author_box', 1);
	if ($display_author_box == 1) {
		get_template_part( 'template-parts/content', 'author' );
	}
}

/**
* Control Placeholder Text
*/
//Edit comment form placeholder text
add_filter( 'comment_form_default_fields', 'stnsvn_comment_placeholders' );
function stnsvn_comment_placeholders( $fields )
{
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'
            . _x(
                'Name',
                'comment form placeholder',
                'paloma'
                )
            . '"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input id="email" name="email" type="email"',
        '<input type="email" placeholder="'.__('Email', 'paloma').'"  id="email" name="email"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input id="url" name="url" type="url"',
        '<input placeholder="'.__('Url', 'paloma').'" id="url" name="url" type="url"',
        $fields['url']
    );
    return $fields;
}

//* Modify comments title text in comments
add_filter( 'comment_form_defaults', 'stnsvn_comment_form_defaults' );
function stnsvn_comment_form_defaults( $defaults ) {
 
    $defaults['title_reply'] = __( 'Leave a Comment', 'paloma' );
    return $defaults;
}

//*Modify excerpt length
function paloma_excerpt_length( $length ) {
	$paloma_excerpt = get_theme_mod('paloma_excerpt_length', '35');
	$paloma_archive_excerpt = get_theme_mod('paloma_archive_excerpt_length', '35');
	if (is_archive()){
		return $paloma_archive_excerpt;
	} else {
		return $paloma_excerpt;
	}
}

add_filter( 'excerpt_length', 'paloma_excerpt_length' );

/**
 * Enables Jetpack's Infinite Scroll in search pages, disables it in product archives
 * @return bool
 */
function paloma_jetpack_infinite_scroll_supported() {
	return current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() ) && ! is_post_type_archive( 'product' ) && !is_search();
}
add_filter( 'infinite_scroll_archive_supported', 'paloma_jetpack_infinite_scroll_supported' );

/**
* Configure ACF Pro
*/

    // 1. customize ACF path
    add_filter('acf/settings/path', 'paloma_acf_settings_path');
     
    function paloma_acf_settings_path( $path ) {
     
        // update path
        $path = get_template_directory() . '/inc/plugins/advanced-custom-fields-pro/';
        
        // return
        return $path;
        
    }
     
    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'paloma_acf_settings_dir');
     
    function paloma_acf_settings_dir( $dir ) {
     
        // update path
        $dir = get_template_directory_uri() . '/inc/plugins/advanced-custom-fields-pro/';
        
        // return
        return $dir;
        
    }
     
    // 3. Hide ACF field group menu item
    $paloma_acf_pro = get_theme_mod('paloma_acf_pro', 0);
    if ($paloma_acf_pro != 1) {
        add_filter('acf/settings/show_admin', '__return_false');
    }
    
    // 4. Include ACF
    include_once( get_template_directory() . '/inc/plugins/advanced-custom-fields-pro/acf.php' );
    
    // 5. Load ACF fields on init action to support translatable strings
    add_action('init', 'load_exported_fields');
    function load_exported_fields(){
        require_once('inc/plugins/paloma-acf-pro-settings.php');
    }

    // 6. Load ACF admin CSS when on pages with ACF fields (page/post editor)
    add_action('acf/input/admin_head', 'paloma_acf_admin_head');

    function paloma_acf_admin_head() {
    	?>
    	<style type="text/css">
    		.acf-flexible-content .layout {
			    border: 2px solid;
			}
    	</style>
    	<?php
	}

/**
*Include shortcodes and Stnsvn widgets
*/
require_once('inc/shortcodes.php');
require_once('inc/stnsvn-social-widget.php');
require_once('inc/stnsvn-about-widget.php');
require_once('inc/stnsvn-popular-posts-widget.php');

/**
* Initialize Update Checker
*/
require ('inc/plugins/automatic-theme-updates/theme-updates/theme-update-checker.php');
$paloma_update_checker = new ThemeUpdateChecker(
    'paloma',
    'http://updates.stnsvn.com/paloma/paloma-theme-updates.json'
);

/**
* Enable back to top
*/

	//Add anchor to head
	add_action ('wp_head', 'stnsvn_btt_anchor');
	function stnsvn_btt_anchor(){ 
		//If disabled in customizer, no output
		$stnsvn_btt_display = get_theme_mod('stnsvn_btt_display', 0);
		if ($stnsvn_btt_display != 1) { ?>
			<span id="top"></span><!-- Back to top anchor -->
		<?php }
	 } 

	//Add btt button to footer
	add_action('stnsvn_before_prefooter', 'stnsvn_button_settings');
	function stnsvn_button_settings(){
		$stnsvn_btt_display = get_theme_mod('stnsvn_btt_display', 0);
		$stnsvn_btt_sticky = get_theme_mod('stnsvn_btt_sticky', 0);
		$stnsvn_btt_upload = get_theme_mod('stnsvn_btt_upload', '');

			if ($stnsvn_btt_display != 1) { ?>
					<a href="#top" class="stnsvn-btt<?php if ($stnsvn_btt_sticky !=1) {echo ' stick';}?>">

						<?php //display uploaded btt button (if present), otherwise display btt text
						if ($stnsvn_btt_upload !='') {
							echo '<img alt="back to top" src="' , $stnsvn_btt_upload , '">';
						} else { ?>
							<div class="btt-container">
								<svg xmlns="http://www.w3.org/2000/svg" width="19.4" height="19.5" viewBox="0 0 19.4 19.5">
								  <path d="M18.7 10.4l-9-9-9 9m9-8.2v17.3" class="st0"/>
								</svg>
							</div>
						<?php } ?>

					</a><!--Back to top button -->
				<?php }
	 }

// Display full width featured images on single pages
    add_action('stnsvn_pre_content', 'paloma_page_featured', 10);

    function paloma_page_featured() {
    $paloma_page_featured = get_theme_mod('paloma_page_featured', 1);

    if (is_page() && ($paloma_page_featured == 1)) {
            if (has_post_thumbnail()) {  // If has post thumbnail, display it
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
                $thumb_url = $thumb_url_array[0];
                ?>
                            <div class="page-featured-img" style="background: url('<?php echo $thumb_url; ?>'); background-position: 50%; background-size: cover;"></div>
        <?php }
        }
}

//* Modify post navigation
function paloma_custom_nav(){
	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous">%link</div>', __('Previous Post', 'paloma') );
	$next       = get_next_post_link( '<div class="nav-next">%link</div>', __('Next Post', 'paloma') );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $previous . $next, 'post-navigation' );
	}

	echo $navigation;
}

add_action('paloma_after_entry', 'paloma_custom_nav', 15);



