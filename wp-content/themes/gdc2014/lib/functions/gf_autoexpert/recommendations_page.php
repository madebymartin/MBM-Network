<?php
function recommended() {
	global $post;

	global $_gdc_concern;
	global $_gdc_sensitivity;
	global $_gdc_age;
	global $_gdc_skintype;
	global $_gdc_fname;

	global $_gdc_cleanserloop;
	global $_gdc_tonerloop;
	//global $_gdc_exfoliatorloop;
	global $_gdc_dailytreatmentloop;
	global $_gdc_eyetreatmentloop;

	global $_gdc_sex;
	global $_gdc_combination;


	echo '<div id="autoexpert">';
	echo '"Hi ';
	echo $_gdc_fname;
	echo ', below are the products that are perfect for your particular skin.<br>';
	echo 'We have emailed these recomendations to you for your reference."';
	echo '</div>';


	//CLEANSER LOOP
	if ( $_gdc_cleanserloop->have_posts() ) {
			// Print each product
			while( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
				// Get a new jigoshop_product instance
				$_product = new jigoshop_product( get_the_ID() );
				$prodprice = $_product->get_price_html();
				$jigoshop_options = Jigoshop_Base::get_options();
				if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '155', 'recommendation_type' );
				}
					// Title
					echo '<div class="panel"><h1>Your Recommended Cleanser:<br>';
					echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
					echo '<h3>Instructions for use:</h3>';
					echo $instructions;
					echo '<div class="excurpt">';
					// LINK TO ASSOCIATED PRODUCT RANGE(S)
					echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
					//THE EXCURPT
					the_excerpt();
					echo '</div>';
					echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
						// Print the product image
						echo ( has_post_thumbnail() )
						? the_post_thumbnail()
						: jigoshop_get_image_placeholder();
					echo '</a></div>';
					echo '<div class="buttons">';
						// MORE INFO BUTTON
						echo'<a href="';
						echo the_permalink();
						echo '" class="button">More Info</a>';
						// ADD TO CART BUTTON
						echo'<a href="'.esc_url($_product->add_to_cart_url()).'" class="button" rel="nofollow">Add to Bag ('.$prodprice.')</a></div>';
					echo '</div><br><br>';
			endwhile;
	} else {} ?>
	<?php wp_reset_query(); 




	// TONER LOOP
	if ( $_gdc_tonerloop->have_posts() ) {
			// Print each product
			while( $_gdc_tonerloop->have_posts() ) : $_gdc_tonerloop->the_post();
				// Get a new jigoshop_product instance
				$_product = new jigoshop_product( get_the_ID() );
				$prodprice = $_product->get_price_html();
				$jigoshop_options = Jigoshop_Base::get_options();
				if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '158', 'recommendation_type' );
				}
					// Title
					echo '<div class="panel"><h1>Your Recommended Toner:<br>';
					echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
					echo '<h3>Instructions for use:</h3>';
					echo $instructions;
					echo '<div class="excurpt">';
					// LINK TO ASSOCIATED PRODUCT RANGE(S)
					echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
					//THE EXCURPT
					the_excerpt();
					echo '</div>';
					echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
						// Print the product image
						echo ( has_post_thumbnail() )
						? the_post_thumbnail()
						: jigoshop_get_image_placeholder();
					echo '</a></div>';
					echo '<div class="buttons">';
						// MORE INFO BUTTON
						echo'<a href="';
						echo the_permalink();
						echo '" class="button">More Info</a>';
						// ADD TO CART BUTTON
						echo'<a href="'.esc_url($_product->add_to_cart_url()).'" class="button" rel="nofollow">Add to Bag ('.$prodprice.')</a></div>';
					echo '</div><br><br>';
			endwhile;
	} else {} ?>
	<?php wp_reset_query();




	// DAILY TREATMENT LOOP
		if ( $_gdc_dailytreatmentloop->have_posts() ) {
			// Print each product
			while( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post();
				// Get a new jigoshop_product instance
				$_product = new jigoshop_product( get_the_ID() );
				$prodprice = $_product->get_price_html();
				$jigoshop_options = Jigoshop_Base::get_options();
				if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '156', 'recommendation_type' );
				}
					// Title
					echo '<div class="panel"><h1>Your Recommended Daily Treatment:<br>';
					echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
					echo '<h3>Instructions for use:</h3>';
					echo $instructions;
					echo '<div class="excurpt">';
					// LINK TO ASSOCIATED PRODUCT RANGE(S)
					echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
					//THE EXCURPT
					the_excerpt();
					echo '</div>';
					echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
						// Print the product image
						echo ( has_post_thumbnail() )
						? the_post_thumbnail()
						: jigoshop_get_image_placeholder();
					echo '</a></div>';
					echo '<div class="buttons">';
						// MORE INFO BUTTON
						echo'<a href="';
						echo the_permalink();
						echo '" class="button">More Info</a>';
						// ADD TO CART BUTTON
						echo'<a href="'.esc_url($_product->add_to_cart_url()).'" class="button" rel="nofollow">Add to Bag ('.$prodprice.')</a></div>';
					echo '</div><br><br>';
			endwhile;
	} else {} ?>
	<?php wp_reset_query();



	// EYE TREATMENT LOOP
			if ( $_gdc_eyetreatmentloop->have_posts() ) {
			// Print each product
			while( $_gdc_eyetreatmentloop->have_posts() ) : $_gdc_eyetreatmentloop->the_post();
				// Get a new jigoshop_product instance
				$_product = new jigoshop_product( get_the_ID() );
				$prodprice = $_product->get_price_html();
				$jigoshop_options = Jigoshop_Base::get_options();
				if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '157', 'recommendation_type' );
				}
					// Title
					echo '<div class="panel"><h1>Your Recommended Eye Treatment:<br>';
					echo'<a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_title() . '</a></h1>';
					echo '<h3>Instructions for use:</h3>';
					echo $instructions;
					echo '<div class="excurpt">';
					// LINK TO ASSOCIATED PRODUCT RANGE(S)
					echo get_the_term_list( $post->ID, 'product_range', '<em style="text-align:center;">From range: ', ', ', '</em><br><br>' );
					//THE EXCURPT
					the_excerpt();
					echo '</div>';
					echo'<div class="main-product-image"><a href="' . esc_attr( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
						// Print the product image
						echo ( has_post_thumbnail() )
						? the_post_thumbnail()
						: jigoshop_get_image_placeholder();
					echo '</a></div>';
					echo '<div class="buttons">';
						// MORE INFO BUTTON
						echo'<a href="';
						echo the_permalink();
						echo '" class="button">More Info</a>';
						// ADD TO CART BUTTON
						echo'<a href="'.esc_url($_product->add_to_cart_url()).'" class="button" rel="nofollow">Add to Bag ('.$prodprice.')</a></div>';
					echo '</div><br><br>';
			endwhile;
	} else {} ?>
	<?php wp_reset_query();

}

?>