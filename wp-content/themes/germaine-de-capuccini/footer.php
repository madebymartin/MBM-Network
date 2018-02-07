<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Germaine_de_Capuccini
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<aside id="footer-widgets" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		</aside>



		<div class="site-info">
		<?php
			mbm_copyright();
		?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->





<?php wp_footer(); ?>

</body>
</html>
