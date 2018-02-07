<?php
/**
 * Template Name: Service Reviews
 *
 * …
 * 
 * @package Germaine_de_Capuccini
 * @subpackage Templates
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			$xml_url = "https://ww2.feefo.com/api/xmlfeedback?merchantidentifier=germaine-de-capuccini&protocol=https&mode=service&negativesanswered=true&limit=1000&sortby=date&order=desc&allcomments=True&since=year";
			$xml = simplexml_load_file($xml_url);
			?>


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title center">', '<span class="feefo">: Powered by <a target="blank" href="https://ww2.feefo.com/en-gb/reviews/germaine-de-capuccini#?timeFrame=ALL&sort=newest"><img src="' . get_stylesheet_directory_uri() . '/img/feefo/feefo-logo.png" alt="Powered by Feefo" title="Powered by Feefo"></a></span></h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php

							if( ! $xml ) { 
							// COULDNT GET THE XML FROM FEEFO
							} 
							else { 
								// SUCCESSFULLY GOT FEEFO XML FEED
								foreach ($xml as $key => $feedback) {
									if($key == 'SUMMARY'){
										if($feedback->AVERAGE){$average_rating_percent = $feedback->AVERAGE;}
										if($feedback->TOTALPRODUCTCOUNT){$review_count = $feedback->TOTALPRODUCTCOUNT;}
									}
								}
								echo '<div class="center">' . $average_rating_percent . '% of customers are happy with the service they received from Germaine de Capuccini (' . $review_count . ' reviews).</div>';


								echo '<br><br><table class="reviews"><thead><tr><td>Date</td><td>Score</td><td>Customer Feedback</td></tr></thead><tbody>';

										foreach ($xml as $key => $feedback) {		
											if($key == 'FEEDBACK'){
												//if($feedback->NAME){$review_name = $feedback->NAME;}
												if($feedback->DATE){$review_date = $feedback->DATE;}
												if($feedback->HREVIEWDATE){$review_datetime = $feedback->HREVIEWDATE;}
												if($feedback->HREVIEWRATING){$review_rating = $feedback->HREVIEWRATING;}
												if($feedback->HREVIEWRATING){$review_rating_icon_url =  get_stylesheet_directory_uri() . '/img/feefo/rating' . $review_rating . '.png';}
												if($feedback->CUSTOMERCOMMENT){$review_comment = $feedback->CUSTOMERCOMMENT;}
												if($feedback->FURTHERCOMMENTSTHREAD){$review_further_comments = $feedback->FURTHERCOMMENTSTHREAD;}

												echo '<tr itemtype="https://schema.org/Review" itemscope="itemscope" itemprop="review">';
													echo '<td class="review-date"><time itemprop="datePublished" datetime="'. $review_datetime .'">'. $review_date .'</time></td>';
													echo '<td>
														<img src="' . $review_rating_icon_url . '" alt="rating: '. $review_rating .'">
														<div itemtype="https://schema.org/Rating" itemscope="itemscope" itemprop="reviewRating">
															<meta content="1" itemprop="worstRating">
															<span itemprop="ratingValue" content="'. $review_rating .'"></span>
															<meta content="5" itemprop="bestRating">
														</div>
													</td>';
													echo '<td><span itemprop="description">'. $review_comment . '</span><span class="hidden" itemprop="author" itemtype="https://schema.org/Person"> - <span itemprop="name">Happy Customer</span></span>';

													if($feedback->FURTHERCOMMENTSTHREAD){
														foreach ($review_further_comments as $key => $review_further_comment) {
															$post = $review_further_comment->POST;
															$reply = $post->VENDORCOMMENT;
															//print_r($post);
															echo '<blockquote class="triangle-isosceles">' . $reply . '</blockquote>';
														}
													}
													echo '</td>';
												echo '</tr>';
											}
										} 
										echo '</tbody></table>';
							}

							




						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->


			<?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
