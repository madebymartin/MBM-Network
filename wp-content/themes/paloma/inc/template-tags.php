<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package paloma
 */

if ( ! function_exists( 'paloma_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function paloma_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$display_date = get_theme_mod('display_date', '1');
	if ($display_date == '1') { 
		echo '<span class="posted-on">' , 
			$posted_on ,
			'<span>';
	} 

}
endif;

if ( ! function_exists( 'paloma_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function paloma_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'paloma' ) );
		$display_tags = get_theme_mod('display_tags', '1');
		if ( $tags_list && ($display_tags == '1') ) {
			printf( '<div class="tags-links">' . esc_html__( 'Tagged %1$s', 'paloma' ) . ' </div>', $tags_list ); // WPCS: XSS OK.
		}
	}

	/*Remove post edit link
	edit_post_link(
		sprintf(
			esc_html__( 'Edit %s', 'paloma' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);*/
}
endif;

if ( ! function_exists( 'paloma_entry_author' ) ) :
/**
 * Prints HTML with meta information for author byline
 */
function paloma_entry_author() {
	/* Display byline in footer */
	$byline = sprintf(
	esc_html_x( 'by %s', 'post author', 'paloma' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . ' </a></span>'
	);

	//Add conditional control from cutsomizer
	$display_byline = get_theme_mod('display_byline', '0');
	$display_byline_featured = get_theme_mod('display_byline_featured', '1');
	$display_date = get_theme_mod('display_date', '1');
	if (is_single() && ($display_byline == '1') && ($display_date == '1')) {
	echo ' | <span class="byline">' , 
		 $byline ,
		 '</span>'; 
	} elseif (is_single() && $display_byline == '1') {
	echo '<span class="byline">' , 
		 $byline ,
		 '</span>'; 
	}
	elseif (is_home() && $display_byline_featured == '1') {
	echo '<span class="byline">' , 
		 $byline ,
		 '</span>'; 
	}
}
endif;

if ( ! function_exists( 'paloma_post_cats' ) ) :
/**
 * Prints HTML with meta information for the categories, above the post title.
 */
function paloma_post_cats() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'paloma' ) );
		if ( $categories_list && paloma_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'paloma' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function paloma_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'paloma_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'paloma_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so paloma_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so paloma_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in paloma_categorized_blog.
 */
function paloma_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'paloma_categories' );
}
add_action( 'edit_category', 'paloma_category_transient_flusher' );
add_action( 'save_post',     'paloma_category_transient_flusher' );
