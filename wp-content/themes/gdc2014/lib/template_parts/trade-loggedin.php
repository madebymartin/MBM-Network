<?php 
// DEFINE VARIABLES
$user_id = get_current_user_id();
$fave_product = esc_attr( get_the_author_meta( 'favourite_product', $user_id ) );
$fave_product_obj = get_page_by_title( $fave_product, 'ARRAY_A', 'product' );
$fave_product_id = $fave_product_obj['ID'];


// NEWS
$news_loop = new WP_Query( array(
	'post_type' => 'downloads',
	'posts_per_page' => '2',
	'orderby' => 'date',
	'order' => 'DESC',
	'tax_query' => array(
		array(
		'taxonomy' => 'download_categories',
		//'field' => 'slug',
		'terms' => '248',
		'operator' => 'IN'
		)),
	) 
);
$news_page_link = get_term_link( 'news-info', 'download_categories' );


// POSTERS
$posters_loop = new WP_Query( array(
	'post_type' => 'downloads',
	'posts_per_page' => '4',
	'orderby' => 'date',
	'order' => 'DESC',
	'tax_query' => array(
		array(
		'taxonomy' => 'download_categories',
		//'field' => 'slug',
		'terms' => '307',
		'operator' => 'IN'
		)),
	) 
);
$posters_page_link = get_term_link( 'posters-marketing', 'download_categories' );
$posters_term_description = term_description( '307', 'download_categories' );


// PRODUCT INFO
$product_info_loop = new WP_Query( array(
	'post_type' => 'downloads',
	'posts_per_page' => '1',
	'orderby' => 'date',
	'order' => 'DESC',
	'tax_query' => array(
		array(
		'taxonomy' => 'download_categories',
		//'field' => 'slug',
		'terms' => '246',
		'operator' => 'IN'
		)),
	) 
);
$product_info_page_link = get_term_link( 'product-information', 'download_categories' );
$product_info_term_description = term_description( '246', 'download_categories' );


// LINKED SALON - ACCOUNT MANAGER ETC
$connected_salon = new WP_Query( array(
	'connected_type' => 'salon_staff',
	'post_status' => array('publish', 'draft'),
	'connected_items' => $user_id,
	'nopaging' => true,
	) 
);


// PRODUCT INFO
$latest_product_loop = new WP_Query( array(
	'post_type' => 'product',
	'posts_per_page' => '1',
	'orderby' => 'date',
	'order' => 'DESC',
	) 
);



echo '<ul class="trade-articles">';


// NEWS OUTPUT
if($news_loop->have_posts()){
	while ( $news_loop->have_posts() ) : $news_loop->the_post();
		echo '<li class="trade">';
			echo '<h2>Latest News: ' . get_the_title() . ' </h2>';
			echo '<div class="trade-image">';
				if(has_post_thumbnail()){echo get_the_post_thumbnail( get_the_id(), 'large', array( 'alt' => get_the_title() ) );}
				else{ echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/gdc-swan.png">';}
			echo '</div>';
			echo '<div class="excurpt">';
			echo substr(get_the_content(),0,350).'...';
			echo '<a href="' . get_the_permalink() . '"> Read more</a>';
			
/*
			?>
			<br><br>
			<ul class="margin0 padding0 downloads">
				<?php if ( get_post_meta(get_the_ID(), '_cmb_generic', true) ) { ?>
				<li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_generic", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download</a></li>
				<?php } else { ?><?php } ?>

				<?php if ( get_post_meta(get_the_ID(), '_cmb_high_res', true) ) { ?>
				<li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_high_res", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print in-house</a></li>
				<?php } else { ?><?php } ?>

				<?php if ( get_post_meta(get_the_ID(), '_cmb_print-ready', true) ) { ?>
				<li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_print-ready", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print professionally</a></li>
				<?php } else { ?><?php } ?>

				<?php if ( get_post_meta(get_the_ID(), '_cmb_low_res', true) ) { ?>
				<li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_low_res", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to view on-screen</a></li>
				<?php } else { ?><?php } ?>
			</ul>
			<?php
*/

			echo '<br><a class="button" href="' . $news_page_link . '">View all news</a>';
			echo '</div>';
		echo '</li><br>';
	endwhile; 
	echo '<br>';
}




// POSTERS LINK OUTPUT
if($posters_loop->have_posts()){
	

	echo '<li class="trade">';
		echo '<h2>Latest Marketing Material</h2>';
		echo $posters_term_description;
		while ( $posters_loop->have_posts() ) : $posters_loop->the_post();
			echo '<a title="' . get_the_title() . '" href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_id(), 'large', array( 'alt' => get_the_title(), 'class' => "tradeposter" ) ) . '</a>';
		endwhile;
	//	echo '<div class="trade-image">' . $button . '</div>';
		echo '<div class="excurpt">';
			
			echo '<br><a class="button" href="' . $posters_page_link . '">View All Posters</a>';
		echo '</div>';
	echo '</li><br>';
}

/*
// PRODUCT INFO LINK OUTPUT
if($product_info_loop->have_posts()){
	while ( $product_info_loop->have_posts() ) : $product_info_loop->the_post();
		$button = get_the_post_thumbnail( get_the_id(), 'large', array( 'alt' => get_the_title() ) );
	endwhile; 

	echo '<li class="trade">';
		echo '<h2>Posters & Marketing Material</h2>';
		echo '<div class="trade-image">' . $button . '</div>';
		echo '<div class="excurpt">';
			echo $product_info_term_description;
			echo '<br><a class="button" href="' . $product_info_page_link . '">View All Posters</a>';
		echo '</div>';
	echo '</li><br>';
}
*/



echo '<li class="trade">';
	echo '<h2>40% trade discount on all products</h2>';
	if($fave_product){
		echo '<div class="tradeproduct">';
			echo '<h5>Favourite product</h5>';
			echo '<div class="main-product-image"><a title="' . get_the_title($fave_product_id) . '" href="' . get_the_permalink($fave_product_id) . '">' . get_the_post_thumbnail( $fave_product_id, 'large', array( 'alt' => get_the_title($fave_product_id) ) ) . '</a></div>';
			echo $fave_product;
		echo '</div>';
	} else{
		echo '<div class="tradeproduct">';
			echo '<h5>Favourite product</h5>';
			echo "You haven't told us your favourite product yet!";
			echo '<br><a class="" href="' .  get_permalink('9030') . '">Update your profile here.</a>';

		echo '</div>';
	}


	if($latest_product_loop->have_posts()){
		while ( $latest_product_loop->have_posts() ) : $latest_product_loop->the_post();
			echo '<div class="tradeproduct">';
				echo '<h5>Newest product</h5>';
				echo '<div class="main-product-image"><a title="' . get_the_title() . '" href="' . get_the_permalink() . '">' . get_the_post_thumbnail( get_the_id(), 'large', array( 'alt' => get_the_title() ) ) . '</a></div>';
				echo get_the_title();
			echo '</div>';
		endwhile;
	}






	echo '<div class="excurpt">';
		
		echo '<br><a class="button" href="' . get_permalink( woocommerce_get_page_id( 'shop' ) ) . '">Lets go shopping</a>';
	echo '</div>';
echo '</li><br>';


echo '<li class="trade">';
	echo '<h2>Trade Ordering</h2>';
	echo '<div class="excurpt">Place your trade order for professional products in your own time outside of office hours.</div>';
//	echo $posters_term_description;
	echo '<div class="trade-image"><a title="' . get_the_title('6610') . '" href="' . get_the_permalink('6610') . '">' . get_the_post_thumbnail( '6610', 'large', array( 'alt' => get_the_title('6610') ) ) . '</a></div>';
	echo '<div class="excurpt">';
		echo '<br><a class="button" href="' . get_permalink('6610') . '">Order Professional Products</a>';
	echo '</div>';
echo '</li><br>';




echo '</ul>';


?>

<a target="blank" href="https://www.facebook.com/GermaineDeCapucciniUK">Follow us on Facebook</a>







