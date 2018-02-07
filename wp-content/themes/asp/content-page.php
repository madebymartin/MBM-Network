<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _s
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 

	if(get_post_meta(get_the_ID(), 'mbm_hse', true) ){

		echo '<div class="restrict-width">';

		$main_download_id = get_post_meta(get_the_ID(), 'mbm_hse', true);
		$main_dl_url = get_post_meta($main_download_id, 'mbm_url', true);
		$main_dl_code = get_post_meta($main_download_id, 'mbm_code', true);
		$img_url = wp_get_attachment_url( get_post_thumbnail_id( $main_download_id ) );
		$all_other_dls = new WP_Query( array(
			'post_type' => 'hse_download',
			'posts_per_page' => '-1',
			'order' => 'DESC',
		    'fields' => 'ids',
		    'post__not_in' => array( $main_download_id ),
		    'meta_key'	=>	'mbm_code',
		    'orderby'	=> 'meta_value'
			) 
		);
		$all_other_dls_ids = $all_other_dls->posts;


		echo '<div class="cols cols6">';
		the_content();
		echo '</div>';

		echo '<div class="cols cols2"></div>
			<div class="cols cols4">
			<div class="side" style="padding: 1.5rem;">';

			echo '<h4>Free Download from HSE:</h4>';
			echo '<a target="blank" href="'. $main_dl_url .'"><img style="float: left; margin-right: 2rem; width: 60px; height: auto;" src="'. $img_url .'" alt="'. $main_dl_code .'" />'. $main_dl_code . ': ' . get_the_title($main_download_id) .'</a>';


			echo '<div class="clearfix"></div><hr style="margin-top: 0.5rem;" /><h4>Related Downloads:</h4><ul class="small">';

			foreach ($all_other_dls_ids as $id) {
				$dl_url = get_post_meta($id, 'mbm_url', true);
				$dl_code = get_post_meta($id, 'mbm_code', true);
				$dl_img_url = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
				echo '<li><a href="'. $dl_url .'">'. $dl_code .': '. get_the_title($id) .'</a></li>';
			}

			echo '</ul>
			</div>
			</div>';
		echo '</div>';
	}
	else{
		echo '<div class="restrict-width">';
			the_content();
		echo '</div>';
	}
	
		

	if(get_post_meta(get_the_ID(), 'mbm_hidden', true)){
		echo '<div class="restrict-width">';
			echo '<button class="button showmore" data-id="showhide">Show More</button><div class="clearfix"></div>';
			echo '<div id="showhide" class="more">';
			echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mbm_hidden', true));
			echo '<div class="clearfix"></div>';
			echo '</div>';
		echo '</div>';	
	}



	if(get_post_meta(get_the_ID(), 'mbm_group_reveal_group', true)){
		?>
		<script> var polyfilter_scriptpath = '/js/'; </script>
		<?php
		$boxes = get_post_meta(get_the_ID(), 'mbm_group_reveal_group', true);
		if(get_post_meta(get_the_ID(), 'mbm_group_transition', true)){ $transition_type = get_post_meta(get_the_ID(), 'mbm_group_transition', true); }else{ $transition_type = 8; }
		

		echo '<div class="restrict-width">';
			foreach ($boxes as $key => $box) {

				$title = $box['title'];
				$wording = $box['wording'];
				$img_id = $box['image_id'];
				$imgurl = wp_get_attachment_image_src($img_id, 'large')[0];

				echo '<div class="md-modal md-effect-'. $transition_type .'" id="modal-'. $key .'">';
					echo '<div class="md-content">';

						echo '<div class="column photo" style="background-image:url('. $imgurl .');"></div>';
						echo '<div class="column details">';
							echo '<h2 class="center red">' . $title . '</h2>';
							echo '<p class="block">'. $wording .'</p>';
						echo '</div>';
						echo '<button class="md-close dismiss" title="close">X</button>';
						echo '<div class="clearfix"></div>';
					echo '</div>';
				echo '</div>';
			}


			foreach ($boxes as $key => $box) {
				$title = $box['title'];
				$img_id = $box['image_id'];
				$imgurl = wp_get_attachment_image_src($img_id, 'large')[0];

				echo '<button class="md-trigger" data-modal="modal-'. $key .'"><span class="pic" style="background-image: url('. $imgurl .');"></span><span class="title">' . $title . '</span></button>';
			}
			echo '<div class="md-overlay"></div>';
		echo '</div>';
		echo '<div class="clearfix"></div>';



	}



	


	/*
	** Pagelinks
	*/
	if(get_post_meta(get_the_ID(), 'mbm_home_homelinks', true)){
		$homelinks = get_post_meta(get_the_ID(), 'mbm_home_homelinks', true);

		if(($key = array_search(get_the_ID(), $homelinks)) !== false) {
		    unset($homelinks[$key]);
		}

		echo '<div class="center">';
			$count = count($homelinks);
			if($count === 1){ $widthclass = ' cols cols12'; }
			if($count === 2){ $widthclass = ' cols cols6'; }
			if($count === 3){ $widthclass = ' cols cols4'; }
			if($count === 4){ $widthclass = ' cols cols3'; }
			if($count === 5){ $widthclass = ' cols cols6'; }
			if($count === 6){ $widthclass = ' cols cols6'; }

			foreach ($homelinks as $key => $id) {
				$img_url = get_the_post_thumbnail_url($id, 'large');
				// echo $img_url . '<br>';
				echo '<a href="'. get_permalink($id) .'" class="featuredlink'. $widthclass .'"><div class="background" style="background-image:url('. $img_url .');"></div><span>'. get_the_title($id) .'</span></a>';
			}
		echo '</div>';
	}
	

	/*
	** More content
	*/
	if(get_post_meta(get_the_ID(), 'mbm_more', true)){
		echo '<div class="restrict-width">';
		echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mbm_more', true));
		// echo get_post_meta(get_the_ID(), 'mbm_more', true);
		echo '</div>';
	}
	?>




<!-- 				
	<footer class="entry-footer">
		<div class="restrict-width">
			
		</div>
	</footer> 
				-->


</article><!-- #post-## -->
