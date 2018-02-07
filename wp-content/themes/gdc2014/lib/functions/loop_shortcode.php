<?php
function highlight_posts() {

return 'boo';

    $args = array(
	'post_type' => 'recommended',
	'posts_per_page' => 4
);


    $return_string ="";
    $the_query = new WP_Query( $args );
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $return_string .= 


'loop result:'.
get_the_title().
'</a></h3><p class="read-more"><a href="'.
get_permalink().
'">Read More...</a></p></div><div class="clear"></div></div>';





        endwhile;
    wp_reset_postdata();
    return $return_string;
}

add_shortcode( 'myloop', 'highlight_posts' );
?>