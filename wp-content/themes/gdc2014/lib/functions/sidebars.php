<?php
function gdc_custom_sidebars() { 
	global $post;
	global $wp_query;


	//SKINCARE EXPERT
	if ( is_page( 'skincare-expert' ) || is_page( '3432' ) || is_singular( 'recommendation' ) ){ get_template_part( 'lib/template_parts/sidebar', 'shopfront' ); }


	// TREATMENTS
	elseif (is_tax( 'treatment_category' )){ 
		get_template_part( 'lib/template_parts/menu', 'aside_treatment_categories' );
		get_template_part( 'lib/template_parts/menu', 'aside_featured_treatments' );
	} 

	elseif (is_singular( 'treatments' )){ get_template_part( 'lib/template_parts/sidebar', 'treatments_list' ); } 
	elseif (is_post_type_archive( 'treatments' )){ get_template_part( 'lib/template_parts/sidebar', 'treatments' ); } // THIS ONE DOESN'T EXIST!?
	

	//SPAFINDER
	elseif ( is_page( '57' ) || is_page( '678' )){ get_template_part( 'lib/template_parts/sidebar', 'spafinder' ); }


	//SINGLE SPA RETREATS / SINGLE LOCATIONS
	elseif (is_singular( 'sm-location' )){ get_template_part( 'lib/template_parts/sidebar', 'location' ); } 

	//BLOG SIDEBAR
	elseif (is_singular( 'post' )){ get_template_part( 'lib/template_parts/sidebar', 'blog' ); } 
	elseif (is_home() ){ get_template_part( 'lib/template_parts/sidebar', 'blog' ); }
	elseif (is_category() ){ get_template_part( 'lib/template_parts/sidebar', 'blog' ); } 


	//TRADE
	elseif ( is_page( 'trade-support' ) || is_page( '6516' )){ 
		get_template_part( 'lib/template_parts/sidebar', 'image_library' );
		get_template_part( 'lib/template_parts/sidebar', 'trade2' ); 
	}
	elseif (is_tax( 'media_categories' ) ){ 
		get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
		get_template_part( 'lib/template_parts/sidebar', 'image_library' );
		get_template_part( 'lib/template_parts/sidebar', 'download_subcat_list' );
		get_template_part( 'lib/template_parts/sidebar', 'download_cat_list' );
		
	}
	elseif (is_page( 'product-images' ) || is_page( '24399' )){ 
		get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
		get_template_part( 'lib/template_parts/sidebar', 'image_library' );
		get_template_part( 'lib/template_parts/sidebar', 'download_cat_list' );
		
	}
	elseif ( is_page( 'profile' ) || is_page( '8907' )){ 
		get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
		get_template_part( 'lib/template_parts/sidebar', 'profile' );
	}



	elseif ( is_account_page() ){ 
		get_template_part( 'lib/template_parts/sidebar', 'edit_info' ); 
	}


	elseif ( is_page( 'admin' ) || is_page( '2301' ) ){ 
		get_template_part( 'lib/template_parts/sidebar', 'trade' ); 
	}	
	elseif ( is_page( 'trade-ordering' ) || is_page( '6610' )){ 
		get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
		get_template_part( 'lib/template_parts/sidebar', 'download_cat_list' );  
	}
	elseif (is_singular( 'downloads' )){ 
		get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
		get_template_part( 'lib/template_parts/sidebar', 'downloads_list' ); 
		get_template_part( 'lib/template_parts/sidebar', 'download_cat_list' );
	}
	elseif (is_tax( 'download_categories' )){ 
		get_template_part( 'lib/template_parts/sidebar', 'current_user_info' );
		get_template_part( 'lib/template_parts/sidebar', 'download_subcat_list' );
		get_template_part( 'lib/template_parts/sidebar', 'download_cat_list' );
		get_template_part( 'lib/template_parts/sidebar', 'image_library' ); 
	}



	//MORE INFO PAGE OR ANY SUB-PAGE
	elseif ( is_page( 'about-germaine-de-capuccini' ) || is_page( '6436' ) ){ 
		echo '<div class="aside"><a class="button" href="' . get_permalink('6516') . '">Existing Customer Support</a></div>';
		get_template_part( 'lib/template_parts/sidebar', 'about_gdc' ); 
	}

	$current_page_id = $wp_query->get_queried_object_id();
    $current_post = get_post($current_page_id);
	//global $post;
	if($current_post->post_parent == '6436'){
		get_template_part( 'lib/template_parts/sidebar', 'about_gdc' ); 
	}


	//PRESS ARTICLES
	elseif (is_singular( 'pressarticle' )){ get_template_part( 'lib/template_parts/sidebar', 'pr_list' ); } 
	elseif ( is_page( 'press-coverage' ) || is_page( '3659' )){ get_template_part( 'lib/template_parts/sidebar', 'pr_list' ); }
	


	//CONTACT PAGE
	elseif ( is_page( 'contact' ) || is_page( '450' )){ get_template_part( 'lib/template_parts/sidebar', 'contact' ); }


	elseif(is_page('my-account')){
	}
	


	elseif(is_page('request-trade-access')){
	}



	// SHOP SIDEBARS
	elseif( is_woocommerce() || is_page_template( 'template-custom-shop-page.php' )){
        get_template_part( 'lib/template_parts/menu', 'shop_navigation' ); 
        get_template_part( 'lib/template_parts/sidebar', 'shop_notifications' ); 

        // CALL SHOP ASIDE WIDGET AREA
        if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Shop Aside') ) :
		endif;

    }
	

	//ANY OTHER PAGE
	else { 
	//	echo '<div class="aside"><h3>No specified sidebar!</h3></div>';
	}
    
} 
add_action( 'thematic_betweenmainasides', 'gdc_custom_sidebars' );






function testing(){
	global $post;
	echo '<div class="aside">';
		echo '. ' . $post->ID;
		echo '<br>.. ' . $post->post_parent . '<br>';
		//print_r($post);
	echo '</div>';
}
//add_action( 'thematic_belowmainasides', 'testing' );


?>