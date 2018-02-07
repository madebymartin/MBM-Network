<?php
/**
 * Kyla Williams functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kyla Williams
 */


// SHOP FRONT SHOWS ALL DATES IN ORDER, ALONG WITH DETAILS FOR EACH PRODUCT/EVENT/WORKSHOP/COURSE ETC..
// USER CAN FILTER LIST BY EVENT TYPE (PRODUCT CATEGORY), TRAINER, LOCATION ETC
if ( ! function_exists( 'mbm_get_all_bookable_dates' ) ){
	function mbm_get_all_bookable_dates($trainer_id, $location_id){

		//trainer ids array for meta query
		$trainer_ids_array = new WP_Query( array (
		    'orderby'               => 'date',
		    'posts_per_page'        => -1,
		    'fields' => 'ids',
		    'post_type' => 'trainer'
		));
		$trainer_ids_array = $trainer_ids_array->posts;
		if(empty($trainer_id)){$trainer_ids = $trainer_ids_array; }
		else{ $trainer_ids = $trainer_id; }



		//location ids array for meta query
		$location_ids_array = new WP_Query( array (
		    'orderby'               => 'title',
		    'posts_per_page'        => -1,
		    'fields' => 'ids',
		    'post_type' => 'location'
		));
		$location_ids_array = $location_ids_array->posts;
		if(empty($location_id)){$location_ids = $location_ids_array; }
		else{ $location_ids = $location_id; }


		$bookable_dates_array = array();

		$bookable_products_loop = new wp_query( array(
				'post_type' => 'product',
/*				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => 'samples',
						'operator' => 'NOT IN'
					),

				),*/
				'meta_query' => array(
                'relation' => 'AND',
                    array(
                        'key'     => '_wc_booking_availability',
                        'value'   => '',
                        'compare' => '!=',
                    ),
                    array(
                        'key'     => 'mbm_trainer',
                        'value'   => $trainer_ids,
                        'compare' => 'IN',
                    ),
                    array(
                        'key'     => 'mbm_location',
                        'value'   => $location_ids,
                        'compare' => 'IN',
                    ),
                ),

				'orderby' => 'title',
				'posts_per_page' => '-1',
				'order' => 'ASC'
		) );

		
		if ( $bookable_products_loop->have_posts() ) {
			while ( $bookable_products_loop->have_posts() ) : $bookable_products_loop->the_post();

				$product_id = get_the_ID();

				$availability = get_post_meta(get_the_ID())["_wc_booking_availability"];
				$availability_array = unserialize($availability['0']);


				foreach ($availability_array as $key => $value) {
					$date = $value['from'];
					$unix_ts = strtotime($date);
					$day = date( "jS", $unix_ts );
					$month = date( "M", $unix_ts );
					$year = date( "Y", $unix_ts );
					$bookable = $value['bookable'];

					$end_date = $value['to'];
					$end_timestamp = strtotime($end_date);
					$now = time();

					if ($bookable == 'yes' && $now < $end_timestamp) {
						$bookable_dates_array[] = array('timestamp' => $unix_ts, 'product_id' => $product_id);
					}
					
				}



			endwhile;
			// Prevent weirdness
			wp_reset_postdata();
		}
		sort($bookable_dates_array);
		return $bookable_dates_array;
	}
}







// add_filter('gettext', 'translate_text');
// add_filter('ngettext', 'translate_text');

function translate_text($translated) { 
$translated = str_ireplace('product', 'event', $translated); 
$translated = str_ireplace('category', 'type', $translated); 
return $translated; 
}







/*if ( ! function_exists( 'mbm_woocommerce_taxonomy_archive_description' ) ) {
	function mbm_woocommerce_taxonomy_archive_description() {
		if ( is_tax( array( 'product_cat', 'product_tag' ) ) && 0 === absint( get_query_var( 'paged' ) ) ) {
			$description = term_description();
			if ( $description ) {
				echo '<div class="term-description">' . $description . '</div>';
			}
		}
	}
}
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
// remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_before_shop_loop', 'mbm_woocommerce_taxonomy_archive_description', 10 );
*/
















// add_action( 'init', 'wpm_product_cat_register_meta' );
/**
 * Register details product_cat meta.
 *
 * Register the details metabox for WooCommerce product categories.
 *
 */
function wpm_product_cat_register_meta() {

	register_meta( 'term', 'details', 'wpm_sanitize_details' );

}

/**
 * Sanitize the details custom meta field.
 *
 * @param  string $details The existing details field.
 * @return string          The sanitized details field
 */
function wpm_sanitize_details( $details ) {

	return wp_kses_post( $details );

}


// add_action( 'product_cat_add_form_fields', 'wpm_product_cat_add_details_meta' );
/**
 * Add a details metabox to the Add New Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * creating new product categories in WooCommerce.
 *
 */
function wpm_product_cat_add_details_meta() {

	wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' );

	?>
	<div class="form-field">
		<label for="wpm-product-cat-details"><?php esc_html_e( 'Details', 'wpm' ); ?></label>
		<textarea name="wpm-product-cat-details" id="wpm-product-cat-details" rows="5" cols="40"></textarea>
		<p class="description"><?php esc_html_e( 'Detailed category info to appear below the product list', 'wpm' ); ?></p>
	</div>
	<?php

}




// add_action( 'product_cat_edit_form_fields', 'wpm_product_cat_edit_details_meta' );
/**
 * Add a details metabox to the Edit Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * editing an existing product category in WooCommerce.
 *
 * @param  object $term The existing term object.
 */
function wpm_product_cat_edit_details_meta( $term ) {

	$product_cat_details = get_term_meta( $term->term_id, 'details', true );

	if ( ! $product_cat_details ) {
		$product_cat_details = '';
	}

	$settings = array( 'textarea_name' => 'wpm-product-cat-details' );
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="wpm-product-cat-details"><?php esc_html_e( 'Details', 'wpm' ); ?></label></th>
		<td>
			<?php wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' ); ?>
			<?php wp_editor( wpm_sanitize_details( $product_cat_details ), 'product_cat_details', $settings ); ?>
			<p class="description"><?php esc_html_e( 'Detailed category info to appear below the product list','wpm' ); ?></p>
		</td>
	</tr>
	<?php

}





// add_action( 'create_product_cat', 'wpm_product_cat_details_meta_save' );
// add_action( 'edit_product_cat', 'wpm_product_cat_details_meta_save' );
/**
 * Save Product Category details meta.
 *
 * Save the product_cat details meta POSTed from the
 * edit product_cat page or the add product_cat page.
 *
 * @param  int $term_id The term ID of the term to update.
 */
function wpm_product_cat_details_meta_save( $term_id ) {

	if ( ! isset( $_POST['wpm_product_cat_details_nonce'] ) || ! wp_verify_nonce( $_POST['wpm_product_cat_details_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	$old_details = get_term_meta( $term_id, 'details', true );
	$new_details = isset( $_POST['wpm-product-cat-details'] ) ? $_POST['wpm-product-cat-details'] : '';

	if ( $old_details && '' === $new_details ) {
		delete_term_meta( $term_id, 'details' );
	} else if ( $old_details !== $new_details ) {
		update_term_meta(
			$term_id,
			'details',
			wpm_sanitize_details( $new_details )
		);
	}
}





//add_action( 'woocommerce_before_shop_loop', 'wpm_product_cat_display_details_meta' );
/**
 * Display details meta on Product Category archives.
 *
 */
function wpm_product_cat_display_details_meta() {

	if ( ! is_tax( 'product_cat' ) ) {
		return;
	}

	$t_id = get_queried_object()->term_id;
	$details = get_term_meta( $t_id, 'details', true );

	if ( '' !== $details ) {
		?>
		<div class="product-cat-details">
			<?php echo apply_filters( 'the_content', wp_kses_post( $details ) ); ?>
		</div>
		<?php
	}

}







foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}




























require_once get_template_directory() . '/inc/meta.php';
require_once get_template_directory() . '/inc/calendar.php';