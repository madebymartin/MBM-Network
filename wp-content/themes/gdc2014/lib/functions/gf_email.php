<?php
add_action("gform_pre_send_email", "before_email", 10, 2);
function before_email($email){

global $concern;
global $sensitivity;
global $age;
global $skintype;

//$post = get_post($entry["post_id"]);

$concern = $entry[26];
$sensitivity = $entry[27];
$skintype = $entry[24];
$age = $entry[25];

add_filter("the_content", "emailcontents");
}





function emailcontents() {

global $concern;
global $sensitivity;
global $age;
global $skintype;

echo 'Here are your recommendation, based on your chosen options: ';
echo '<br>Age: ';
echo $age;
echo '<br>Sensitivity: ';
echo $sensitivity;
echo '<br>Skin Type: ';
echo $skintype;
echo '<br>Concern: ';
echo $concern;
echo '<br><br>';


/* Cleanser/Toner LOOP */
$cleansetoneloop = new wp_query( array( 
	'post_type' => 'product',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'concern',
			'field' => 'slug',
			'terms' => $concern
		),
		array(
			'taxonomy' => 'sensitivity',
			'field' => 'slug',
			'terms' => $sensitivity
		),
		array(
			'taxonomy' => 'age_group',
			'field' => 'slug',
			'terms' => $age
		),
		array(
			'taxonomy' => 'skintype',
			'field' => 'slug',
			'terms' => $skintype
		),
		array(
			'taxonomy' => 'recommendation_type',
			'field' => 'slug',
			'terms' => 'cleanser-toner'
		)
	),
	'orderby' => 'title',
	'posts_per_page' => '-1', 
	'order' => 'ASC'
) );

while ( $cleansetoneloop->have_posts() ) : $cleansetoneloop->the_post(); ?>
<div class="recommend cleansertoner">
<h2>Your recommended cleansing / toning option:</h2>
<?php the_title(); ?><br>
<?php if ( has_post_thumbnail()) : ?>
   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb"); ?>
   </a>
 <?php endif; ?>
</div>
<?php endwhile; 



/* EXFOLIATOR LOOP */
$exfoliatorloop = new wp_query( array( 
	'post_type' => 'product',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'concern',
			'field' => 'slug',
			'terms' => $concern
		),
		array(
			'taxonomy' => 'sensitivity',
			'field' => 'slug',
			'terms' => $sensitivity
		),
		array(
			'taxonomy' => 'age_group',
			'field' => 'slug',
			'terms' => $age
		),
		array(
			'taxonomy' => 'skintype',
			'field' => 'slug',
			'terms' => $skintype
		),
		array(
			'taxonomy' => 'recommendation_type',
			'field' => 'slug',
			'terms' => 'facial-exfoliator'
		)
	),
	'orderby' => 'title',
	'posts_per_page' => '-1', 
	'order' => 'ASC'
) );

while ( $exfoliatorloop->have_posts() ) : $exfoliatorloop->the_post(); ?>
<div class="recommend cleansertoner">
<h2>Your recommended exfoliator:</h2>
<?php the_title(); ?><br>
<?php if ( has_post_thumbnail()) : ?>
   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb"); ?>
   </a>
 <?php endif; ?>
</div>
<?php endwhile; 





}
?>