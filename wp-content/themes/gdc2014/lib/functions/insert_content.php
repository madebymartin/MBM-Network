<?php

// FULLSCREEN BG IMAGE FROM FEATURED IMAGE OR ELSE FALLBACK IMAGE

function mbm_footer_menu(){
	$menu = 'Footer';
	$args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false 
    );

	$items = wp_get_nav_menu_items( $menu, $args );


	$theme_dir = get_stylesheet_directory_uri();
	$xml_url = "http://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=service&negativesanswered=true&limit=1000&sortby=date&order=desc&allcomments=True&since=year";
	$xml = simplexml_load_file($xml_url);

	if( ! $xml ) { 
	// COULDNT GET THE XML FROM FEEFO
	} 
	else { 
		// SUCCESSFULLY GOT FEEFO XML FEED
		foreach ($xml as $feedback) {
			if($feedback->AVERAGE){$review_count = $feedback->AVERAGE;}
		}
	}



	if($items){
		//echo '<div class="sub-wrapper">';
			echo '<div class="black_bcknd"><div id="footer-menu">';
				echo '<div class="inner">';
					echo '<ul class="menu-footer">';
						foreach($items as $item){

							$class = 'menu-item menu-item-type-' . $item->type . ' menu-item-object-' . $item->object . ' menu-item-' .  $item->ID;
							if($item->classes){
								$classes = implode(" ", $item->classes);
								$class = $class . ' ' . $classes;
							}
							$url = $item->url;

							echo '<li class="' . $class . '"><a href="' . $url . '">' . $item->title . '</a></li>';
						}
						echo '<li class="feefo"><a href="http://germaine-de-capuccini.co.uk/reviews/"><span class="feefo-yellow">' . $review_count . '%</span> <img style="width:80px;" width="80" src="' . $theme_dir . '/images/feefo-logo.png"><br>Customer Satisfaction</a></li>';
					echo '</ul>';
				echo '</div>';
			echo '</div></div>';
		//echo '</div>';
	}
}
add_action('thematic_footer','mbm_footer_menu', 10);




function bgimage() { 
	global $post;

	if( ! is_front_page()){
		//not homepage

		$pattern = get_stylesheet_directory_uri() . '/images/pattern.png' ;
		
		$fade = get_stylesheet_directory_uri() . '/images/fade.png' ;

		if(is_singular( 'product' )){ 
				$categories = get_the_terms( $post->ID , 'product_range' );
				if (is_array($categories)) {
					foreach($categories as $category) {
				 	$tax_term_id = $category->term_taxonomy_id;
				 	$images = get_option('taxonomy_image_plugin');
				 	$imgsrc = wp_get_attachment_image_src( $images[$tax_term_id], 'full' );
				 	$bgimage = $imgsrc['0'];
					}
				}
		}
/*
		elseif (is_post_type_archive ( 'product' )){ 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id('4'), '' );
			$bgimage = $thumb['0'];
		}
*/

		elseif (is_tax( 'product_cat' )){ 
			$prodcat_id = get_queried_object()->term_id;
			$thumbnail_id = get_woocommerce_term_meta( $prodcat_id, 'thumbnail_id', true ); 
            $image = wp_get_attachment_url( $thumbnail_id );
            if(!empty($image)){$bgimage = $image;}
            else{$bgimage = '//wc.germaine-de-capuccini.co.uk/wp-content/themes/gdc_responsive/images/gdc-background.jpg';}
		}



		elseif (is_tax( )){ 
			$bgimage = apply_filters( 'taxonomy-images-queried-term-image-url', '', array( 'image_size' => 'full' ) ); 
		}


		elseif(is_singular( 'treatments' )){ 
			$post_thumbnail_id = get_post_thumbnail_id( '53');
			$thumb_url = wp_get_attachment_image_src($post_thumbnail_id,'full', true);
			$bgimage = $thumb_url['0'];
		}

		elseif (is_singular( 'pressarticle' )){ 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id('3659'), '' );
			$bgimage = $thumb['0'];
		}

			
		elseif (is_shop( )){ 
			$bgimage = '//germaine-de-capuccini.co.uk/files/Shop-Background.jpg'; 
		}


			

		else{
		// none of the above
			if ( has_post_thumbnail() ) { 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
			$bgimage = $thumb['0'];
			}
			else { 
				$bgimage = get_stylesheet_directory_uri() . '/images/gdc-background.jpg' ;
			} 			
			
		} ?>

 
		<div id="bgimage" style="
		background: url(<?php echo $pattern; ?>) fixed, url(<?php echo $bgimage; ?>) 50% 50% fixed no-repeat;
		-webkit-background-size: auto cover;
		-moz-background-size: auto, cover; /* Firefox 3.6 */ 
		-o-background-size: auto cover;
		background-size: auto, cover; /* Chrome, Firefox 4.0+, Safari 4.1+, Opera 10+ and IE9 */
		"></div>
		<?php

	} else{
	//homepage

		$pattern = get_stylesheet_directory_uri() . '/images/clear.png' ;
		$fade = get_stylesheet_directory_uri() . '/images/fade.png' ;

		if ( has_post_thumbnail() ) { 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' );
			$bgimage = $thumb['0'];
			}
			else { 
				$bgimage = get_stylesheet_directory_uri() . '/images/gdc-background.jpg' ;
			}
	 ?>

		<div id="bgimage" style="
		background: url(<?php echo $pattern; ?>) fixed, url(<?php echo $bgimage; ?>) 50% 50% fixed no-repeat;
		-webkit-background-size: auto cover;
		-moz-background-size: auto, cover; /* Firefox 3.6 */ 
		-o-background-size: auto cover;
		background-size: auto, cover; /* Chrome, Firefox 4.0+, Safari 4.1+, Opera 10+ and IE9 */
		"></div>


	<?php }

}
add_action('thematic_aboveheader','bgimage');




function insert_yoast_breadcrumbs(){
	if ( function_exists('yoast_breadcrumb') ) { 
		if( is_product() ){
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} 
	}
}
add_action('thematic_header','insert_yoast_breadcrumbs', 10);

/*

function homepageimage(){
		if(is_front_page()){
		 the_post_thumbnail('', array('class' => 'homepageimage'));
	} 
}
add_action('thematic_abovecontainer','homepageimage');
*/





/*
function mbm_breadcrumbs() { ?>
    <?php if(function_exists('bcn_display')) { ?>
        
		<?php if (is_post_type_archive( 'product' )){ ?>
			<div class="breadcrumbs"><?php bcn_display(); ?></div>
		<?php } 

		elseif (is_tax( 'product_cat' )){ ?>
			<div class="breadcrumbs"><?php bcn_display(); ?></div>
		<?php } 

		elseif (is_singular( 'product' )){ ?>
			<div class="breadcrumbs"><?php bcn_display(); ?></div>
		<?php } 
	}
}

add_action('thematic_belowheader','mbm_breadcrumbs');
*/
?>