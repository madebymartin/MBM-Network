    </div><!-- #main -->
    
    <?php
    
    // action hook for placing content above the footer
    thematic_abovefooter();
    
    ?>    

	<div class="block">
	
	
		<div class="footerlink">
			<a id="newsletter" class="footerpic" href="<?php echo get_permalink(477); ?>">
			<?php echo get_the_post_thumbnail('477', 'feature'); ?>
			<span>
			<h3><?php echo get_the_title(477); ?> </h3>
				<p class=""><?php echo get_post_meta(477, "rw_caption", true); ?></p>
			</span>
			</a>
		</div>
		
		
    	<div class="footerlink">
    		<a id="mailinglist" class="footerpic" href="<?php echo get_permalink(203); ?>">
    		<?php echo get_the_post_thumbnail('203', 'feature'); ?>
			<span>
			<h3><?php echo get_the_title(203); ?> </h3>
				<p class=""><?php echo get_post_meta(203, "rw_caption", true); ?></p>
			</span>
			</a>
    		
    					
		</div>
		
		
	</div><!-- #block -->
	
	<div id="footer">
	
	<?php
        // action hook creating the footer 
        thematic_footer();
        ?>
        <div id="social">
        <a class="socialbutton" id="twitter" href="https://twitter.com/beausecret" target="blank"></a>
        <a class="socialbutton" id="facebook" href="https://www.facebook.com/BeautySecretsSalonAndSpa" target="blank"></a>

        </div>
        
        
	</div>
	
	
    <?php
    // action hook for placing content below the footer
    thematic_belowfooter();
    
    if (apply_filters('thematic_close_wrapper', true)) {
    	echo '</div><!-- #wrapper .hfeed -->';
    }
    ?>  

<?php 
// calling WordPress' footer action hook
wp_footer();
// action hook for placing content before closing the BODY tag
thematic_after(); 
?>

 
</body>
</html>