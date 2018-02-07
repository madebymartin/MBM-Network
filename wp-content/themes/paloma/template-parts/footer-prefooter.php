<?php
/**
 * @package paloma
 * 
 */

//Display full-width-footer if active
	 if ( is_active_sidebar( 'newsletter-footer' ) || is_active_sidebar( 'instagram-footer' ) ) : ?>
				<div id="prefooter" class="clear prefooter widget-area" role="complementary">

					<?php if ( is_active_sidebar( 'instagram-footer' )) { ?>
						<div class="prefooter-section" id="prefooter-ig">
							<?php dynamic_sidebar( 'instagram-footer' ); ?>
						</div>
					<?php } ?>

					<?php if ( is_active_sidebar( 'newsletter-footer' )) { ?>
						<div class="prefooter-section" id="prefooter-news">
							<?php dynamic_sidebar( 'newsletter-footer' ); ?>
						</div>
					<?php } ?>

				</div><!-- #full-width-footer -->
			<?php endif; ?>

