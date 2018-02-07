<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Totally UK
 */
?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php echo 'Copyright ' . current_time( 'Y', $gmt = 1 ) . ' Totally UK Ltd. Spelthorne Lane, Ashford, Middlesex TW15 1UX  |  +44(0) 1784 259988'; ?>
			 
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
