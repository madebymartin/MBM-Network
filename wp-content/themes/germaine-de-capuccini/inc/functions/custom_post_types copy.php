<?php
/* Add Custom Post Types */
add_action( 'init', 'create_post_type' );

function create_post_type() {
	/* Add Spa Treatments Post Type */
    register_post_type( 'treatments',
        array(
            'labels' => array(
                'name' => __( 'Spa Treatments' ),
                'singular_name' => __( 'Spa Treatment' ),
                'add_new' => __( 'Add Spa Treatment' ),
                'add_new_item' => __( 'Add Spa Treatment' ),
                'edit' => __( 'Edit Treatment' ),
                'edit_item' => __( 'Edit Treatment' ),
                'new_item' => __( 'Add New Spa Treatment' ),
                'view' => __( 'View This Treatment' ),
                'view_item' => __( 'View This Treatment' ),
                'search_items' => __( 'Search Spa Treatments' ),
                'not_found' => __( 'No Treatment Found' ),
                'not_found_in_trash' => __( 'No Treatment found in Trash' ),
            ),
            'description' => __('Spa Treatments'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "treatments"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-clock',
            'supports' => array(
            	'title', 'editor', 'thumbnail', 'excerpt'),
            'menu_position' => '9',
            'can_export' => true,
			'taxonomies' => array('treatment_category', 'excerpt') // this is IMPORTANT
        )
    );
add_filter( 'manage_edit-treatments_columns', 'my_edit_treatments_columns' ) ;

function my_edit_treatments_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'treatments' ),
		'treatment_category' => __( 'treatment_category' ),
		'date' => __( 'Date' )
	);
	return $columns;
}



add_action( 'manage_treatments_posts_custom_column', 'my_manage_treatments_columns', 10, 2 );

function my_manage_treatments_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		/* If displaying the 'treatment_category' column. */
		case 'treatment_category' :
			/* Get the treatment_categorys for the post. */
			$terms = get_the_terms( $post_id, 'treatment_category' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'treatment_category' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'treatment_category', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Category Selected' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

/* Add Trade Downloads Post Type */
/*    register_post_type( 'downloads',
        array(
            'labels' => array(
                'name' => __( 'Trade Support' ),
                'singular_name' => __( 'Trade Support' ),
                'add_new' => __( 'Add Trade Support' ),
                'add_new_item' => __( 'Add Trade Support' ),
                'edit' => __( 'Edit Support' ),
                'edit_item' => __( 'Edit Support' ),
                'new_item' => __( 'Add New Trade Support' ),
                'view' => __( 'View This Trade Support' ),
                'view_item' => __( 'View This Trade Support' ),
                'search_items' => __( 'Search Trade Support' ),
                'not_found' => __( 'No Trade Support Found' ),
                'not_found_in_trash' => __( 'No Trade Support found in Trash' ),
            ),
            'description' => __('Trade Support'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "downloads"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => array(
            	'title', 'editor', 'thumbnail', 'excerpt'),
            'menu_position' => '5',
            'can_export' => true,
			'taxonomies' => array('download_categories')
        )
    );*/

/* Add PR Article Post Type */
    register_post_type( 'pressarticle',
        array(
            'labels' => array(
                'name' => __( 'Press Articles' ),
                'singular_name' => __( 'Press Article' ),
                'add_new' => __( 'Add Press Article' ),
                'add_new_item' => __( 'Add Press Article' ),
                'edit' => __( 'Edit Press Article' ),
                'edit_item' => __( 'Edit Press Article' ),
                'new_item' => __( 'Add New Press Article' ),
                'view' => __( 'View This Press Article' ),
                'view_item' => __( 'View This Press Article' ),
                'search_items' => __( 'Search Press Articles' ),
                'not_found' => __( 'No Press Articles Found' ),
                'not_found_in_trash' => __( 'No Press Articles found in Trash' ),
            ),
            'description' => __('Press Articles'),
            'public' => true,
            'show_ui' => true, // UI in admin panel
            'capability_type' => 'post',
			'hierarchical' => true,
			'rewrite' => array("slug" => "press"), // Permalinks format
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-id-alt',
            'supports' => array(
            	'title', 'thumbnail','editor', 'excerpt'),
            'menu_position' => '9',
            'can_export' => true,
			'taxonomies' => array('') // this is IMPORTANT
        )
    );
}



//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_product_range_tax', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_product_range_tax()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Product Ranges', 'taxonomy general name' ),
    'singular_name' => __( 'Product Range', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product Ranges' ),
    'all_items' => __( 'All Product Ranges' ),
    'parent_item' => __( 'Parent Product Range' ),
    'parent_item_colon' => __( 'Parent Product Range' ),
    'edit_item' => __( 'Edit Product Range' ),
    'update_item' => __( 'Update Product Range' ),
    'add_new_item' => __( 'Add New Product Range' ),
    'new_item_name' => __( 'New Product Range Name' ),
    'menu_name' => __( 'Product Ranges' ),
  );

  register_taxonomy('product_range',array('range', 'product', 'treatments'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'range' ),
  ));
register_taxonomy_for_object_type( 'product_range', 'product' );
register_taxonomy_for_object_type( 'product_range', 'treatments' );

}










//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_skin_concern_tax', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_skin_concern_tax()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Skin Concerns', 'taxonomy general name' ),
    'singular_name' => __( 'Skin Concern', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Skin Concerns' ),
    'all_items' => __( 'All Skin Concerns' ),
    'parent_item' => __( 'Parent Skin Concern' ),
    'parent_item_colon' => __( 'Parent Skin Concern' ),
    'edit_item' => __( 'Edit Skin Concern' ),
    'update_item' => __( 'Update Skin Concern' ),
    'add_new_item' => __( 'Add New Skin Concern' ),
    'new_item_name' => __( 'New Skin Concern Name' ),
    'menu_name' => __( 'Skin Concerns' ),
  );

  register_taxonomy('skin_concern',array( 'product', 'treatments' ), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'skin-concern' ),
  ));
register_taxonomy_for_object_type( 'skin_concern', 'product' );
register_taxonomy_for_object_type( 'skin_concern', 'treatments' );

}








//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_recommendation_type_tax', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_type_tax()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Product Type', 'taxonomy general name' ),
    'singular_name' => __( 'Product Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product Types' ),
    'all_items' => __( 'All Product Types' ),
    'parent_item' => __( 'Parent Product Type' ),
    'parent_item_colon' => __( 'Parent Product Type' ),
    'edit_item' => __( 'Edit Product Type' ),
    'update_item' => __( 'Update Product Type' ),
    'add_new_item' => __( 'Add New Product Type' ),
    'new_item_name' => __( 'New Product Type Name' ),
    'menu_name' => __( 'Product Type' ),
  );

  register_taxonomy('recommendation_type',array('recommended', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product_type' ),
  ));
register_taxonomy_for_object_type( 'recommended', 'product' );

}













// FEMALE SKINTYPE TAXONOMIES ------------------------------------------------------------------

//ACNE RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_acne', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_acne()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Auto Expert - Acne', 'taxonomy general name' ),
    'singular_name' => __( 'Acne Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'AE: Acne' ),
  );

  register_taxonomy('acne',array('acne', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'acne' ),
  ));
register_taxonomy_for_object_type( 'acne', 'product' );

}

//COMBINATION/OILY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_combination_oily', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_combination_oily()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Auto Expert - Combination/Oily', 'taxonomy general name' ),
    'singular_name' => __( 'Combination/Oily Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'AE: Combination/Oily' ),
  );

  register_taxonomy('combination_oily',array('combination_oily', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'combination_oily' ),
  ));
register_taxonomy_for_object_type( 'combination_oily', 'product' );

}


//DRY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_dry', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_dry()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Auto Expert - Dry', 'taxonomy general name' ),
    'singular_name' => __( 'Dry Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'AE: Dry' ),
  );

  register_taxonomy('dry',array('dry', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'dry' ),
  ));
register_taxonomy_for_object_type( 'dry', 'product' );

}


//NORMAL/COMBINATION RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_normal_combination', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_normal_combination()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Auto Expert - Normal/Comb', 'taxonomy general name' ),
    'singular_name' => __( 'Normal/Combination Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'AE: Normal/Comb' ),
  );

  register_taxonomy('normal_combination',array('normal_combination', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'normal_combination' ),
  ));
register_taxonomy_for_object_type( 'normal_combination', 'product' );

}

//NORMAL/DRY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_normal_dry', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_normal_dry()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Auto Expert - Normal/Dry', 'taxonomy general name' ),
    'singular_name' => __( 'Normal/Dry Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'AE: Normal/Dry' ),
  );

  register_taxonomy('normal_dry',array('normal_dry', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'normal_dry' ),
  ));
register_taxonomy_for_object_type( 'normal_dry', 'product' );

}

//OILY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_oily', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_oily()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Auto Expert - Oily', 'taxonomy general name' ),
    'singular_name' => __( 'Oily Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'AE: Oily' ),
  );

  register_taxonomy('oily',array('oily', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'oily' ),
  ));
register_taxonomy_for_object_type( 'oily', 'product' );

}






// MALE SKINTYPE TAXONOMIES ------------------------------------------------------------------

//ACNE RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_acne_male', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_acne_male()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'MALE A.E. - Acne', 'taxonomy general name' ),
    'singular_name' => __( 'MALE Acne Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'MALE AE: Acne' ),
  );

  register_taxonomy('male_acne',array('male_acne', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'male_acne' ),
  ));
register_taxonomy_for_object_type( 'male_acne', 'product' );

}

//COMBINATION/OILY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_combination_oily_male', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_combination_oily_male()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'MALE A.E. - Combination/Oily', 'taxonomy general name' ),
    'singular_name' => __( 'MALE Combination/Oily Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'MALE AE: Comb/Oily' ),
  );

  register_taxonomy('male_combination_oily',array('male_combination_oily', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'male_combination_oily' ),
  ));
register_taxonomy_for_object_type( 'male_combination_oily', 'product' );


}


//DRY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_dry_male', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_dry_male()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'MALE A.E. - Dry', 'taxonomy general name' ),
    'singular_name' => __( 'MALE Dry Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'MALE AE: Dry' ),
  );

  register_taxonomy('male_dry',array('male_dry', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'male_dry' ),
  ));
register_taxonomy_for_object_type( 'male_dry', 'product' );



}


//NORMAL/COMBINATION RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_normal_combination_male', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_normal_combination_male()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'MALE A.E. - Normal/Comb', 'taxonomy general name' ),
    'singular_name' => __( 'MALE Normal/Combination Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'MALE AE: Norm/Comb' ),
  );

  register_taxonomy('male_normal_combination',array('male_normal_combination', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'male_normal_combination' ),
  ));
register_taxonomy_for_object_type( 'male_normal_combination', 'product' );


}

//NORMAL/DRY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_normal_dry_male', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_normal_dry_male()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'MALE A.E. - Normal/Dry', 'taxonomy general name' ),
    'singular_name' => __( 'MALE Normal/Dry Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'MALE AE: Normal/Dry' ),
  );

  register_taxonomy('male_normal_dry',array('male_normal_dry', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'male_normal_dry' ),
  ));
register_taxonomy_for_object_type( 'male_normal_dry', 'product' );

}

//OILY RECOMMENDATIONS
add_action( 'init', 'create_recommendation_for_oily_male', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_recommendation_for_oily_male()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'MALE A.E. - Oily', 'taxonomy general name' ),
    'singular_name' => __( 'MALE Oily Recommendation', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search These Recommendations' ),
    'all_items' => __( 'All Recommendations' ),
    'parent_item' => __( 'Parent Recommendation' ),
    'parent_item_colon' => __( 'Parent Recommendation' ),
    'edit_item' => __( 'Edit Recommendation' ),
    'update_item' => __( 'Update Recommendation' ),
    'add_new_item' => __( 'Add New Recommendation' ),
    'new_item_name' => __( 'New Recommendation Name' ),
    'menu_name' => __( 'MALE AE: Oily' ),
  );

  register_taxonomy('male_oily',array('male_oily', 'product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'male_oily' ),
  ));
register_taxonomy_for_object_type( 'male_oily', 'product' );

}









//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_treatment_categories', 0 );

//create taxonomy, "treatment Categories" for the post type "treatments"
function create_treatment_categories()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels_treatmentcats = array(
    'name' => __( 'Treatment Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Treatment Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Treatment Categories' ),
    'all_items' => __( 'All Treatment Categories' ),
    'parent_item' => __( 'Parent Treatment Category' ),
    'parent_item_colon' => __( 'Parent Treatment Category:' ),
    'edit_item' => __( 'Edit Treatment Category' ),
    'update_item' => __( 'Update Treatment Category' ),
    'add_new_item' => __( 'Add New Treatment Category' ),
    'new_item_name' => __( 'New Treatment Category Name' ),
    'menu_name' => __( 'Treatment Categories' ),
  );

  register_taxonomy('treatment_category',array('treatments'), array(
    'hierarchical' => true,
    'labels' => $labels_treatmentcats,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'treatment_category' ),
  ));
  register_taxonomy_for_object_type( 'treatment_category', 'treatments' );




//Trade Downloads taxonomy
  $labels_tradecats = array(
    'name' => __( 'Trade Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Trade Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Trade Categories' ),
    'all_items' => __( 'All Trade Categories' ),
    'parent_item' => __( 'Parent Trade Category' ),
    'parent_item_colon' => __( 'Parent Trade Category:' ),
    'edit_item' => __( 'Edit Trade Category' ),
    'update_item' => __( 'Update Trade Category' ),
    'add_new_item' => __( 'Add New Trade Category' ),
    'new_item_name' => __( 'New Trade Category Name' ),
    'menu_name' => __( 'Trade Categories' ),
  );
  register_taxonomy('download_categories',array('downloads'), array(
    'hierarchical' => true,
    'labels' => $labels_tradecats,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'trade-support' ),
  ));
  register_taxonomy_for_object_type( 'download_categories', 'downloads' );









  //Attachments taxonomy
  $labels_mediacats = array(
    'name' => __( 'Media Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Media Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Media Categories' ),
    'all_items' => __( 'All Media Categories' ),
    'parent_item' => __( 'Parent Media Category' ),
    'parent_item_colon' => __( 'Parent Media Category:' ),
    'edit_item' => __( 'Edit Media Category' ),
    'update_item' => __( 'Update Media Category' ),
    'add_new_item' => __( 'Add New Media Category' ),
    'new_item_name' => __( 'New Media Category Name' ),
    'menu_name' => __( 'Media Categories' ),
  );
  register_taxonomy('media_categories',array('attachment'), array(
    'hierarchical' => true,
    'sort' => true,
    'show_admin_column' => true,
    'labels' => $labels_mediacats,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'media' ),
  ));
  register_taxonomy_for_object_type( 'media_categories', 'attachment' );
}

function wpse_139269_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'media_categories' /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );



?>