<?php
/**
 * Footer Template
 *
 * This template closes #main div and displays the #footer div.
 * 
 * Thematic Action Hooks: thematic_abovefooter thematic_belowfooter thematic_after
 * Thematic Filters: thematic_close_wrapper can be used to remove the closing of the #wrapper div
 * 
 * @package Thematic
 * @subpackage Templates
 */
		thematic_abovemainclose(); ?>
		</div><!-- #main -->

    	
	<?php
		thematic_abovefooter();
		echo ( apply_filters( 'thematic_open_footer', '<div id="footer">' ) );

    		//thematic_footer();

		echo ( apply_filters( 'thematic_close_footer', '</div><!-- #footer -->' . "\n" ) );
			thematic_belowfooter();

	if ( apply_filters( 'thematic_close_wrapper', true ) ) 
		echo ( '</div><!-- #wrapper .hfeed -->' . "\n" );
?>
    </div><!-- #landingpage -->


<?php
	thematic_after(); 
	wp_footer();
	?>
</body>
</html>