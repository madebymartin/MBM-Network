<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

		<div id="container">

			<?php thematic_abovecontent(); 
?>

			<div id="content">

	            <?php

	            // calling the widget area 'page-top'
	            get_sidebar('page-top');

	            the_post();

	            thematic_abovepost();

	            ?>

				<div id="post-<?php the_ID();
					echo '" ';
					if (!(THEMATIC_COMPATIBLE_POST_CLASS)) {
						post_class();
						echo '>';
					} else {
						echo 'class="';
						thematic_post_class();
						echo '">';
					}

	                // creating the post header
	                thematic_postheader();

	                ?>

				<?php if ( has_post_thumbnail() ) { ?>
				<div class="banner"><?php the_post_thumbnail('banner'); ?></div>

				<?php } else{ ?>
				<?php } ?>


					<div class="entry-content">

	                    <?php

	                    the_content();

	                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');

	                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>

<?php
// Add pages you'd like to exclude in the exclude here
wp_list_pages(
  array(
    'exclude' => '',
    'title_li' => '',
  )
);
?>
</ul>

<?php
foreach( get_post_types( array(

'public' => true) ) as $post_type ) {
  if ( in_array( $post_type, array('post','page','attachment') ) )
    continue;

  $pt = get_post_type_object( $post_type );

  echo '<br><br><h4 class="textalignleft">'.$pt->labels->name.'</h4>';
  echo '<ul>';

  query_posts('post_type='.$post_type.'&posts_per_page=-1');
  while( have_posts() ) {
    the_post();
    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
  }

  echo '</ul>';
}
?>
					
</div><!-- .entry-content -->
				</div><!-- #post -->

	        <?php

	        thematic_belowpost();

	        get_sidebar('page-bottom');

	        ?>

			</div><!-- #content -->

			<?php thematic_belowcontent(); ?>

		</div><!-- #container -->

<?php

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar
    thematic_sidebar();

    // calling footer.php
    get_footer();

?>