<?php
/**
 * Single Post Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>

		<div id="container">
			
			<?php
				// action hook for placing content above #content
				thematic_abovecontent();
						
				// filter for manipulating the element that wraps the content 
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
							
	            // start the loop
	            while ( have_posts() ) : the_post();
    	        
    	        // create the navigation above the content
				thematic_navigation_above();
		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
		
    	        // action hook creating the single post
    	        thematic_singlepost(); ?>



<?php $pricing = get_post_meta(get_the_ID(), 'mbm_pricing', false);
if ( ! empty( $pricing ) ) { 
	// Price exist!
	echo '<ul class="prices">';
	foreach( (array) $pricing as $price ) {
		//print_r($price);
		$treatment_price = $price['mbm_treatment_price'];
		$treatment_price_format = $price['mbm_treatment_price_format'] . ': ';

		echo '<li>' . $treatment_price_format . '' . $treatment_price . '</li>';
	}
	echo '</ul>';
}
	else{ }
?>




<?php 
/*
$services = get_post_meta(get_the_ID(), 'mbm_treatment_price', false);
	   if ($services){ ?>
	   <div class="feature projectservices"><h4>Services Provided:</h4>
		   <ul>
			  <?php foreach ($services as $service)
			    echo ('<li>boo</li>'); ?>
		    </ul>
		</div>
<?php } else{echo'no prices set';} 
*/
?>





    	        <?php
				
    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
		
    	        // create the navigation below the content
				thematic_navigation_below();
		
       			// action hook for calling the comments_template
    	        // thematic_comments_template();
    	        
    	        // end the loop
        		endwhile;
		
    	        // calling the widget area 'single-bottom'
    	        get_sidebar('single-bottom');
			?>
		
			</div><!-- #content -->
			
			<?php
				// action hook for placing content below #content
				thematic_belowcontent();
			?> 
		</div><!-- #container -->
		
<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();
?>