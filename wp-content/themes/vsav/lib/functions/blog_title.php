<?php
// CUSTOM BLOG TITLE - HOMEPAGE LINK (LOGO)
function childtheme_override_blogtitle() {
	if (is_page('production')){ ?>
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
	    <div id="logo">
			<div id="symbol-grey"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="symbol-green"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-red.png"></div>
			<div id="logo-text"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_logo_text_production.png"></div>
		</div>
	</a>

	<?php } elseif (is_page('events')){ ?>
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
	    <div id="logo">
			<div id="symbol-grey"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="symbol-green"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-green.png"></div>
			<div id="logo-text"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_logo_text_events.png"></div>
		</div>
	</a>
	<?php } elseif (is_page('installations')){ ?>
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
	    <div id="logo">
			<div id="symbol-grey"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="symbol-green"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-blue.png"></div>
			<div id="logo-text"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_logo_text_installations.png"></div>
		</div>
	</a>
	<?php } elseif (is_page('equipment-hire')){ ?>
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
	    <div id="logo">
			<div id="symbol-grey"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="symbol-green"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-white.png"></div>
			<div id="logo-text"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_logo_text_equipment_hire.png"></div>
		</div>
	</a>
	<?php } elseif (is_page('education')){ ?>
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
	    <div id="logo">
			<div id="symbol-grey"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="symbol-green"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-yellow.png"></div>
			<div id="logo-text"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_logo_text_education.png"></div>
		</div>
	</a>
	<?php }




	else { // ANY OTHER PAGE
		?>
	<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
	    <div id="logo">
			<div id="symbol-grey"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="symbol-green"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_symbol-grey.png"></div>
			<div id="logo-text"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vsav_logo_text.png"></div>
		</div>
	</a>

	<?php }
?>

<?php } ?>