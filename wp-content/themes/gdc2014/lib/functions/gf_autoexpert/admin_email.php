<?php

global $mbm_coupon_post_id;
global $recommendation_post_id;
global $_gdc_sex;

// Email Content:
		$_gdc_email_body = ""; //initialize your variable

		$siteurl = get_bloginfo('url');
		$_gdc_rec_link = esc_html($siteurl . '/?gf_pdf=1&fid=20&lid=' . $entry['id'] . '&template=skincare-expert-template.php');
		$gdc_coupon_all_meta = get_post_meta( $mbm_coupon_post_id );
		$gdc_coupon_expiry = $gdc_coupon_all_meta['expiry_date']['0'];

		$_gdc_email_body .= '<a href="' . $_gdc_rec_link . '"><p style="display:block; background:#330066; padding:20px 14px; text-transform:uppercase; text-align:center; text-decoration:none; font-weight:bold; color:#fff; font-size:18px;">Print covering letter</p></a>';
		$_gdc_email_body .='<a href="' . get_permalink( $recommendation_post_id ) . '">Recommendation Page</a><br><br>';
		

		$_gdc_email_body .='<br><br>' . $_gdc_fname  . ' ' . $_gdc_sname  .'<br>';
		$_gdc_email_body .='' . $_gdc_address1  . '<br>';
		$_gdc_email_body .='' . $_gdc_address2  . '<br>';
		$_gdc_email_body .='' . $_gdc_address3  . '<br>';
		$_gdc_email_body .='' . $_gdc_address4  . '<br>';
		$_gdc_email_body .='' . $_gdc_address5  . '<br>';

		$_gdc_email_body .='Email: ' . $_gdc_email  . '<br><br>';
		$_gdc_email_body .='Skin Type: ' . $_gdc_skintype  . '<br>';
		$_gdc_email_body .='Main Skin Concern: ' . $_gdc_concern  . '<br>';
		$_gdc_email_body .='Sensitivity: ' . $_gdc_sensitivity  . '<br>';
		$_gdc_email_body .='Age Group: ' . $_gdc_age  . '<br>';
		$_gdc_email_body .= '<br><br>COUPON CODE FOR 20% DISCOUNT: <b>' . get_the_title( $mbm_coupon_post_id ) . '</b>';
		$_gdc_email_body .= '<br>Coupon Expires: <b>' . $gdc_coupon_expiry . '</b>';

// PERSONALISED ROUTINE
		$_gdc_email_body .='<hr><br><ol style="margin-top:40px;">';


		// Cleanser Loop
		while ( $_gdc_cleanserloop->have_posts() ) : $_gdc_cleanserloop->the_post();
			$post_id = get_the_ID();
			$prod = new WC_Product( $post_id );
			$permalink = get_permalink( );
			$prodimage = get_the_post_thumbnail( $post_id, '200sq' );

			$_gdc_email_body .= '<li>Cleanser: <a href="' . $permalink  . '">(' . $prod->get_sku() . ') ' . get_the_title( get_the_id() ) . '<br></a></li>';
		endwhile;

		// Toner Loop
		while ( $_gdc_tonerloop->have_posts() ) : $_gdc_tonerloop->the_post();
			$post_id = get_the_ID();
			$prod = new WC_Product( $post_id );
			$permalink = get_permalink( );
			$prodimage = get_the_post_thumbnail( $post_id, '200sq' );

			$_gdc_email_body .= '<li>Toner: <a href="' . $permalink  . '">(' . $prod->get_sku() . ') ' . get_the_title( get_the_id() ) . '<br></a></li>';
		endwhile;

		// Daily Treatment Loop
		while ( $_gdc_dailytreatmentloop->have_posts() ) : $_gdc_dailytreatmentloop->the_post();
			$post_id = get_the_ID();
			$prod = new WC_Product( $post_id );
			$permalink = get_permalink( );
			$prodimage = get_the_post_thumbnail( $post_id, '200sq' );

			$_gdc_email_body .= '<li>Daily Treatment: <a href="' . $permalink  . '">(' . $prod->get_sku() . ') ' . get_the_title( get_the_id() ) . '<br></a></li>';
		endwhile;

		// Eye Treatment Loop
		while ( $_gdc_eyetreatmentloop->have_posts() ) : $_gdc_eyetreatmentloop->the_post();
			$post_id = get_the_ID();
			$prod = new WC_Product( $post_id );
			$permalink = get_permalink( );
			$prodimage = get_the_post_thumbnail( $post_id, '200sq' );

			$_gdc_email_body .= '<li>Eye Treatment: <a href="' . $permalink  . '">(' . $prod->get_sku() . ') ' . get_the_title( get_the_id() ) . '<br></a></li>';
		endwhile;

// FEMALE EXTRAS
		if ($_gdc_sex === 'female'){
		$permalink365 = get_permalink( '18' );
		$prodimage365 = get_the_post_thumbnail( '18', '200sq' );
		$title365 = get_the_title('18');
		$permalinkfacialex = get_permalink( '1088' );
		$prodimagefacialex = get_the_post_thumbnail( '1088', '200sq' );
		$titlefacialex = get_the_title('1088');
		$_gdc_email_body .= '<li>Extra: <a href="' . $permalink365 . '">(EXR007) ' . $title365 . '</a></li>';
		$_gdc_email_body .= '<li>Extra: <a href="' . $permalinkfacialex . '">(OPR007) ' . $titlefacialex . '</a></li>';
		}

// MALE EXTRAS
		else{
		$permalinkcool = get_permalink( '1009' );
		$titlecool = get_the_title('1009');
		$permalinksupreme = get_permalink( '1029' );
		$titlesupreme = get_the_title('1029');
		$permalinkfinishave = get_permalink( '1011' );
		$titlefinishave = get_the_title('1011');
		$_gdc_email_body .= '<li>Extra: <a href="' . $permalinkcool . '">(MER001) ' . $titlecool . '</a></li>';
		$_gdc_email_body .= '<li>Extra: <a href="' . $permalinksupreme . '">(MER002) ' . $titlesupreme . '</a></li>';
		$_gdc_email_body .= '<li>Extra: <a href="' . $permalinkfinishave . '">(MER014) ' . $titlefinishave . '</a></li>';
		}

	$_gdc_email_body .='</ol>';
?>