<?php
/**
 * Template Name: Service Reviews
 *
 * …
 * 
 * @package Thematic
 * @subpackage Templates
 */
    get_header();
    thematic_abovecontainer();
?>

		<div id="container">
		
			<?php
				thematic_abovecontent();
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n" );
	            get_sidebar('page-top');
	
	            while ( have_posts() ) : the_post();
	            thematic_abovepost(); ?>
    	     		
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php thematic_postheader(); ?>
					<div class="entry-content">
						<?php
	                    	the_content();
	                    	wp_link_pages( "\t\t\t\t\t<div class='page-link'>" . __( 'Pages: ', 'thematic' ), "</div>\n", 'number' );
	                    	edit_post_link( __( 'Edit', 'thematic' ), "\n\t\t\t\t\t\t" . '<span class="edit-link entypo-pencil">' , '</span>' . "\n" );
	                    

							// Feefo Tab
							//$sku = $product->get_sku();
							$theme_dir = get_stylesheet_directory_uri();
							$xsl_url = $theme_dir . '/lib/feefo/feedback-service.xsl';
							$xml_url = "https://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=service&negativesanswered=true&limit=1000&sortby=date&order=desc&allcomments=True&since=year";
							$xml = simplexml_load_file($xml_url);

							if( ! $xml ) { 
							// COULDNT GET THE XML FROM FEEFO
							} 
							else { 
								// SUCCESSFULLY GOT FEEFO XML FEED
								foreach ($xml as $feedback) {
									if($feedback->TOTALPRODUCTCOUNT){$review_count = $feedback->TOTALPRODUCTCOUNT;}
									if($feedback->AVERAGE){$review_average = $feedback->AVERAGE;}
									if($feedback->TOTALSERVICECOUNT){$reviewcount = $feedback->TOTALSERVICECOUNT;}
								}
							}


							//if( $review_count > 0 ){
								echo '<div class="tab" id="section-feeforeviews">';
									echo '<h2><span class="feefo">Powered by <a target="blank" href="https://ww2.feefo.com/en-gb/reviews/germaine-de-capuccini#?timeFrame=ALL&sort=newest"><img src="' . $theme_dir . '/images/feefo-logo.png" alt="Powered by Feefo" title="Powered by Feefo"></a></span></h2>';
									echo $review_average . '% of customers are happy with the service they received from Germaine de Capuccini (' . $reviewcount . ' reviews).';


									// OLD PHP
									if (phpversion() < "5"){
										$xmldoc = domxml_open_file( $xml_url);
										$xsldoc = domxml_xslt_stylesheet_file ( $xsl_url );
										$result = $xsldoc->process($xmldoc);
										echo $result->dump_mem();
									}
									// PHP over v4:
									else
									{
										$doc = new DOMDocument();
										$xsl = new XSLTProcessor();
										$doc->load($xsl_url);
										$xsl->importStyleSheet($doc);
										$doc->load($xml_url);
										echo $xsl->transformToXML($doc);
									}
									echo '<br><a class="newtab" target="blank" href="https://ww2.feefo.com/en-gb/reviews/germaine-de-capuccini#?timeFrame=ALL&sort=newest">View all our reviews on Feefo</a>';
								echo '</div>'; // reviews tab
							//} else{echo '...';}

	                    ?>
					</div><!-- .entry-content -->
				</div><!-- #post -->
			<?php
	        	thematic_belowpost();
	        		               		
	        	// end loop
        		endwhile;
	        	get_sidebar( 'page-bottom' ); ?>
	
			</div><!-- #content -->
			<?php thematic_belowcontent(); ?> 
		</div><!-- #container -->

<?php 
    thematic_belowcontainer();
    thematic_sidebar();
    get_footer();
?>