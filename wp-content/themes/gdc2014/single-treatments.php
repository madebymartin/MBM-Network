<?php
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>
		<div id="container">

            <h1 class="entry-title"><?php the_title()?>
                <?php if ( get_post_meta(get_the_ID(), '_cmb_treatmentduration', true) ) { ?>
                <span class="entypo-clock duration"><?php echo get_post_meta(get_the_ID(), "_cmb_treatmentduration", true); ?> Minute Treatment</span></h1>
                <?php } else { ?></h1><?php } ?>

			<?php thematic_abovecontent(); ?>
			<div id="content">
	
                <?php 
                the_post();
    	        get_sidebar('single-top');

                ?>

	<div class="hentry">
        <?php the_content();?>

        <?php if ( get_post_meta(get_the_ID(), '_cmb_treatmentvideo', true) ) { ?>
            <div class="videowrapper">
                <iframe src="<?php echo get_post_meta(get_the_ID(), "_cmb_treatmentvideo", true); ?>" frameborder="0"></iframe>
            </div>      
        <?php } ?>

            <br>
            
        <?php the_post_thumbnail( 'banner', array( 'class' => "mobile_feature_image", ) ); ?>

        <?php
        // Find connected pages
        $connected = new WP_Query( array(
          'connected_type' => 'treatment-product',
          'connected_items' => get_queried_object(),
          'nopaging' => true,
        ) ); ?>



        <?php
        /*Link to full size product on sample page
        if ( $connected->have_posts() ) :
            echo '<h3 class="boxheading">Like the sound of this treatment? You will love:</h3>';
            echo '<div class="product_summary panel"><ul>';

            function mbm_limited_excurpt(){
                            $excerpt = get_the_content();
                            $excerpt = strip_shortcodes($excerpt);
                            $excerpt = strip_tags($excerpt);
                            $the_str = substr($excerpt, 0, 74);
                            return $the_str;
                            }

            while ( $connected->have_posts() ) : $connected->the_post(); ?>
                <li class="product">
                    <a href="<?php the_permalink(); ?>" style="display:block;">
                        <h3><span><?php echo get_the_post_thumbnail( $post_id, 'shop_tiny', array( 'class'    => "left", )); ?></span><?php the_title(); ?></h3>
                    </a>
                </li>
            <?php endwhile;
            echo '</ul></div>';

            // Prevent weirdness
            wp_reset_postdata();
            endif; 
        */




$terms = apply_filters( 'taxonomy-images-get-terms', array('taxonomy' => 'product_range') );
if ( ! empty( $terms ) ) {
    print '<ul>';
    foreach( (array) $terms as $term ) {
        print '<li><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '">' . wp_get_attachment_image( $term->image_id, 'detail' ) . '</li>';
    }
    print '</ul>'; 
} ?>


<!--
<h5>This treatment is available at the following of our Platinum Spas:</h5>

<ul>
<li><?php if ( get_post_meta(get_the_ID(), '_cmb_clarice-bury', true) ) { ?>
<a href="<?php echo get_permalink( 596 ); ?>">Clarice House (Bury St. Edmunds)</a>
<?php } else { ?><span></span><?php } ?></li>

<li><?php if ( get_post_meta(get_the_ID(), '_cmb_clarice-colchester', true) ) { ?>
<a href="<?php echo get_permalink( 598 ); ?>">Clarice House (Colchester)</a>
<?php } else { ?><span></span><?php } ?></li>

<li><?php if ( get_post_meta(get_the_ID(), '_cmb_clarice-ipswich', true) ) { ?>
<a href="<?php echo get_permalink( 600 ); ?>">Clarice House (Ipswich)</a>
<?php } else { ?><span></span><?php } ?></li>

<li><?php if ( get_post_meta(get_the_ID(), '_cmb_oultonhall', true) ) { ?>
<a href="<?php echo get_permalink( 440 ); ?>">De Vere (Oulton Hall)</a>
<?php } else { ?><span></span><?php } ?></li>

<li><?php if ( get_post_meta(get_the_ID(), '_cmb_slaleyhall', true) ) { ?>
<a href="<?php echo get_permalink( 443 ); ?>">De Vere (Slaley Hall)</a>
<?php } else { ?><span></span><?php } ?></li>

<li><?php if ( get_post_meta(get_the_ID(), '_cmb_turkishbaths', true) ) { ?>
<a href="<?php echo get_permalink( 604 ); ?>">Turkish Baths</a>
<?php } else { ?><span></span><?php } ?></li>
</ul>
-->

</div>

<?php
    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
		
    	        // create the navigation below the content
				// thematic_navigation_below();
		
    	        // calling the comments template
    	        thematic_comments_template();
		
    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
?>

			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();


    // calling the standard sidebar 
    thematic_sidebar();

    // calling footer.php
    get_footer();
?>