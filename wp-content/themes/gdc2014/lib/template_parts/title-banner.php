<?php 


//PAGE TITLE AND BANNER IMAGE
if (is_page(  )){ 
	$page_title = get_the_title();
	if ( has_post_thumbnail() ) {
		$bannerimage = get_the_post_thumbnail( $post->ID, 'banner', array( 'class'	=> "mobile_feature_image", ));
	}
	else{
		$bannerimage = '<img src="' . get_bloginfo('stylesheet_directory') . '/images/gdc-fallback-banner.jpg" alt="Germaine de Capuccini"/>';
	}
}

// TAXONOMY PAGE TITLE AND BANNER IMAGE
elseif (is_tax(  )){ 
	$bannerimage = apply_filters( 'taxonomy-images-queried-term-image', '', array(
		'after' => '',
		'attr' => array(
		    'alt'   => $term->name,
		    'class' => 'mobile_feature_image',
		    'title' => $term->name,
		    ),
		'before' => '',
		'image_size' => 'banner',
		) );
		$term =	$wp_query->queried_object; 
		$page_title = $term->name;
} ?>

<div class="homebanner">
    <?php echo $bannerimage; ?>
    <div id="bannerwrapouter">
            <h1 class="page-title keymessage"><?php echo $page_title; ?></h1>
    </div>
</div>