<div class="aside">
	<?php if ( get_post_meta('450', '_cmb_contact_details_6', true) ) { ?>
	<h3>Telephone<br>
	<?php echo get_post_meta('450', "_cmb_contact_details_6", true); ?>
	<br><span class="small"><small>(calls charged at local rate)</small></span></h3><br><br>
	
	<?php }


	if ( get_post_meta('450', '_cmb_contact_details_1', true) ) { ?>
	<h3>Address</h3>
	<?php echo get_post_meta('450', "_cmb_contact_details_1", true); ?><br>
	<?php }

	if ( get_post_meta('450', '_cmb_contact_details_2', true) ) { ?>
	<?php echo get_post_meta('450', "_cmb_contact_details_2", true); ?><br>
	<?php }

	if ( get_post_meta('450', '_cmb_contact_details_3', true) ) { ?>
	<?php echo get_post_meta('450', "_cmb_contact_details_3", true); ?><br>
	<?php }

	if ( get_post_meta('450', '_cmb_contact_details_4', true) ) { ?>
	<?php echo get_post_meta('450', "_cmb_contact_details_4", true); ?><br>
	<?php } 

	if ( get_post_meta('450', '_cmb_contact_details_5', true) ) { ?>
	<?php echo get_post_meta('450', "_cmb_contact_details_5", true); ?><br>
	<?php }

	if ( get_post_meta('450', '_cmb_contact_details_additional', true) ) { ?>
	<?php echo '<br><br>' . get_post_meta('450', "_cmb_contact_details_additional", true); ?><br>
	<?php } ?>

</div>