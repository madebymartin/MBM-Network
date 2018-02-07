<?php

if(get_post_meta(get_the_ID(), 'mbm_rows', true)){
	$rows = get_post_meta(get_the_ID(), 'mbm_rows', true);
	foreach ($rows as $key => $row) {
		$article_class = $row['width'];
		echo '<div class="pagerow">';
			echo '<article class="'. $article_class .'">';
				echo $row['content'];
			echo '</article>';
		echo '</div>';
	}
	
}


if(is_page('contact')){
	echo '<div class="pagerow">';
				echo'<iframe style="width:100%;" id="base-location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2520.0996077893174!2d-0.1706246842548505!3d50.82931887952945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48758546854bf015%3A0x561b85ebcb5fce48!2s30+The+Drive%2C+Hove+BN3+3JD!5e0!3m2!1sen!2suk!4v1517242493343" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>';
		echo '</div>';

}





if ( is_active_sidebar( 'footer' ) ){
	echo '<div class="pagerow"><article>';
		dynamic_sidebar( 'footer' );
	echo '</article></div>';
} 
?>