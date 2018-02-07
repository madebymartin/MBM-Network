<?php
/**
 * The template for displaying all single posts.
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"><div class="restrict-width">

		<?php while ( have_posts() ) : the_post(); 

			$member_role = get_post_meta( get_the_ID(), 'mbm_member_role', true );
			$member_subtitle = get_post_meta( get_the_ID(), 'mbm_member_subtitle', true );
			$member_content = get_post_meta( get_the_ID(), 'mbm_member_content', true );
			$member_bullets = get_post_meta( get_the_ID(), 'mbm_member_bullet', true );
			$member_email = get_post_meta( get_the_ID(), 'mbm_member_email', true );
			$blurb = get_post_meta( get_the_ID(), 'mbm_member_blurb', true );


			// echo '<li>';
				echo '<h2 class="center red">' . get_the_title() . '<br><span class="gray role">(' . $member_role  . ')</span></h2>';
				// echo '<em>' . $member_subtitle . '</em><br>';
				$imgurl = get_the_post_thumbnail_url(get_the_ID());
				echo '<div class="circle" style="background-image:url('. $imgurl .')"></div>';
					// the_post_thumbnail( );
				
				echo '<div class="blurb">' . $blurb . '</div>';
				echo '<ul class="expertise">';
					foreach ( $member_bullets as $member_bullet ){
						echo '<li>' . $member_bullet . '</li>';
					}
				echo '</ul>';
			// echo'</li>' ;


			// get_template_part( 'content', 'single' ); 
			?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</div></main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
