<?php
$notification['to'] = $_gdc_email;

global $mbm_coupon_post_id;
global $recommendation_post_id;
global $_gdc_sex;
// Email Content:
		$_gdc_email_body = ""; //initialize your variable
		$_gdc_email_body .='<h3>Hi ' . $_gdc_fname . '. Thanks for using our Skincare Expert.<br />';
		$_gdc_email_body .='Here is your personal essential skincare routine:</h3><br><br>';

		$_gdc_email_body .='You can view this online <a href="' . get_permalink( $recommendation_post_id ) . '">Here.</a> Bookmark this link for future reference as it will be updated automatically with any new products that are even better suited to you.<br><br>';
	//	$_gdc_email_body .='This Coupon Code will give you a 15% discount on your first order: ' . get_the_title( $mbm_coupon_post_id ) . '<br>';






// PERSONALISED ROUTINE
		$_gdc_email_body .='<table width="560" border="0" cellspacing="0" cellpadding="0">';


		// Cleanser Loop
		while ( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, '200sq' );
		if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '155', 'recommendation_type' );
				}


		$_gdc_email_body .=
		'<tr><td><hr><h2>Cleanser:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
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
		$prodimage = get_the_post_thumbnail( $post_id, '200sq' );
		if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '158', 'recommendation_type' );
				}


		$_gdc_email_body .=
		'<tr><td><hr><h2>Toner:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';
		endwhile;



		// Daily Treatment Loop
		while ( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post();
		$post_id = get_the_ID();
		$permalink = get_permalink( );
		$prodexcerpt = get_the_excerpt();
		$prodimage = get_the_post_thumbnail( $post_id, '200sq' );
		if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '156', 'recommendation_type' );
				}

		$_gdc_email_body .=
		'<tr><td><hr><h2>Daily Facial Moisturiser:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
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
		$prodimage = get_the_post_thumbnail( $post_id, '200sq' );
		if ( get_post_meta(get_the_ID(), "_cmb_instructions", true) ) { 
					$instructions = '<p>' . get_post_meta(get_the_ID(), "_cmb_instructions", true) . '</p>';
				} else {
					$instructions = term_description( '157', 'recommendation_type' );
				}

		$_gdc_email_body .=
		'<tr><td><hr><h2>Eye Treatment:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink  .
		'">'
		. $prodimage .
		'</a><h3><a href="'
		. $permalink  .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink  .
		'">'
		. the_title("", "", false)  .
		'</a></h3><br><p>'
		. $prodexcerpt .
		'</p><h4 style="margin-top:30px; margin-bottom:10px;">Instructions for use:</h4>'
		. $instructions .
		'</td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';


		endwhile;



		$_gdc_email_body .='</table>';





// SAMPLES PLEASE
		if ($_gdc_samples === 'yes'){

$_gdc_email_body .='<div style="padding:15px; background:#d47d7d;">';
		$_gdc_email_body .='<p>Sample are not always available for every product. Any that we have available will be posted to you at the following address:</p>';

		$_gdc_email_body .='' . $_gdc_address1  . '<br>';
		$_gdc_email_body .='' . $_gdc_address2  . '<br>';
		$_gdc_email_body .='' . $_gdc_address3  . '<br>';
		$_gdc_email_body .='' . $_gdc_address4  . '<br>';
		$_gdc_email_body .='' . $_gdc_address5  . '<br>';
		$_gdc_email_body .='<br>';
		$_gdc_email_body .='<p>If this address is incorrect, please call us on <strong>0845 600 0203</strong>, email us on <a href="mailto:info@germaine-de-capuccini.co.uk">info@germaine-de-capuccini.co.uk</a> or <a href="https://germaine-de-capuccini.co.uk/contact-us/">contact us here</a>.</p><br>';
$_gdc_email_body .='</div>';

		}


// NO SAMPLES THANKS
		else{
		}




$_gdc_email_body .='<br><br><hr><br><h2>Something Extra...</h2><br>';







// FEMALE EXTRAS
		if ($_gdc_sex === 'female'){

$_gdc_email_body .='<p>In addition to this essential routine, you should exfoliate your skin to remove dead skin cells. This helps to reduce congestion and aids penetration of products into your skin.</p>';
$_gdc_email_body .='<p>We offer two exfoliator options:</p><br>';


$permalink365 = get_permalink( '18' );
$prodimage365 = get_the_post_thumbnail( '18', '200sq' );
$title365 = get_the_title('18');
$permalinkfacialex = get_permalink( '1088' );
$prodimagefacialex = get_the_post_thumbnail( '1088', '200sq' );
$titlefacialex = get_the_title('1088');


	$_gdc_email_body .=
		'<table><tr><td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><h2>Exfoliator Options:</h2></td></tr><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalink365  .
		'">'
		. $prodimage365 .
		'</a><h3><a href="'
		. $permalink365 .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalink365 .
		'">'
		. $title365  .
		'</a></h3><br><p></p><p>Can be used daily with a few drops of warm water, this foams up and exfoliates extremely gently, it’s so gentle you can use it 365 days of the year – hence its name!</p></td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';



	$_gdc_email_body .=
		'<table><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalinkfacialex  .
		'">'
		. $prodimagefacialex .
		'</a><h3><a href="'
		. $permalinkfacialex .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalinkfacialex .
		'">'
		. $titlefacialex  .
		'</a></h3><br><p></p><p>A more ‘granular’ feel, extremely fresh and with menthol – leaves your skin feeling incredibly fresh! (for normal/dry skin use once a week, and for combination / oily skin use once every 10/14 days only)</p></td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';

	$_gdc_email_body .='</table>';


		}


// MALE EXTRAS
		else{

		$_gdc_email_body .='<p>We also offer a shaving range, formulated especially for skin which is often aggravated by daily shaving. The gentlemen customers who use these products report a closer shave, a more comfortable shave and great feeling skin afterwards!</p>';


$permalinkcool = get_permalink( '1009' );
$prodimagecool = get_the_post_thumbnail( '1009', '200sq' );
$titlecool = get_the_title('1009');
$permalinksupreme = get_permalink( '1029' );
$prodimagesupreme = get_the_post_thumbnail( '1029', '200sq' );
$titlesupreme = get_the_title('1029');
$permalinkfinishave = get_permalink( '1011' );
$prodimagefinishave = get_the_post_thumbnail( '1011', '200sq' );
$titlefinishave = get_the_title('1011');



	$_gdc_email_body .=
		'<table><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalinkcool  .
		'">'
		. $prodimagecool .
		'</a><h3><a href="'
		. $permalinkcool .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalinkcool .
		'">'
		. $titlecool  .
		'</a></h3><br><p></p><p>Use before shaving up to twice a week, for a smooth, and close shave</p></td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';



	$_gdc_email_body .=
		'<table><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalinksupreme  .
		'">'
		. $prodimagesupreme .
		'</a><h3><a href="'
		. $permalinksupreme .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalinksupreme .
		'">'
		. $titlesupreme  .
		'</a></h3><br><p></p><p>An extra rich cream allowing for a smooth and close glide of the razor</p></td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';


		$_gdc_email_body .=
		'<table><tr><td height="5" colspan="3">&nbsp;</td></tr><tr><td align="center" valign="top"><a href="'
		. $permalinkfinishave  .
		'">'
		. $prodimagefinishave .
		'</a><h3><a href="'
		. $permalinkfinishave .
		'">More Info</a></h3></td><td width="30" valign="top">&nbsp;</td><td width="450" valign="top"><h3><a href="'
		. $permalinkfinishave .
		'">'
		. $titlefinishave  .
		'</a></h3><br><p></p><p>To soothe, calm & refresh the skin</p></td></tr><tr><td height="40" colspan="3" align="center">&nbsp;</td></tr>';


	$_gdc_email_body .='</table>';



		}

		// SAMPLES PLEASE
		if ($_gdc_samples === 'yes'){
			$_gdc_email_body .='<h4 style="text-align:center;">Free samples of these are on their way to you along with your other samples</h4>';
		}


// NO SAMPLES THANKS
		else{
		}

?>