<?php 
function childtheme_override_siteinfo() { 
	?>

	Copyright &#64; <?php echo date('Y'); ?> <?php bloginfo( 'name'); ?><br>Celebrating 50 Years of spa and skincare excellence<br><br><br>
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/gdc-50years.png" alt="Germaine de Capuccini 50 Years" style="width:90px; height:auto;">

	<?php 
	global $current_user;
	get_currentuserinfo();
	if (!(is_user_logged_in())) { 
		//silence
	} elseif ( (($current_user->user_login) == "admin") ) {

	} else { ?>
		<br><br><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
	<?php } ?>
<?php }