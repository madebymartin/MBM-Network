<?php
/**
 * Template part for displaying header nav menu/icons
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

		<?php //Add anchor for sticky mobile nav ?>
		<span id="sticky-mobile-anchor"></span>

		<?php $sticky_primary_menu = get_theme_mod('sticky_primary_menu', 1); ?>
		<div class="upper-nav-container nav-transparent <?php if($sticky_primary_menu == 1){echo 'stick';} ?>">

			<?php //Display social icons
				$stnsvn_social_location = get_theme_mod('stnsvn_social_location', 1);

				if ($stnsvn_social_location == 1) { ?>
					<span class="header-icons social-icons-left">
    					<?php get_template_part( 'template-parts/content', 'social' ); ?>
    				</span>
    			<?php }
    		?>

	    	<?php if ( has_nav_menu( 'primary' ) ) { //Display nav only if set 
				?>


						<nav id="primary-nav" class="primary-nav" role="navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'paloma' ); ?></button>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</nav><!-- #primary-nav -->

				<?php } //end nav conditional
			?>

			<span class="navbar-right">
				<?php //Display search form if enabled
					$nav_search_form = get_theme_mod('nav_search_form', '1');
					if ($nav_search_form == '1') { ?>

						<span class="header-icons search-form">

							<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
							    <label>
							        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
							        <input type="search" class="search-field"
							            placeholder="&#xF002;"
							            name="s"
							            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
							    </label>
							    <input type="submit" class="search-submit"
							        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
							</form>

						</span>

					<?php }
				?>

				<?php //Display WC cart icon if enabled
					$stnsvn_cart_display = get_theme_mod('stnsvn_cart_display', 1);
					if (class_exists( 'WooCommerce' ) && ($stnsvn_cart_display != 0)){ ?>
						<span class="header-icons cart-icon">
							<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
									
									<?php //displays the shopping bag icon svg ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="12.4" height="16.3" viewBox="0 0 12.4 16.3">
									  <path d="M9.7 4.7V3.5C9.7 1.6 8.1 0 6.2 0S2.7 1.6 2.7 3.5v1.2H0v11.6h12.4V4.7H9.7zm-1.6 0H4.3V3.4c0-1 .8-1.9 1.9-1.9s1.9.8 1.9 1.9v1.3z" class="st0"/>
									</svg>

								<?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
							</a>
						</span>
					<?php } 
				?>
			</span>

		</div><!-- #site-navigation -->