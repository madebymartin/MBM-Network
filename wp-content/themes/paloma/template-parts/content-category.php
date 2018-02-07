<?php
/**
 * Template part for displaying the selected category above post titles
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

	if (get_field('displayed_category')){ //Display desired category, if one is selected
		$category = get_field('displayed_category');
		$category_link = get_category_link( $category );
		$category_name = get_cat_name( $category );
		echo '<h4 class="entry-meta"><a href="' , esc_url( $category_link ) , '">' , $category_name , '</a></h4>';

	} elseif (has_category()){ //else, display first category (alphabetical)
        $category = get_the_category();
        $category_link = get_category_link( $category[0] );
        echo '<h4 class="entry-meta"><a href="' , esc_url( $category_link ) , '">' , $category[0]->cat_name , '</a></h4>';
    }