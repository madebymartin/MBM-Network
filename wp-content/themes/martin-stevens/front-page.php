<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Martin Stevens
 */

?>
		<div id="hero-wrapper">
		    <div id="hero">
		    	<div class="hero-text">
		            <h1>Martin Stevens</h1>
		            <h2>Creative Soul</h2>
		            <a class="btn0 begin" href="#">&#9660;</a>
		        </div>
		        <!--<a class="material-btn btn0 waves-button waves-effect waves-color"><i class="fa fa-chevron-down"></i></a>-->
		    </div>

		</div>
<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php
		$projects = new WP_Query( array(
			'post_type' => 'project',
			'posts_per_page' => '-1',
			'status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
		));
		if($projects->have_posts() ){


			echo '<div id="projects">';

					while ( $projects->have_posts() ) : $projects->the_post();
						$id = get_the_id();
						$link = get_permalink( $id );
						$img = get_the_post_thumbnail( $id, 'banner' );
						$title = get_the_title($id);

						echo'<a href="' . $link . '"><div class="project project-small">
						  <div class="overlay">
						      <h3>' . $title . '</h3>
						      <h4>Heading Four</h4>
						  </div>
						  ' . $img . '
						</div></a>';
						// edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link">' , '</span>' . "\n" );
					endwhile;

			echo '</div>';

		}
		wp_reset_query();

			/*while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; // End of the loop. */
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
//get_sidebar(); 
get_footer(); 
?>
