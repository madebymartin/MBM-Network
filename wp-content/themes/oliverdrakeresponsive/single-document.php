<?php
/**
 * Single Post Template
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */


	$quote_content = get_post_meta( get_the_ID() );
	$customer_id = $quote_content['_cmb_customer_id'][0];
	$serialized_quote_items = $quote_content['_cmb_quote_items'][0];
	$quote_items_array = unserialize($serialized_quote_items);




    get_header();
    thematic_abovecontainer();
?>

		<div id="container">
			
			<?php
				thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
							
	            // start the loop
	            while ( have_posts() ) : the_post();
				thematic_navigation_above();
    	        get_sidebar('single-top');
    	        thematic_singlepost();

    	        



    	        echo $customer_id;




			echo '<table class="quoteitems" cellspacing="0" cellpadding="10"><tr class="headerrow"><td>Description</td><td>Amount</td></tr>';
			// OUTPUT ITEMISED LIST
			foreach($quote_items_array as $key => $val){

					echo '<tr class="' . (++$count%2 ? "odd" : "even") . '">';

					foreach($val as $key => $value){
		            if($key === '_cmb_item_description'){ 
		            	echo '<td>' . $value . '</td>'; 
		            }
		            if($key === '_cmb_item_amount'){ 
		            	if($value > 0){ echo '<td>£' . round($value, 2) . '</td>';} else{ echo '<td></td>'; }
		                 
		                $total += $value;
		            }

		            echo '</tr>';

		        }
			}
			echo '<tr class="footerrow"><td>Total:</td><td class="total">£' . $total  . '</td></tr>';
			echo '<tr><td>(ex. VAT):</td><td class="total">£' . round($total / 1.2, 2)  . '</td></tr></table>';

			


    	        /*foreach( $quote_content as $content){
    	        	print_r($content);
    	        	echo  '<hr>';
    	        }
*/




    	        //print_r( $quote_content );

    	        echo '<hr>';
    	        
    	        print_r( $quote_items_array );





    	        get_sidebar('single-insert');
		
    	        
    	        // end the loop
        		endwhile;
		
    	        get_sidebar('single-bottom');
			?>
		
			</div><!-- #content -->
			
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->
		
<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>