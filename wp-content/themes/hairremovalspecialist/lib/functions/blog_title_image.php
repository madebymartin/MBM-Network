<?php
 
function childtheme_override_blogtitle() {
?>
<div id="blog-title">
	<span>
		<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
			<img src="<?php bloginfo('stylesheet_directory') ?>/images/logo.png" alt="<?php bloginfo('name') ?>" />
		</a>
	</span>
</div>
<?php
}
?>