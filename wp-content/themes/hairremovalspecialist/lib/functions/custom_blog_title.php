<?php

function childtheme_override_blogtitle() {
?>
<div id="blog-title">
		<a href="<?php echo home_url() ?>/" title="<?php bloginfo('name') ?>" rel="home">
			<h1><span><?php echo bloginfo('description') ?>:</span>
			<?php echo bloginfo('name') ?>
			</h1>
		</a>

</div>
<?php
}
?>