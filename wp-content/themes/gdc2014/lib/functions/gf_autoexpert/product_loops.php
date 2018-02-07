<?php


if ($_gdc_sex === 'male'){
// MALE
$_gdc_taxonomy = $_gdc_sex . '_' . $_gdc_skintype;
	}


else {
// FEMALE
$_gdc_taxonomy = $_gdc_skintype;
	}

/* Cleanser LOOP */
		$_gdc_cleanserloop = new wp_query( array(
			'post_type' => 'product',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => $_gdc_taxonomy,
					'field' => 'slug',
					'terms' => $_gdc_combination
				),
				array(
					'taxonomy' => 'recommendation_type',
					'field' => 'slug',
					'terms' => 'cleanser'
				),
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => 'samples',
					'operator' => 'NOT IN'
				),
			),
			'orderby' => 'title',
			'posts_per_page' => '-1',
			'order' => 'ASC'
	) );

/* TONER LOOP */
$_gdc_tonerloop = new wp_query( array(
	'post_type' => 'product',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => $_gdc_taxonomy,
			'field' => 'slug',
			'terms' => $_gdc_combination
		),
		array(
			'taxonomy' => 'recommendation_type',
			'field' => 'slug',
			'terms' => 'toner'
		),
		array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => 'samples',
			'operator' => 'NOT IN'
		),
	),
	'orderby' => 'title',
	'posts_per_page' => '-1',
	'order' => 'ASC'
) );

/* DAILY TREATMENT LOOP */
$_gdc_dailytreatmentloop = new wp_query( array(
	'post_type' => 'product',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => $_gdc_taxonomy,
			'field' => 'slug',
			'terms' => $_gdc_combination
		),
		array(
			'taxonomy' => 'recommendation_type',
			'field' => 'slug',
			'terms' => 'daily-treatment-cream'
		),
		array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => 'samples',
			'operator' => 'NOT IN'
		),
	),
	'orderby' => 'title',
	'posts_per_page' => '-1',
	'order' => 'ASC'
) );




/* EYE TREATMENT LOOP */
$_gdc_eyetreatmentloop = new wp_query( array(
	'post_type' => 'product',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => $_gdc_taxonomy,
			'field' => 'slug',
			'terms' => $_gdc_combination
		),
		array(
			'taxonomy' => 'recommendation_type',
			'field' => 'slug',
			'terms' => 'eye-treatment'
		),
		array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => 'samples',
			'operator' => 'NOT IN'
		),
	),
	'orderby' => 'title',
	'posts_per_page' => '-1',
	'order' => 'ASC'
) );
?>