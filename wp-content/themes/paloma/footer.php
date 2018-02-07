<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paloma
 */

?>

	</div><!-- #content -->
	<?php do_action('stnsvn_before_prefooter'); ?>
</div><!-- #page -->
	<?php get_template_part( 'template-parts/footer', 'prefooter' ); ?>
	<?php get_template_part( 'template-parts/footer', 'widgets' ); ?>

<?php wp_footer(); ?>

</body>
</html>
