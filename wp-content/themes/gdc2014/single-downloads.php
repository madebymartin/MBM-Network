<?php
    get_header();
    thematic_abovecontainer();
?>
		<div id="container">
			<?php thematic_abovecontent(); ?>
			<div id="content">

          <?php 
          //TRADE CUSTOMER CONTENT
          if ( current_user_can('access_trade_content') ) { //only 'Trade Customer' user can see this
            
            the_post();
    				thematic_navigation_above();

  	        get_sidebar('single-top');
            ?>
            <div class="hentry">

              <?php thematic_postheader();

              if ( get_post_meta(get_the_ID(), '_cmb_tradevideo', true) ) { ?><div class="videowrapper"><iframe src="<?php echo get_post_meta(get_the_ID(), "_cmb_tradevideo", true); ?>" frameborder="0"></iframe></div><?php } 
              elseif(the_post_thumbnail() ){ echo '<div style="margin-bottom:6em;">' . the_post_thumbnail('posterlarge') . '</div>'; }
              else { }

              the_content(); ?>

              <ul class="margin0 padding0 downloads">
                <?php if ( get_post_meta(get_the_ID(), '_cmb_generic', true) ) { ?>
                <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_generic", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_generic2', true) ) { 
                $attachment_id = get_post_meta(get_the_ID(), "_cmb_generic2", true);
                $attachment_url = wp_get_attachment_url( $attachment_id );
                ?>
                <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_high_res', true) ) { ?>
                <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_high_res", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print in-house</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_high_res2', true) ) { 
                $attachment_id = get_post_meta(get_the_ID(), "_cmb_high_res2", true);
                $attachment_url = wp_get_attachment_url( $attachment_id );
                ?>
                <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print in-house</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_print-ready', true) ) { ?>
                <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_print-ready", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print professionally</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_print-ready2', true) ) { 
                $attachment_id = get_post_meta(get_the_ID(), "_cmb_print-ready2", true);
                $attachment_url = wp_get_attachment_url( $attachment_id );
                ?>
                <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to print professionally</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_low_res', true) ) { ?>
                <li><a target="blank" href="<?php echo get_post_meta(get_the_ID(), "_cmb_low_res", true); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to view on-screen</a></li>
                <?php } else { ?><?php } ?>

                <?php if ( get_post_meta(get_the_ID(), '_cmb_low_res2', true) ) { 
                $attachment_id = get_post_meta(get_the_ID(), "_cmb_low_res2", true);
                $attachment_url = wp_get_attachment_url( $attachment_id );
                ?>
                <li><a target="blank" href="<?php echo $attachment_url ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-icon.png" alt="High res PDF" width="30" style="width:30px;"/>Download to view on-screen</a></li>
                <?php } else { ?><?php } ?>

              </ul>
            </div>
            <?php
  	        get_sidebar('single-insert');
  	        get_sidebar('single-bottom');
          

          } else{ 
            //ANYONE WHO'S NOT LOGGED IN CONTENT

              global $current_user;
              get_currentuserinfo();

              if (!(is_user_logged_in())) { ?>

              <h1 class="entry-title">
              <?php
              the_title();?></h1>

              <div class="hentry">
              <p>Trade support is for existing customers only. If you are a customer, you can <a href="<?php echo get_permalink('2298'); ?>">register for trade access here</a> or call us on 08456 000 203</p><br/>
              </div>

            <?php } elseif
              (
              (($current_user->user_login) == "brock")   ||
              (($current_user->user_login) == "admin")
              )
              {
                echo "<a href=\"";
                echo get_option('siteurl');
                echo "/wp-admin/\">Dashboard</a>";
                } else { ?>





            <!-- ANYONE ELSE WHO'S LOGGED IN BUT DONT HAVE ACCESS -->
            <h1 class="entry-title">
            <?php
            the_title();?></h1>

            <div class="hentry">
            <p>Your account doesn't currently have access to the trade support area. Please give our helpful office staff a call and they can set this up for you:</p>
            <p><b>08456 000 203</b><p><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></div>
                <?php
              }
          } ?>


			</div><!-- #content -->
			<?php thematic_belowcontent(); ?>
		</div><!-- #container -->
<?php
    // action hook for placing content below #container
    thematic_belowcontainer(); 

    thematic_sidebar();
?>


<?php
    // calling footer.php
    get_footer();
?>