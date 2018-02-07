<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _s
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 

		// SHOW LOGIN FORM
		$path = get_permalink();
		$args = array(
		'echo' => true,
		'redirect' => $path,
		'form_id' => 'tradeloginform',
		'label_username' => __( 'Username' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in' => __( 'Log In' ),
		'id_username' => 'user_login',
		'id_password' => 'user_pass',
		'id_remember' => 'rememberme',
		'id_submit' => 'wp-submit',
		'remember' => true,
		'value_username' => NULL,
		'value_remember' => true );

		echo '<div class="restrict-width padding-medium" id="trade-login">';
				echo'<h2 class="section-heading">Existing Customer support</h2>';
				wp_login_form( $args );
				echo '<div class="center"><a class="lostpassword" href="' . wp_lostpassword_url( get_permalink() ) . '" title="Lost Password">Lost Password</a>  |  <a href="' . get_permalink('113') . '">Existing Customers register here</a></div>';
		echo '</div>';

	?>
	<footer class="entry-footer">
		<div class="restrict-width">
			
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
