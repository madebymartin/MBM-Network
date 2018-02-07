<?php
/**
 * @package paloma
 * Inspired by Make theme: https://github.com/thethemefoundry/make/blob/master/src/partials/footer-layout.php
 */

// Footer Options
$sidebar_count = (int) get_theme_mod( 'footer_col_number', 0 );

// Test for enabled sidebars that contain widgets
$has_active_sidebar = false;
if ( $sidebar_count > 0 ) {
	$i = 1;
	while ( $i <= $sidebar_count ) {
		if ( is_active_sidebar( 'footer-' . $i ) ) {
			$has_active_sidebar = true;
			break;
		}
		$i++;
	}
}?>

<footer id="colophon" class="site-footer" role="contentinfo">
		<?php // Footer widget areas
		if ( true === $has_active_sidebar ) : ?>
		<div class="footer-widgets columns-<?php echo esc_attr( $sidebar_count ); ?>">
			<?php
			$current_sidebar = 1;
			while ( $current_sidebar <= $sidebar_count ) :
				get_sidebar( 'footer-' . $current_sidebar );
				$current_sidebar++;
			endwhile; ?>
		</div>
		<?php endif; ?>

	<div class="clear site-info">
		<?php if ( has_nav_menu( 'footer' ) ) { //Display footer nav only if set ?>

			<nav id="footer-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
			</nav><!-- #footer-nav -->

		<?php } //end nav conditional ?>


	    <?php
		    $coastal_display_copyright = get_theme_mod( 'copyright-footer' );
		    $coastal_stnsvn_credit = get_theme_mod( 'stnsvn-credit' );
		    if ( $coastal_display_copyright == '' ) {
		        echo '<h4 class="site-copyright">' , __('Copyright ' , 'paloma') , date("Y ") , bloginfo("name");
		        }
		    else { 
		        echo '<h4 class="site-copyright">' , get_theme_mod( 'copyright-footer' ) ; 
		        }
		    if ( $coastal_stnsvn_credit == '') {
		    echo  '<span id="stnsvn-credit"> | ' , __('Site design by ', 'paloma') , '<a href="http://stnsvn.com" target="_blank">Station Seven</a></span></h4>';
		    } else {
		    echo '</h4>'; //Close footer h4 tag
		    }
	    ?>
    </div><!-- .site-info -->

</footer><!-- #colophon -->
