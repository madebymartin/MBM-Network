<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _s
 */
?>
<div class="restrict-width">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
		$current_user = wp_get_current_user();
		echo '<h1>Hi ' . $current_user->display_name . ' <span class="small">(not you? - <a href="' . wp_logout_url( get_permalink() ) . '">logout</a>)</span></h1>';
		echo '<p>Welcome to the Regene trade customer support area. Here you can find a wealth of resources to support you in your journey to success with Regene.</p>';

		?>
		<footer class="entry-footer">
			
				
			
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>
