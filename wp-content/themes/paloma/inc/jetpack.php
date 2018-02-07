<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package paloma
 */

/**
 * Add theme support for Infinite Scroll.
 */


function paloma_jetpack_setup() {
//Register Infinite Scroll
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'paloma_infinite_scroll_render',
		'footer'    => 'false',
		'footer_widgets' => 'true',
	) );
    add_theme_support( 'jetpack-portfolio' );
    add_theme_support( 'related-posts' );
} // end function paloma_jetpack_setup
add_action( 'after_setup_theme', 'paloma_jetpack_setup' );


/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'paloma_infinite_scroll_render' ) ) { 
    function paloma_infinite_scroll_render() {
    /**
    *Choose render style based on customizer settings
    */

            //Set vars
            $paloma_archive_layout = get_theme_mod('paloma_archive_layout', 'grid');
            $paloma_blog_layout = get_theme_mod('paloma_blog_layout', 'grid_featured');

            //For grid layouts
            if ((is_archive() && $paloma_archive_layout == 'grid') || (is_home() && $paloma_blog_layout == 'grid_featured') || (is_home() && $paloma_blog_layout == 'grid') ){
                    echo '<div class="infinite-posts clear">';
                        while ( have_posts() ) {
                        the_post();
                            get_template_part( 'template-parts/content', 'blocks' );
                        }
                echo'</div>';
            }

            //Or do standard posts
            elseif ((is_archive() && $paloma_archive_layout == 'standard') || (is_home() && ($paloma_blog_layout == 'standard'))) {
            	    while ( have_posts() ) {
                    the_post();
                    	get_template_part( 'template-parts/content', 'posts' );
                    }
            } 

            //Otherwise, do rows
            else {
                    while ( have_posts() ) {
                    the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    }  
            }
        }
}//End conditional for paloma_infinite_scroll_render()

//Fix Infinite Scroll Load More button from showing when no more posts
add_filter('infinite_scroll_results', function($results, $query_args, $wp_query) {
     if ($wp_query->get('paged') == $wp_query->max_num_pages) {
         $results['lastbatch'] = true;
     }
     return $results;
 }, 10, 3);

//* Configure JP Related Posts
//* Check for JP Related Posts before running
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'related-posts' ) ) {

    // Change thumbnail size
    function stnsvn_jetpackchange_image_size ( $thumbnail_size ) {
        $thumbnail_size['width'] = 750;
        $thumbnail_size['height'] = 520;
        $thumbnail_size['crop'] = true;
        return $thumbnail_size;
    }
    add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'stnsvn_jetpackchange_image_size' );

        //* Unhook standard instance of RP
    function stnsvn_remove_rp() {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
    add_filter( 'wp', 'stnsvn_remove_rp', 20 );

    //* Include RP related posts in new spot
    add_action( 'paloma_after_entry', 'stnsvn_related_posts', 10 );

    function stnsvn_related_posts() { 
                if ( ! is_singular( 'post' ) )  return; 
                            echo    '<div class="stnsvn-rp-container">' , 
                                        do_shortcode( '[jetpack-related-posts]' ) , 
                                    '</div>';
    };

    // Change number of posts
    function stnsvn_more_related_posts( $options ) {
        $options['size'] = 2;
        return $options;
    }
    add_filter( 'jetpack_relatedposts_filter_options', 'stnsvn_more_related_posts' );

} //End Related Posts
