<?php
function credentiallogo() { ?>
	<div id="prefooter">

		<?php 
		$testimonialloop = new WP_Query( array(
			'post_type' => 'testimonial',
			'orderby' => 'rand',
			'posts_per_page' => '1',
			'order' => 'ASC',
			)
		 ); 
		 ?>

	<?php while ( $testimonialloop->have_posts() ) : $testimonialloop->the_post(); ?>
	<div class="testimonial"><em>
			<?php 
			echo '<span class="big">"</span>';
			echo get_the_content(); 
			echo '<span class="big">"</span>';
			?>
		<br>- 
		<?php the_title(); ?>

		<?php if ( get_post_meta(get_the_ID(), '_cmb_testimonial_from', true) ) {
	echo ', ';
	echo ( get_post_meta(get_the_ID(), '_cmb_testimonial_from', true) ); 
	} ?>
	</div>
	<?php endwhile; ?>



	<div id="credentials">
		<div class="credential">  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/odplumbingandheating_gassafe.jpg" alt="Gas Safe 306937" />
		<h6>306937</h6>
		</div>

		<div class="credential">  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/tradedirect.jpg" alt="Fully Insured Company UDHW007798" />
		<h6>Fully Insured Company</h6>
		</div>

		<div class="credential">  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/ers-logo.jpg" alt="Gas Safe 306937" />
		<h6>Cert Numer UDHW007798</h6>
		</div>
	</div>
	</div>
<?php 
} 
add_action('thematic_belowmainasides','credentiallogo');





function brandlogos() { ?>

	<?php if(is_page('35') ) { ?>

		<div class="aside main-aside">
			<h3 class="widgettitle">Brands We Use Include:</h3>

		<?php $loop = new WP_Query( array(
			'post_type' => 'brand',
			'orderby' => 'rand',
			'posts_per_page' => '5',
			'order' => 'ASC',
			'tax_query' => array(
			array(
			'taxonomy' => 'servicetype',
			'field' => 'slug',
			'terms' => 'bathrooms'
				)
			)
		) ); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php if ( get_post_meta(get_the_ID(), '_cmb_brand_url', true) ) { ?>

				<a href="<?php echo get_post_meta(get_the_ID(), "_cmb_brand_url", true); ?>" title="<?php the_title(); ?>" target="blank">
				<?php the_post_thumbnail( 'brandlogo' ); ?>
				</a>

				<?php } else { ?>
				<?php the_post_thumbnail( 'brandlogo' );  ?>
				<?php }  } ?>
			<div class="clearfix"></div>
			<?php endwhile; ?>
		</div>
	<?php } ?>




		<?php if(is_page('33') ) { ?>

		<div class="aside main-aside">
			<h3 class="widgettitle">Brands We Use Include:</h3>

		<?php $loop = new WP_Query( array(
			'post_type' => 'brand',
			'orderby' => 'rand',
			'posts_per_page' => '5',
			'order' => 'ASC',
			'tax_query' => array(
			array(
			'taxonomy' => 'servicetype',
			'field' => 'slug',
			'terms' => 'heating-gas-appliances'
				)
			)
		) ); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php if ( get_post_meta(get_the_ID(), '_cmb_brand_url', true) ) { ?>

				<a href="<?php echo get_post_meta(get_the_ID(), "_cmb_brand_url", true); ?>" title="<?php the_title(); ?>" target="blank">
				<?php the_post_thumbnail( 'brandlogo' ); ?>
				</a>


				<?php } else { ?>
				<?php the_post_thumbnail( 'brandlogo' );  ?>
				<?php }  } ?>
			<div class="clearfix"></div>
			<?php endwhile; ?>

		</div>

	<?php } ?>




		<?php if(is_page('37') ) { ?>

		<div class="aside main-aside">
			<h3 class="widgettitle">Brands We Use Include:</h3>

		<?php $loop = new WP_Query( array(
			'post_type' => 'brand',
			'orderby' => 'rand',
			'posts_per_page' => '5',
			'order' => 'ASC',
			'tax_query' => array(
			array(
			'taxonomy' => 'servicetype',
			'field' => 'slug',
			'terms' => 'plumbing-maintenance'
				)
			)
		) ); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php if ( get_post_meta(get_the_ID(), '_cmb_brand_url', true) ) { ?>

				<a href="<?php echo get_post_meta(get_the_ID(), "_cmb_brand_url", true); ?>" title="<?php the_title(); ?>" target="blank">
				<?php the_post_thumbnail( 'brandlogo' ); ?>
				</a>


				<?php } else { ?>
				<?php the_post_thumbnail( 'brandlogo' );  ?>
				<?php }  } ?>
<div class="clearfix"></div>
			<?php endwhile; ?>

		</div>

	<?php } ?>

			<?php if(is_page('4') ) { ?>

		<div class="aside main-aside">
			<h3 class="widgettitle">Brands We Use Include:</h3>

		<?php $loop = new WP_Query( array(
			'post_type' => 'brand',
			'orderby' => 'title',
			'posts_per_page' => '10',
			'order' => 'rand',
		) ); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php if ( get_post_meta(get_the_ID(), '_cmb_brand_url', true) ) { ?>

				<a href="<?php echo get_post_meta(get_the_ID(), "_cmb_brand_url", true); ?>" title="<?php the_title(); ?>" target="blank">
				<?php the_post_thumbnail( 'brandlogo' ); ?>
				</a>


				<?php } else { ?>
				<?php the_post_thumbnail( 'brandlogo' );  ?>
				<?php }  } ?>
<div class="clearfix"></div>
			<?php endwhile; ?>

		</div>

	<?php }




} add_action('thematic_betweenmainasides','brandlogos');




function add_slideshow(){
	if( is_front_page() ){

		$slideloop = new WP_Query( array(
		'post_type' => 'slide',
		'posts_per_page' => -1,
		'orderby' => 'rand'
		) ); 

		if( $slideloop->have_posts() ){
			// load up flexslider using slides
			?>
			<div class="sliderholder">
				<section class="slider">
					<div class="flexslider">
						<ul class="slides">

							<?php
							while ( $slideloop->have_posts() ) : $slideloop->the_post();
								if (has_post_thumbnail( )){
									echo '<li>' . get_the_post_thumbnail( get_the_ID(), 'slide' ) . '</li>';
								}
							endwhile; 
							?>
						</ul>
					</div>
				</section>
			</div>

		  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

			<script type="text/javascript">
			    $(window).load(function(){
			      $('.flexslider').flexslider({
			        animation: "fade",
			        slideshowSpeed: 4000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				    animationSpeed: 250,
				    easing: "swing", 
				    randomize: false,
				    pauseOnAction: false,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				    pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				    pauseInvisible: false,   		//{NEW} Boolean: Pause the slideshow when tab is invisible, resume when visible. Provides better UX, lower CPU usage.
				    touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
				    video: false,
			        start: function(slider){
			          $('body').removeClass('loading');
			        }
			      });
			    });
			  </script>

		<?php
		}else{ echo '<br><br>'; }
	}
}
add_action('thematic_belowheader','add_slideshow', 12);





/*
Thematic Position Hooks


thematic_before()
	Located in header.php just after the opening body tag, before anything else.


thematic_aboveheader()
	Located in header.php just before the header div.


thematic_header()
	This hook builds the content of the header div and loads the following actions:
	Action 	Position Number
	thematic_brandingopen() 	1
	thematic_blogtitle() 		3
	thematic_blogdescription() 	5
	thematic_brandingclose() 	7
	thematic_access() 			9



thematic_abovecontainer()

thematic_belowheader()
	Located in header.php just after the header div.

thematic_abovecomments()

thematic_abovecommentslist()

thematic_belowcommentslist()

thematic_abovetrackbackslist()

thematic_belowtrackbackslist()

thematic_abovecommentsform()

thematic_show_subscription_checkbox()

thematic_belowcommentsform()

thematic_show_manual_subscription_form()

thematic_belowcomments()

thematic_abovemainasides()

thematic_betweenmainasides()

thematic_belowmainasides()

thematic_abovefooter()

thematic_footer()

thematic_after()

*/


?>