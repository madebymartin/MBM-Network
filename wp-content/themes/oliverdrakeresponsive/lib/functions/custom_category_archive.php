<?php
		// CUSTOM Category Archives
			function childtheme_override_category_archives() { ?>
						<li id="category-archives" class="content-column">
							<h2><?php _e('Archives by Category', 'thematic') ?></h2>
							<ul>
								<?php wp_list_categories('optioncount=1&feed=RSS&title_li=&show_count=1') ?> 
							</ul>
						</li>
		<?php }
		// end category_archives
		
		add_action('thematic_archives', 'childtheme_override_category_archives', 3);

?>