<?php
$obj = get_queried_object();
$id = $obj->ID;
$banners = get_post_meta($id, 'mbm_banners', true);
$count = count($banners);

	foreach ($banners as $key => $banner) {
		$class = 'banner-' . $key;
		if($banner['mbm_bg_img_id']){
			$bg_img_id = $banner['mbm_bg_img_id'];
			$bg_img_url = wp_get_attachment_image_src($bg_img_id, 'full')[0];
			$bg = 'background-image:url('. $bg_img_url .');'; 
		}
		else{
			$bg = '';
		}

		// if($banner['mbm_bg_img']){$bg_img_url = $banner['mbm_bg_img'];}else{$bg_img_url = '';}
		// if($banner['mbm_fg_img_id']){$fg_img_id = $banner['mbm_fg_img_id'];}else{$fg_img_id = '';}
		if($banner['mbm_fg_img']){$fg_img_url = $banner['mbm_fg_img'];}else{$fg_img_url = '';}
		if($banner['mbm_heading']){$heading = $banner['mbm_heading'];}else{$heading = '';}
		if($banner['mbm_caption']){$caption = $banner['mbm_caption'];}else{$caption = '';}
		if($banner['mbm_link_url']){$link_url = $banner['mbm_link_url'];}else{$link_url = '#';}
		if($banner['mbm_link_text']){$link_text = $banner['mbm_link_text'];}else{$link_text = '';}
		if($banner['mbm_text_colour']){$text_col = $banner['mbm_text_colour'];}else{$text_col = '#fff';}

		$banner_feature = $fg_img_url;

		if( $key == 0 ){ 
			$heading_level = 1; 
			$col_width = 12;

			echo '<div class="banner" id="banner-'. $key .'" style="'. $bg .'color: '. $text_col .';"><div class="inner">';
				echo '<div class="message">';
					echo'<h'. $heading_level .' style="color:'. $text_col .'">'. $heading .'</h'. $heading_level .'>';
					echo $caption .'<br><a class="button mobile-hide" href="'. $link_url .'">'. $link_text .'</a>';
				echo '</div>';
				echo '<div class="feature">';
					echo '<img src="'. $banner_feature .'">';
					echo '<br><a class="button desktop-hide" href="'. $link_url .'">'. $link_text .'</a>';
				echo '</div>';
				
			echo '</div></div>';

		}
	}

	if($count > 1){
		
		echo '<div class="site-banners">';
		foreach ($banners as $key => $banner) {
			$class = 'banner-' . $key;

			if($banner['mbm_bg_img_id']){
				$bg_img_id = $banner['mbm_bg_img_id'];
				$bg_img_url = wp_get_attachment_image_src($bg_img_id, 'full')[0];
				$bg = 'background-image:url('. $bg_img_url .');'; 
			}
			else{
				$bg = '';
			}


			// if($banner['mbm_bg_img_id']){$bg_img_id = $banner['mbm_bg_img_id'];}else{$bg_img_id = '';}
			// if($banner['mbm_bg_img']){$bg_img_url = $banner['mbm_bg_img'];}else{$bg_img_url = '';}
			// if($banner['mbm_fg_img_id']){$fg_img_id = $banner['mbm_fg_img_id'];}else{$fg_img_id = '';}
			if($banner['mbm_fg_img']){$fg_img_url = $banner['mbm_fg_img'];}else{$fg_img_url = '';}
			if($banner['mbm_heading']){$heading = $banner['mbm_heading'];}else{$heading = '';}
			if($banner['mbm_caption']){$caption = $banner['mbm_caption'];}else{$caption = '';}
			if($banner['mbm_link_url']){$link_url = $banner['mbm_link_url'];}else{$link_url = '#';}
			if($banner['mbm_link_text']){$link_text = $banner['mbm_link_text'];}else{$link_text = '';}
			if($banner['mbm_text_colour']){$text_col = $banner['mbm_text_colour'];}else{$text_col = '#fff';}

			$banner_background = $bg_img_url;
			$banner_feature = $fg_img_url;

			if( !$key == 0 ){ 

				if( $count == 2 ){ $col_width = 12; } // main banner + 1
				if( $count == 3 ){ $col_width = 6; } // main banner + 2
				if( $count == 4 ){ $col_width = 4; } // main banner + 3
				if( $count == 5 ){ $col_width = 6; } // main banner + 4

				if( $count == 6 && $key == 1 || $count == 6 && $key == 2 || $count == 6 && $key == 3){ $col_width = 4; } // main banner + 5
				elseif( $count == 6 ){ $col_width = 6; }

				if( $count == 7 ){ $col_width = 4; } // main banner + 6

				if( $count == 8 && $key == 1 || $count == 8 && $key == 2 || $count == 8 && $key == 3){ $col_width = 4; } // main banner + 5
				elseif( $count == 8 ){ $col_width = 6; }

				if( $count == 9 && $key == 4 || $count == 9 && $key == 5 ){ $col_width = 6; } // main banner + 5
				elseif( $count == 9 ){ $col_width = 4; }

				$padding_class = '';
				if( $key == 1 ){ $padding_class .= ' first'; }
				if( $count - $key == 1 ){ $padding_class = ' last'; }

				if( $count == 5 && $key == 2){ $padding_class .= ' last'; } // main banner + 4
				if( $count == 5 && $key == 3){ $padding_class .= ' first'; } // main banner + 4
				if( $count == 6 && $key == 3){ $padding_class .= ' last'; } // main banner + 5
				if( $count == 6 && $key == 4){ $padding_class .= ' first'; } // main banner + 5
				if( $count == 7 && $key == 3 || $count == 7 && $key == 6){ $padding_class .= ' last'; } // main banner + 6
				if( $count == 7 && $key == 4){ $padding_class .= ' first'; } // main banner + 6
				if( $count == 8 && $key == 3 || $count == 8 && $key == 5){ $padding_class .= ' last'; } // main banner + 7
				if( $count == 8 && $key == 4 || $count == 8 && $key == 6){ $padding_class .= ' first'; } // main banner + 7
				if( $count == 9 && $key == 3 || $count == 9 && $key == 5){ $padding_class .= ' last'; } // main banner + 8
				if( $count == 9 && $key == 4 || $count == 9 && $key == 6){ $padding_class .= ' first'; } // main banner + 8

				$heading_level = 2; 
				//$col_width = 6; // 2-up

				echo '<div class="column-'. $col_width . ''. $padding_class .'"><div class="banner" id="banner-'. $key .'" style="'. $bg .'color: '. $text_col .';"><div class="inner">';
					echo '<div class="message">';
						echo'<h'. $heading_level .' style="color:'. $text_col .'">'. $heading .'</h'. $heading_level .'>';
						echo $caption .'<br><a class="button mobile-hide" href="'. $link_url .'">'. $link_text .'</a>';
					echo '</div>';
					echo '<div class="feature">';
						echo '<img src="'. $banner_feature .'">';
						echo '<br><a class="button desktop-hide" href="'. $link_url .'">'. $link_text .'</a>';
					echo '</div>';
				echo '</div></div></div>';
			}
		}
		echo '</div>';
	}

	


?>