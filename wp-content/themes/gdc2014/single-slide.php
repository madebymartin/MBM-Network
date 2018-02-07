<?php
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();
?>
		<div id="container">
			<?php thematic_abovecontent(); ?>
			<div id="content">
	
    	    



<?php the_post();
    	        
    	        // create the navigation above the content
				thematic_navigation_above();
		
    	        // calling the widget area 'single-top'
    	        get_sidebar('single-top');
		
    	        // action hook creating the single post
    	        thematic_singlepost();
?>
<div class="right"><?php the_post_thumbnail('posterlarge');?></div>
<?php
    	        // calling the widget area 'single-insert'
    	        get_sidebar('single-insert');
		
    	        // create the navigation below the content
				thematic_navigation_below();
		
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
?>

<div id="access">
	<div class="menu">
	<?php wp_nav_menu( array(
	'menu' => 'Top Navigation',
	'container'       => 'ul',
	'container_class' => 'sf-menu sf-js-enabled',
	'menu_id' => 'menu-top-navigation',
	'menu_class' => 'sf-menu sf-js-enabled'
	)); ?>
	</div><!--.menu-->
</div><!--#access-->

<div id="primary" class="aside main-aside">
<h3>Treatment Categories</h3>
<?php wp_nav_menu( array('menu' => 'Treatment Categories' )); ?> 
<?php echo do_shortcode('[dcwp-jquery-accordion menu="Shop Categories" event="click" save="true" disable="true"]'); ?>
<?php echo do_shortcode('[dcwp-jquery-accordion menu="Product Ranges" event="click" save="true" disable="true"]'); ?>
</div>

<?php 
    // calling footer.php
    get_footer();
?>