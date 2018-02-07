<?php
/**
 * The template for displaying all single posts.
 *
 * @package Martin Stevens
 */

$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
//$imgurl = wp_get_attachment_thumb_url( $post_thumbnail_id );
$imgurl = wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0];

?>
		<div id="hero-wrapper">
		    <div id="hero" style="background-image: url('<?php echo $imgurl; ?>');"></div>
		</div>

<?php
get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php 


			//the_post_navigation(); 


			/**
 *  Infinite next and previous post looping in WordPress
 */  
if( get_adjacent_post(false, '', false) ) { 
	next_post_link('%link', 'PREVIOUS &#9668;');
} else { 
	$last = new WP_Query('posts_per_page=1&order=ASC&post_type=project'); $last->the_post();
    	echo '<a href="' . get_permalink() . '">PREVIOUS &#9668;</a>';
    wp_reset_query();
}; 
if( get_adjacent_post(false, '', true) ) { 
	previous_post_link('%link', '&#9658; NEXT');
} else { 
    $first = new WP_Query('posts_per_page=1&order=DESC&post_type=project'); $first->the_post();
    	echo '<a href="' . get_permalink() . '">&#9658; NEXT</a>';
  	wp_reset_query();
}; 


?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
