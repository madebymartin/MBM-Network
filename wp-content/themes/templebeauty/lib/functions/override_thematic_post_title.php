<?php
function childtheme_override_postheader_posttitle(){
		$posttitle = "\n\n\t\t\t\t\t";
		
		if ( !$title_content = get_the_title() )  
			$title_content = '<a href="' . get_permalink() . '">' . _x('(Untitled)', 'Default title for untitled posts', 'thematic') . '</a>';
	    
	    if (is_single() || is_page()) {
	        $posttitle .= '<div class="entry-title"><h1>' . $title_content . "</h1></div>\n";
	    } elseif (is_404()) {    
	        $posttitle .= '<div class="entry-title"><h1>' . __('Oops! Not Found...', 'thematic') . "</h1></div>\n";
	    } else {
	        $posttitle .= '<h2 class="entry-title">';
	        $posttitle .= sprintf('<a href="%s" title="%s" rel="bookmark">%s</a>',
	        						apply_filters('the_permalink', get_permalink()),
									sprintf( esc_attr__('Permalink to %s', 'thematic'), the_title_attribute( 'echo=0' ) ),
	        						$title_content
	        						);   
	        $posttitle .= "</h2>\n";
	    }
	    
	    return apply_filters('thematic_postheader_posttitle',$posttitle); 
	
	} 

?>