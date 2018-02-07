<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _s
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">


		<?php
		$query_args = array( 
			'post_type' => 'certificate', 
			'posts_per_page' => -1, 
			'orderby' => 'date', 
			'order' => 'DESC',
		); 
		$certs_loop = new WP_Query( $query_args );
		if ( $certs_loop->have_posts() ) {
			echo '<div class="certificates">';
			while( $certs_loop->have_posts() ) : $certs_loop->the_post();
				$cert_pdf_url = get_post_meta(get_the_ID(), 'mbm_cert_pdf', true);
				$cert_img_url = get_post_meta(get_the_ID(), 'mbm_cert_img', true);
				$title = get_the_title(get_the_ID());
				echo '<a class="certificate" target="blank" title="' . $title . '" href="' . $cert_pdf_url . '"><img src="' . $cert_img_url . '" alt="'. $title .'"></a>';
			endwhile;
			echo '</div>';
		}
		wp_reset_postdata();
		?>
		<div class="site-info">
		<?php 
		if(date('Y') > '2015'){ $copyright_dates = '2015-' . date('Y'); }else{ $copyright_dates = date('Y'); }
		echo 'Copyright &copy; ' . $copyright_dates . ' Asbestos Solution Providers<br><small>THIS WEBSITE CONTAINS PUBLIC SECTOR INFORMATION PUBLISHED BY THE HEALTH AND SAFETY EXECUTIVE AND LICENSED UNDER THE OPEN GOVERNMENT LICENCE.</small>'; 
		?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script> var polyfilter_scriptpath = '/js/'; </script>
</body>
</html>
