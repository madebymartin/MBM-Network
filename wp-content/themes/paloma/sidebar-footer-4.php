<?php
/**
 * @package paloma
 */

/**
 * Filter the sidebar ID to allow developers to programmatically change the sidebar displayed.
 *
 * @since 1.0.0
 *
 * @param string    $footer_id    The ID of the current footer being generated.
 *
 * Inspired by Make theme: https://github.com/thethemefoundry/make/tree/master/src
 */
$sidebar_id = apply_filters( 'paloma_footer_4', 'footer-4' );
$sidebar_id = esc_attr( $sidebar_id );
?>
<section id="footer-4" class="widget-area <?php echo $sidebar_id; ?> <?php echo ( is_active_sidebar( $sidebar_id ) ) ? 'active' : 'inactive'; ?>" role="complementary">
	<?php if ( ! dynamic_sidebar( $sidebar_id ) ) : ?>
		&nbsp;
	<?php endif; ?>
</section>