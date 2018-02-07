<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Totally UK
 */

get_header(); ?>


<div class="se-pre-con"></div>
	<script>
	jQuery(window).load(function() {
		// Animate loader off screen
		jQuery(".se-pre-con").fadeOut("slow");;
	});
	</script>



	

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php //single_post_title(); ?></h1>
				</header>
			<?php endif; 

			$pageargs = array(
				'posts_per_page'   => -1,
				'orderby'          => 'date',
				'order'            => 'ASC',
				'exclude'          => '',
				//	IDs of all pages to include in nav..
				'include'          => array('118', '8', '13', '16', '18'),
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'page',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);
			$posts_array = get_posts( $pageargs );

			if(!empty($posts_array)){ ?>



				<div class="desktop">
					<nav id="nav-dots" class="nav-dots">
						<?php foreach( $posts_array as $post ){
							$page_id = $post->ID;
							$title = $post->post_title;
							echo '<span>' . $title . '</span>';
						}?>
					</nav>
					<div class="container demo-1">
			            <div id="slider" class="sl-slider-wrapper">
							<div class="sl-slider">

								<?php
								$count = 0;
								$last_key = end(array_keys($posts_array));
								foreach( $posts_array as $key=>$post ){
									$page_id = $post->ID;
									$title = $post->post_title;
									$content = $post->post_content;
									//$content = do_shortcode(wpautop( $content ));
									$content = wpautop( $content );
									$background_img_src = get_post_meta ( $page_id, '_cmb_background', true );
									$logoclass = get_post_meta ( $page_id, '_cmb_logowidth', true );
									$logomargin = get_post_meta ( $page_id, '_cmb_margin', true );
									$bg = get_post_meta ( $page_id, '_cmb_content_background', true );
									if($bg === 'on'){$bg=' bg-black';}else{$bg='';}
									$contentclass = $logomargin . '' . $bg;
									$linkurl = get_post_meta ( $page_id, '_cmb_url', true );
									$linktext = get_post_meta ( $page_id, '_cmb_buttontext', true );
									if( $linkurl ){ $cta = '<a target="blank" class="button" href="' . $linkurl . '">' . $linktext . '</a>'; }
									elseif($linktext){ $cta = '<div class="notice">' . $linktext . '</div>'; }
									else{$cta = '';}									
									echo '<div class="sl-slide bg-1" data-orientation="' . (++$count%2 ? "vertical" : "horizontal") . '" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">';
										echo '<div class="sl-slide-inner" style="background-image: url(' . $background_img_src . ')">';
											if ( has_post_thumbnail() ) { echo '<div class="deco width' . $logoclass . '">' . get_the_post_thumbnail ( $page_id, 'post-thumbnail' ) . '</div>'; }
											else { echo '<h2>' . $title . '</h2>'; }
											echo '<div class="brandcontent ' . $contentclass . '">' . $content  . '' . $cta;
											if ($key == $last_key) {
												echo gravity_form(1, false, false, false, '', true, 12);
											}else{}
											echo '</div>';
											//echo '<blockquote><p>You have just dined, and however scrupulously the slaughterhouse is concealed in the graceful distance of miles, there is complicity.</p><cite>Ralph Waldo Emerson</cite></blockquote>';
										echo '</div>';
									echo '</div>';
								}
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</div>





				<div class="mobile">
					<?php
					$count = 0;
					$last_key = end(array_keys($posts_array));
					foreach( $posts_array as $key=>$post ){
						$page_id = $post->ID;
						$title = $post->post_title;
						$lwrcs_title = strtolower($title);
						$section_id = str_replace ( " " , "-" , $lwrcs_title );
						$content = $post->post_content;
						$content = do_shortcode(wpautop( $content ));
						$background_img_src = get_post_meta ( $page_id, '_cmb_background', true );
						$logoclass = get_post_meta ( $page_id, '_cmb_logowidth', true );
						$logo = get_the_post_thumbnail ( $page_id, 'large' );
						$smalllogo = get_the_post_thumbnail ( $page_id, 'medium' );
						$logomargin = get_post_meta ( $page_id, '_cmb_margin', true );
						$bg = get_post_meta ( $page_id, '_cmb_content_background', true );
						if($bg === 'on'){$bg=' bg-black';}else{$bg='';}
						$contentclass = $logomargin . '' . $bg;
						$linkurl = get_post_meta ( $page_id, '_cmb_url', true );
						$linktext = get_post_meta ( $page_id, '_cmb_buttontext', true );
						if( $linkurl ){ $cta = '<a target="blank" class="button" href="' . $linkurl . '">' . $linktext . '</a>'; }
						elseif($linktext){ $cta = '<div class="notice">' . $linktext . '</div>'; }
						else{$cta = '';}
						echo '<div class="brand" id="' . $section_id . '" style="background-image: url(' . $background_img_src . ')">';
							if ( has_post_thumbnail() ) { echo '<div class="width' . $logoclass . '">' . $smalllogo . '</div>'; }
							else{ echo '<h2>' . $title . '</h2>'; }
							echo '<div class="brandcontent ' . $contentclass . '">' . $content  . '' . $cta . '</div>';
							if ($key == $last_key) { echo gravity_form(2, false, false, false, '', false); }else{echo '<div class="divider"></div>';}
						echo '</div>';
					}
					wp_reset_postdata();
					?>
				</div>
			<?php }
			/* Start the Loop */ 
			while ( have_posts() ) : the_post(); ?>
			</div><!-- /slider-wrapper -->
        </div>
		<?php endwhile;
		the_posts_navigation(); 
		else :
		//get_template_part( 'template-parts/content', 'none' ); 
		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
//get_sidebar();
get_footer(); 
?>