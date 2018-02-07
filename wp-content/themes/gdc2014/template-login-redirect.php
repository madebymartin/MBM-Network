<?php
/**
 * Template Name: Login & Redirect
 *
 * This Full Width template removes the primary and secondary asides so that content
 * can be displayed the entire width of the #content area.
 * 
 * @package Thematic
 * @subpackage Templates
 */
    get_header();
    thematic_abovecontainer();
?>
		<div id="container">
			<?php
				// action hook for inserting content above #content
				thematic_abovecontent();		
				echo apply_filters( 'thematic_open_id_content', '<div id="content">' . "\n\n" );
	            get_sidebar('page-top');
	
	            while ( have_posts() ) : the_post();

	            thematic_abovepost();
	        ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<?php
	            	// creating the post header
	            	// thematic_postheader();
	            ?>
	                
					<div class="entry-content">

						
	                    <?php
	                    $redirect_to = get_post_meta( get_the_id(), '_cmb_redirect_url', true );
	                    $redirect_requires_login = get_post_meta( get_the_id(), '_cmb_require_login', true );
	                    $login_args = array(
					        'echo'           => true,
					        'redirect'       => $redirect_to, 
					        'form_id'        => 'redirect_loginform',
					        'label_username' => __( 'Username' ),
					        'label_password' => __( 'Password' ),
					        'label_remember' => __( 'Remember Me' ),
					        'label_log_in'   => __( 'Log In' ),
					        'id_username'    => 'user_login',
					        'id_password'    => 'user_pass',
					        'id_remember'    => 'rememberme',
					        'id_submit'      => 'wp-submit',
					        'remember'       => true,
					        'value_username' => NULL,
					        'value_remember' => true
						);


	                    if( $redirect_requires_login === '1' ){ 
	                    	// login required...
	                    	if ( is_user_logged_in() ) {
	                    		// user logged in - redirect away!
	                    		wp_redirect( $redirect_to, '302' );
								exit;
		                    }

		                    else{
		                    	// user not logged in - present login form that redirects after successful login
		                    	the_content();
		                    	wp_login_form( $login_args );
		                    }

	                    } 
	                    else{
	                    	// login not required - redirect away!
	                    	wp_redirect( $redirect_to, '302' );
							exit;
	                    }
	                    ?>


					</div>
				</div><!-- .post -->
			<?php
	        	thematic_belowpost();

        		endwhile;
        		get_sidebar( 'page-bottom' );
	        ?>
			</div><!-- #content -->
			<?php 
				thematic_belowcontent(); 
			?> 
		</div><!-- #container -->
<?php 
    thematic_belowcontainer();
    get_footer();
?>