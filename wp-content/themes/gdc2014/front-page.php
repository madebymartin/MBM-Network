<?php
/**
 * Template Name: Full Width
 *
 * This Full Width template removes the primary and secondary asides so that content
 * can be displayed the entire width of the #content area.
 * 
 * @package Thematic
 * @subpackage Templates
 */

    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();?>

    <div id="homecontainer">
        <div class="homebanner desktophide">
        	<?php the_post_thumbnail('slide', array('class' => 'homepageimage')); ?>
        	<div id="homemwrapouter">
        		<div class="centrewrap">
        			<div class="centreouter">
        				<div class="centreinner keymessage">
        					<?php the_content(); ?>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        
        <div id="homemessage"><?php the_content(); ?></div>
    </div>


		

<?php 
    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();
?>