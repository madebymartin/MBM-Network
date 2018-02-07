<?php
// display 2 recent posts from cat=9 (category 9), see link below for full list of parameters.
// http://codex.wordpress.org/Class_Reference/WP_Query
function childtheme_recent_posts_query () {
    if ( is_front_page() ) {
        echo '<div class="recent-posts">';
        $my_query = new WP_Query( array( 'cat=9', 'posts_per_page' => 2 , 'ignore_sticky_posts' => 1) );
            echo '<ul class="featured-posts">';
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li>
                    <?php
                        $posttitle = '<h3><a href="';
                        $posttitle .= get_permalink();
                        $posttitle .= '" title="';
                        $posttitle .= the_title_attribute('echo=0');
                        $posttitle .= '" rel="bookmark">';
                        $posttitle .= get_the_title();
                        $posttitle .= "</a></h3>\n";
                        echo $posttitle;

                        if ( has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
                        <?php }
                        else { ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute('echo=0'); ?>"><img height="120" width="210" src="<?php bloginfo('stylesheet_directory'); ?>/images/testimage.png" /></a>
                        <?php }

                        the_excerpt();

                        echo '<a href="'. get_permalink() . '">' .__('View &raquo;', 'thematic') . '</a>';
                        ?>
                    </li>
                <?php
                endwhile;
            echo '</ul>';
        echo '</div>';
    }
}
add_action ('thematic_abovefooter', 'childtheme_recent_posts_query');
?>