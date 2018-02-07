<?php

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>

		<div id="container">
		
		    <?php thematic_abovecontent(); ?>
		
		    <div id="content">
		
		        <?php 
		
		        the_post();
		
		        // displays the page title
		        thematic_page_title();

$termDiscription = term_description( '', get_query_var( 'taxonomy' ) );
if($termDiscription != '') : ?>
<div class="tag-desc"><?php echo $termDiscription; ?></div>
<?php endif; 
	
		        rewind_posts();
		
		        // create the navigation above the content
		        thematic_navigation_above();
		
		        // action hook creating the archive loop
		        thematic_archiveloop();
		
		        // create the navigation below the content
		        thematic_navigation_below();
		
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