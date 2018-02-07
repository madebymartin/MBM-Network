<?php
// Email Content:
		$_gdc_email_body = ""; //initialize your variable
		$_gdc_email_body .='<h3 style="margin-bottom:20px;">Please send samples of the following products to:</h3>';
		$_gdc_email_body .='' . $_gdc_fname  . ' ' . $_gdc_sname  .'<br>';
		$_gdc_email_body .='' . $_gdc_address1  . '<br>';
		$_gdc_email_body .='' . $_gdc_address2  . '<br>';
		$_gdc_email_body .='' . $_gdc_address3  . '<br>';
		$_gdc_email_body .='' . $_gdc_address4  . '<br>';
		$_gdc_email_body .='' . $_gdc_address5  . '<br><br>';

		$_gdc_email_body .='Email: ' . $_gdc_email  . '<br><br>';
		$_gdc_email_body .='Skin Type: ' . $_gdc_skintype  . '<br>';
		$_gdc_email_body .='Main Skin Concern: ' . $_gdc_concern  . '<br>';
		$_gdc_email_body .='Sensitivity: ' . $_gdc_sensitivity  . '<br>';
		$_gdc_email_body .='Age Group: ' . $_gdc_age  . '<br>';

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

global $_gdc_sex;

// WOMENS EXTRAS
		if ($_gdc_sex === 'female'){
		$permalink365 = get_permalink( '18' );
		$title365 = get_the_title('18');
		$permalinkfacialex = get_permalink( '1088' );
		$titlefacialex = get_the_title('1088');

		$_gdc_email_body .= '<li>EXR007: <a href="' . $permalink365 . '">' . $title365 . '</a></li>';
		$_gdc_email_body .= '<li>OPR007: <a href="' . $permalinkfacialex . '">' . $titlefacialex . '</a></li>';

// MENS EXTRAS
		}
		else{
		$permalinkcool = get_permalink( '1009' );
		$titlecool = get_the_title('1009');
		$permalinksupreme = get_permalink( '1029' );
		$titlesupreme = get_the_title('1029');
		$permalinkfinishave = get_permalink( '1011' );
		$titlefinishave = get_the_title('1011');

		$_gdc_email_body .= '<li>MER001: <a href="' . $permalinkcool . '">' . $titlecool . '</a></li>';
		$_gdc_email_body .= '<li>MER002: <a href="' . $permalinksupreme . '">' . $titlesupreme . '</a></li>';
		$_gdc_email_body .= '<li>MER014: <a href="' . $permalinkfinishave . '">' . $titlefinishave . '</a></li>';
		}


		$_gdc_email_body .='</ol>';

?>