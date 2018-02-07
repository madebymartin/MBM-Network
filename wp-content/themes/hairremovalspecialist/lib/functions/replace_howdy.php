<?php
function md_replace_howdy( $text ) {
	$text = str_replace( 'Howdy', 'Welcome back', $text );

	return $text;
}
add_filter( 'gettext', 'md_replace_howdy' );
?>