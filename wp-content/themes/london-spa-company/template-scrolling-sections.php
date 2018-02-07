<?php
/**
 * Template Name: Scrolling Content
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();



				$sections = get_post_meta(get_the_ID(), 'mbm_group_section_content', true);
				$sections_count = count($sections);

/*				echo '<div style="background:#333;position:fixed;top:40px;right:0;z-index:99999;">';
					foreach ($sections as $key => $section) {
						$heading = $section['mbm_group_section_heading'];
						$wording = $section['mbm_group_section_wording'];
						$image_id = $section['mbm_group_section_image_id'];
						$image_url = $section['mbm_group_section_image'];
						$bg_id = $section['mbm_group_section_wording_bkgnd_id'];
						$bg_url = $section['mbm_group_section_wording_bkgnd'];
						$section_number = $key + 1;
						//print_r($section);
					}
				echo '</div>';*/



				/*echo '<div style="background:#333;position:fixed;top:40px;right:0;z-index:99999;">';
				echo $sections_count;
				echo '</div>';
*/

				foreach ($sections as $key => $section) {
					$heading = $section['mbm_group_section_heading'];
					$headingtop = $section['mbm_group_heading_at_top'];
					$headingcrest = $section['mbm_group_heading_crest'];
					$wording = $section['mbm_group_section_wording'];
					$image_id = $section['mbm_group_section_image_id'];
					$image_url = $section['mbm_group_section_image'];
					$bg_id = $section['mbm_group_section_wording_bkgnd_id'];
					$bg_url = $section['mbm_group_section_wording_bkgnd'];
					$text_bg = $section['mbm_group_remove_text_bg'];

					$section_number = $key + 1;
					//print_r($section);

					if($section_number == 1){$heading_level = '1';}else{$heading_level = '2';}
					if($headingcrest == 'on'){ $headingclass = ' class="crest"';}else{ $headingclass = ''; }
					if($text_bg == 'on'){ $innerclass = '';}else{ $innerclass = ' solid'; }

					echo '<div class="section '. $section_number  .'" data-section-name="'. $section_number  .'">';
						
						echo '<div class="text" style="background-image:url('. $bg_url .'">';


							if( $headingtop =='on' ){
								echo '<div class="center-outer top">';
									echo '<div class="center-inner">';
										echo '<h'. $heading_level . $headingclass .'>'. $heading .'</h'. $heading_level .'>';
									echo '</div>';
								echo '</div>';
							}


							echo '<div class="center-outer bottom">';
								echo '<div class="center-inner'. $innerclass .'">';
									if( ! $headingtop =='on' ){ echo '<h'. $heading_level . $headingclass .'>'. $heading .'</h'. $heading_level .'>'; }
									echo wpautop($wording);
									if($sections_count > 1){
										if($sections_count == $section_number){$last = ' top';}else{$last = '';}
										echo '<button class="next'. $last .'"></button>';
									}

								echo '</div>';
							echo '</div>';





						echo '</div>'; // .text

						echo '<div class="sectionimg" style="background-image:url('. $image_url .')"></div>';

					echo '</div>';

				}



/*				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;*/

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
