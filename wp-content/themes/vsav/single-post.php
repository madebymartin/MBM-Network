<?php
/**
 * Single Post Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */

	if( get_option( 'show_on_front' ) == 'page' ) $location = get_permalink( get_option('page_for_posts' ) );
	else $location = bloginfo('url');

	wp_redirect( $location );
	exit;


?>