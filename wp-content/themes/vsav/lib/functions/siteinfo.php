<?php 
function childtheme_override_siteinfo() { 
		$clients_loop = new WP_Query( array(
	'post_type' => 'client',
	'posts_per_page' => '-1',
	'orderby' => 'rand',
	'order' => 'DESC'
	) );
	if ( $clients_loop->have_posts() ):
		echo'<h5>Our clients include...</h5>';
		while ( $clients_loop->have_posts() ) : $clients_loop->the_post(); 
			if (MultiPostThumbnails::has_post_thumbnail('client', 'logo')) { 
				$logo_url = MultiPostThumbnails::get_post_thumbnail_url('client', 'logo', NULL,  'medium', array('class' => 'footerlogo')); 
				echo '<div class=footerlogo><span class="helper"></span><img src="' . $logo_url . '" /></div>';
			}
		endwhile;
	endif;





	echo '<div class="clearfix"></div><br>Copyright &copy; ' . date('Y') . ' ' . get_bloginfo( 'name') . '<br>';

	global $current_user;
	get_currentuserinfo();
	if (!(is_user_logged_in())) { 
		//silence
	} elseif ( (($current_user->user_login) == "admin") ) {

	} else { ?>
		<br><br><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
	<?php } ?>
<?php }