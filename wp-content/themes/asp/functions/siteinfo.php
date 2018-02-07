<?php 
function childtheme_override_siteinfo() { 

	echo 'Copyright &copy; ' . date('Y') . ' ' . get_bloginfo( 'name') . '  |  Spelthorne Lane, Ashford Common, Ashford, Surrey TW15 1UX  |  0845 094 9460<br>';

	global $current_user;
	get_currentuserinfo();
	if (!(is_user_logged_in())) { 
		//silence
	} elseif ( (($current_user->user_login) == "admin") ) {

	} else { ?>
		<br><br><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
	<?php } ?>
<?php }