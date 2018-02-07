<?php
/**
 * Archive Template 
 *
 * Displays an Archive index of post-type items. Other more specific archive templates 
 * may override the display of this template for example the category.php.
 *
 * @package Thematic
 * @subpackage Templates
 *
 * @link http://codex.wordpress.org/Template_Hierarchy Codex: Template Hierarchy
 */

	// calling the header.php
	get_header();

	// action hook for placing content above #container
	thematic_abovecontainer();
?>

		<div id="container">

		<?php 
			// action hook for placing content above #content
			thematic_abovecontent();

			// filter for manipulating the element that wraps the content 
			echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" ); 

			// displays the page title
			// thematic_page_title();


if(isset($wp_taxonomies)) {
	// This is getting the friendly version of a taxonomy
	// - not the hyphenated get_yoast_term_title()

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	if($term) {
		echo '<h1 class="entry-title">'.$term->name.'</h1>';
	}
?>
<div class="banner">
<?php print apply_filters( 'taxonomy-images-queried-term-image', '', array(
    'image_size' => 'bannerimage'
    ) ); 
?>
</div>

<?php
	// If you have a taxonomy description, let'er rip!
	if(function_exists('get_yoast_term_description') && get_yoast_term_description()) {
		echo wptexturize(get_yoast_term_description());
	}
}

echo category_description();

			// create the navigation above the content
			thematic_navigation_above();

thematic_abovepost();

        	// action hook for placing content above the archive loop
        	thematic_above_archiveloop();
?>

<div class="prices">
<?php
			// action hook creating the archive loop
			thematic_archiveloop();
?>
</div>
<?php
        	// action hook for placing content below the archive loop
        	thematic_below_archiveloop();

			// create the navigation below the content
			thematic_navigation_below();
		?>

		    </div><!-- #content -->

			<?php 
				// action hook for placing content below #content
		    	thematic_belowcontent(); 
		    ?> 

		</div><!-- #container -->

<?php 
	// action hook for placing content below #container
	thematic_belowcontainer();

	// calling the standard sidebar 
	thematic_sidebar();

	// calling footer.php
	get_footer();
?>