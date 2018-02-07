<?php
add_action("gform_entry_post_save", "recommendations", 10, 2);
function recommendations($entry, $form){

global $_gdc_concern;
global $_gdc_sensitivity;
global $_gdc_age;
global $_gdc_skintype;
$_gdc_concern = $entry["26"];
$_gdc_sensitivity = $entry["27"];
$_gdc_skintype = $entry["24"];
$_gdc_age = $entry["25"];

global $_gdc_sex;
$_gdc_sex = $entry["35"];

global $_gdc_fname;
global $_gdc_sname;
global $_gdc_address1;
global $_gdc_address2;
global $_gdc_address3;
global $_gdc_address4;
global $_gdc_address5;
global $_gdc_phone;
global $_gdc_email;
$_gdc_fname = $entry["19.3"];
$_gdc_sname = $entry["19.6"];
$_gdc_address1 = $entry["29.1"];
$_gdc_address2 = $entry["29.2"];
$_gdc_address3 = $entry["29.3"];
$_gdc_address4 = $entry["29.4"];
$_gdc_address5 = $entry["29.5"];
$_gdc_phone = $entry["28"];
$_gdc_email = $entry["2"];

global $_gdc_cleanserloop;
global $_gdc_tonerloop;
//global $_gdc_exfoliatorloop;
global $_gdc_dailytreatmentloop;
global $_gdc_eyetreatmentloop;
//global $_gdc_addonloop;



global $_gdc_combination;
$_gdc_combination = $_gdc_concern . '-' . $_gdc_age . '-' .$_gdc_sensitivity. '';




/* Cleanser LOOP */
$_gdc_cleanserloop = new wp_query( array(
	'post_type' => 'product',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => $_gdc_skintype,
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
			'terms' => 'for-men',
			'operator' => $_gdc_sex
		)
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
			'taxonomy' => $_gdc_skintype,
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
			'terms' => 'for-men',
			'operator' => $_gdc_sex
		)
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
			'taxonomy' => $_gdc_skintype,
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
			'terms' => 'for-men',
			'operator' => $_gdc_sex
		)
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
			'taxonomy' => $_gdc_skintype,
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
			'terms' => 'for-men',
			'operator' => $_gdc_sex
		)
	),
	'orderby' => 'title',
	'posts_per_page' => '-1',
	'order' => 'ASC'
) );



return $entry;


}


//FILTER POST CONTENT USING LOOP FUNCTION -RECOMMENDED-
add_action("gform_after_submission_20", "display_recommendations", 10, 2);
function display_recommendations(){
add_filter("the_content", "recommended");
}

//OUTPUT RECOMMENDATIONS...
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
//global $_gdc_addonloop;

echo '<div id="autoexpert">';
echo '"Hi ';
echo $_gdc_fname;
echo ', below are the products that are perfect for your particular skin.<br>';
echo 'We have emailed these recomendations to you and samples are on their way for you to try."';
echo '</div>';


global $_gdc_sex;


global $_gdc_combination;
echo $_gdc_combination;

// CLEANSER LOOP
while ( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
?>
<div class="listing">
<h1>Cleanser:<br>
<a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h1>
<?php if ( has_post_thumbnail()) : ?>
   <a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb", array('class' => 'left')); ?>
   </a>
 <?php endif; ?>

<div class="entry-summary">
<em><?php echo get_the_excerpt(); ?></em><br><br><h4>Instructions for use:</h4>
<?php echo term_description( '155', 'recommendation_type' ) ?>

<a class="button" target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >Buy Now</a>
</div>
<!-- <div class="entry-summary"><p><?php echo str_replace("\r", "<br />", get_the_content('')); ?></p></div> -->
<div class="clear"></div></div>
<?php endwhile;




// TONER LOOP
while ( $_gdc_tonerloop->have_posts() ) : $_gdc_tonerloop->the_post();
?>
<div class="listing">
<h1>Toner:<br>
<a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h1>
<?php if ( has_post_thumbnail()) : ?>
   <a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb", array('class' => 'left')); ?>
   </a>
 <?php endif; ?>

<div class="entry-summary">
<em><?php echo get_the_excerpt(); ?></em><br><br><h4>Instructions for use:</h4>
<?php echo term_description( '176', 'recommendation_type' ) ?>

<a class="button" target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >Buy Now</a>
</div>
<!-- <div class="entry-summary"><p><?php echo str_replace("\r", "<br />", get_the_content('')); ?></p></div> -->
<div class="clear"></div></div>
<?php endwhile;




/* EXFOLIATOR LOOP
while ( $_gdc_exfoliatorloop->have_posts() ) : $_gdc_exfoliatorloop->the_post();
?>
<div class="listing">
<h1>Facial Exfoliator:<br>
<a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h1>

<?php if ( has_post_thumbnail()) : ?>
   <a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb", array('class' => 'left')); ?>
   </a>
 <?php endif; ?>

 <div class="entry-summary">
<em><?php echo get_the_excerpt(); ?></em><br><br><h4>Instructions for use:</h4>
<?php echo term_description( '156', 'recommendation_type' ) ?>

<a class="button" target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >Buy Now</a>
</div>
<!-- <div class="entry-summary"><p><?php echo str_replace("\r", "<br />", get_the_content('')); ?></p></div> -->
<div class="clear"></div></div>
<?php endwhile;
*/



// DAILY TREATMENT LOOP
while ( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post(); ?>
<div class="listing">
<h1>Specific Daily Treatment:<br>
<a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h1>

<?php if ( has_post_thumbnail()) : ?>
   <a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb", array('class' => 'left')); ?>
   </a>
 <?php endif; ?>

 <div class="entry-summary">
<em><?php echo get_the_excerpt(); ?></em><br><br><h4>Instructions for use:</h4>
<?php echo term_description( '157', 'recommendation_type' ) ?>
<a class="button" target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >Buy Now</a>
</div>
<!-- <div class="entry-summary"><p><?php echo str_replace("\r", "<br />", get_the_content('')); ?></p></div> -->
<div class="clear"></div></div>
<?php endwhile;




// EYE TREATMENT LOOP
while ( $_gdc_eyetreatmentloop->have_posts() ) : $_gdc_eyetreatmentloop->the_post(); ?>
<div class="listing">
<h1>Eye Treatment:<br>
<a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h1>

<?php if ( has_post_thumbnail()) : ?>
   <a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb", array('class' => 'left')); ?>
   </a>
 <?php endif; ?>

 <div class="entry-summary"><em><?php echo get_the_excerpt(); ?></em><br><br><h4>Instructions for use:</h4>
<?php echo term_description( '159', 'recommendation_type' ) ?>
<a class="button" target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >Buy Now</a>
</div>
<!-- <div class="entry-summary"><p><?php echo str_replace("\r", "<br />", get_the_content('')); ?></p></div> -->
<div class="clear"></div></div>
<?php endwhile;




/* ADDON LOOP
while ( $_gdc_addonloop->have_posts() ) : $_gdc_addonloop->the_post(); ?>
<div class="listing">
<h1>Addons:<br>
<a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h1>


<?php if ( has_post_thumbnail()) : ?>
   <a target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail("thumb", array('class' => 'left')); ?>
   </a>
 <?php endif; ?>

 <div class="entry-summary">
<em><?php echo get_the_excerpt(); ?></em><br><br><h4>Instructions for use:</h4>
<?php echo term_description( '158', 'recommendation_type' ) ?>
<a class="button" target="blank" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >Buy Now</a>
</div>
<!-- <div class="entry-summary"><p><?php echo str_replace("\r", "<br />", get_the_content('')); ?></p></div> -->
<div class="clear"></div></div>
<?php endwhile;

*/

}



//EMAIL
add_filter('gform_notification_20', 'my_gform_notification_signature', 10, 3);
function my_gform_notification_signature( $notification, $form, $entry ) {

	global $post;
	global $_gdc_concern;
	global $_gdc_sensitivity;
	global $_gdc_age;
	global $_gdc_skintype;
	global $_gdc_fname;
	global $_gdc_sname;
	global $_gdc_address1;
	global $_gdc_address2;
	global $_gdc_address3;
	global $_gdc_address4;
	global $_gdc_address5;
	global $_gdc_phone;
	global $_gdc_email;
	global $_gdc_cleanserloop;
	global $_gdc_tonerloop;
//	global $_gdc_exfoliatorloop;
	global $_gdc_dailytreatmentloop;
	global $_gdc_eyetreatmentloop;
//	global $_gdc_addonloop;


// CUSTOMER EMAIL CONTENT
	if($notification["name"] == "Your Personal Recommendation"){

		$notification['to'] = $_gdc_email;


// Email Content:
		$_gdc_email_body = ""; //initialize your variable

		$_gdc_email_body .='<h3>Hi ' . $_gdc_fname . '. Thanks for using our auto-expert</h3><br />';
		$_gdc_email_body .='<h4>Below, you will find our recommendation for your own personal skincare routine.</h4><br><p>Samples of each suggested product are on their way for you to try. ';

		$_gdc_email_body .='If the following address is incorrect, please let us know so that we can make sure you have your samples as quickly as possible.</p><br>';
		$_gdc_email_body .='<p>You can call us on <strong>0845 600 0203</strong>, email us on <a href="mailto:info@germaine-de-capuccini.co.uk">info@germaine-de-capuccini.co.uk</a> or <a href="https://germaine-de-capuccini.co.uk/contact-us/">contact us here</a>.</p><br><p>This is where your samples are being posted to:</p>';
		$_gdc_email_body .='' . $_gdc_address1  . '<br>';
		$_gdc_email_body .='' . $_gdc_address2  . '<br>';
		$_gdc_email_body .='' . $_gdc_address3  . '<br>';
		$_gdc_email_body .='' . $_gdc_address4  . '<br>';
		$_gdc_email_body .='' . $_gdc_address5  . '<br>';
		$_gdc_email_body .='<br><br>';


		$_gdc_email_body .='<h1>Personal skincare routine for '
		. $_gdc_fname .
		':</h1><br>';

		$_gdc_email_body .='<table width="560" border="0" cellspacing="0" cellpadding="0">';



		// Cleanser Loop
		while ( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, 'tiny' );
		$instructions = term_description( '155', 'recommendation_type' );


		$_gdc_email_body .=
		'<tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Cleanser:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">BUY NOW</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;



		// Toner Loop
		while ( $_gdc_tonerloop->have_posts() ) : $_gdc_tonerloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, 'tiny' );
		$instructions = term_description( '176', 'recommendation_type' );


		$_gdc_email_body .=
		'<tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Toner:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">BUY NOW</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;




/* Exfoliator Loop
		while ( $_gdc_exfoliatorloop->have_posts() ) : $_gdc_exfoliatorloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, 'tiny' );
		$instructions = term_description( '156', 'recommendation_type' );

		$_gdc_email_body .=
		'<tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Facial Exfoliator:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">BUY NOW</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;
*/


		// Daily Treatment Loop
		while ( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, 'tiny' );
		$instructions = term_description( '157', 'recommendation_type' );

		$_gdc_email_body .=
		'<tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Daily Treatment Cream:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">BUY NOW</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;


		// Eye Treatment Loop
		while ( $_gdc_eyetreatmentloop->have_posts() ) : $_gdc_eyetreatmentloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, 'tiny' );
		$instructions = term_description( '159', 'recommendation_type' );

		$_gdc_email_body .=
		'<tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Eye Treatment:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">BUY NOW</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;


/* 		Addon Loop
		while ( $_gdc_addonloop->have_posts() ) : $_gdc_addonloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, 'tiny' );
		$instructions = term_description( '158', 'recommendation_type' );

		$_gdc_email_body .=
		'<tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Addon:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">BUY NOW</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;
*/


		$_gdc_email_body .='</table>';

	}



// WAREHOUSE EMAIL CONTENT
	else if($notification["name"] == "Warehouse Notification"){

		// Email Content:
		$_gdc_email_body = ""; //initialize your variable
		$_gdc_email_body .='<h3 style="margin-bottom:20px;">Please send samples of the following products to:</h3>';

		$_gdc_email_body .='Name: ' . $_gdc_fname  . ' ' . $_gdc_sname  .'<br>';
		$_gdc_email_body .='Email: ' . $_gdc_email  . '<br>';
		$_gdc_email_body .='Phone: ' . $_gdc_phone  . '<br><br>';

		$_gdc_email_body .='' . $_gdc_address1  . '<br>';
		$_gdc_email_body .='' . $_gdc_address2  . '<br>';
		$_gdc_email_body .='' . $_gdc_address3  . '<br>';
		$_gdc_email_body .='' . $_gdc_address4  . '<br>';
		$_gdc_email_body .='' . $_gdc_address5  . '<br>';


		$_gdc_email_body .='<ol style="margin-top:40px;">';




		// Cleanser Loop
		while ( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
		$permalink = get_permalink( );
		$_product = new jigoshop_product( $post->id );
		$_gdc_product_sku = $_product->get_sku();
		$_gdc_email_body .=
		'<li>'
		. $_gdc_product_sku .
		': <a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></li>';
		endwhile;



		// Toner Loop
		while ( $_gdc_tonerloop->have_posts() ) : $_gdc_tonerloop->the_post();
		$permalink = get_permalink( );
		$_product = new jigoshop_product( $post->id );
		$_gdc_product_sku = $_product->get_sku();
		$_gdc_email_body .=
		'<li>'
		. $_gdc_product_sku .
		': <a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></li>';
		endwhile;



/* Exfoliator Loop
		while ( $_gdc_exfoliatorloop->have_posts() ) : $_gdc_exfoliatorloop->the_post();
		$permalink = get_permalink( );
		$_product = new jigoshop_product( $post->id );
		$_gdc_product_sku = $_product->get_sku();
		$_gdc_email_body .=
		'<li>'
		. $_gdc_product_sku .
		': <a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></li>';
		endwhile;
*/


		// Daily Treatment Loop
		while ( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post();
		$permalink = get_permalink( );
		$_product = new jigoshop_product( $post->id );
		$_gdc_product_sku = $_product->get_sku();
		$_gdc_email_body .=
		'<li>'
		. $_gdc_product_sku .
		': <a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></li>';
		endwhile;


		// Eye Treatment Loop
		while ( $_gdc_eyetreatmentloop->have_posts() ) : $_gdc_eyetreatmentloop->the_post();
		$permalink = get_permalink( );
		$_product = new jigoshop_product( $post->id );
		$_gdc_product_sku = $_product->get_sku();
		$_gdc_email_body .=
		'<li>'
		. $_gdc_product_sku .
		': <a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></li>';
		endwhile;


/* Addon Loop
		while ( $_gdc_addonloop->have_posts() ) : $_gdc_addonloop->the_post();
		$permalink = get_permalink( );
		$_product = new jigoshop_product( $post->id );
		$_gdc_product_sku = $_product->get_sku();
		$_gdc_email_body .=
		'<li>'
		. $_gdc_product_sku .
		': <a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></li>';
		endwhile;
*/

		$_gdc_email_body .='</ol>';

	}



	// RETURN EMAIL CONTENT
		$notification['message'] = $_gdc_email_body;
	    return $notification;


} // END gform_notification_20

?>