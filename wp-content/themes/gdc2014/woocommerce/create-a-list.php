<?php
global $current_user;
get_currentuserinfo();
?>
<?php do_action( 'woocommerce_wishlists_before_wrapper' ); ?>
<div id="wl-wrapper" class="woocommerce">
	<?php if ( function_exists( 'wc_print_messages' ) ) : ?>
		<?php wc_print_messages(); ?>
	<?php else : ?>
		<?php WC_Wishlist_Compatibility::wc_print_notices(); ?>
	<?php endif; ?>
	<div class="wl-form">
		<form  action="" enctype="multipart/form-data" method="post">
			<input type="hidden" name="wl_return_to" value="<?php echo (isset($_GET['wl_return_to']) ? $_GET['wl_return_to'] : ''); ?>" />
			<?php echo WC_Wishlists_Plugin::action_field( 'create-list' ); ?>
			<?php echo WC_Wishlists_Plugin::nonce_field( 'create-list' ); ?>


			<p class="form-row form-row-wide">
				<label for="wishlist_title"><?php _e( 'Name your list', 'wc_wishlist' ); ?><abbr class="required" title="required">*</abbr></label>
				<input type="text" name="wishlist_title" id="wishlist_title" class="input-text" value="" />
			</p>
			<p class="form-row">
				<strong><?php _e( 'Privacy Settings', 'wc_wishlist' ); ?><abbr class="required" title="required">*</abbr></strong>
			<table class="wl-rad-table">
				<tr>
					<td><input type="radio" name="wishlist_sharing" id="rad_shared" value="Shared" checked="checked"></td>
					<td><label for="rad_shared"><?php _e( 'Shared', 'wc_wishlist' ); ?> <span class="wl-small">- <?php _e( 'Only people with the link can see this list. It will not appear in public search results.', 'wc_wishlist' ); ?></span></label></td>
				</tr>
				<tr>
					<td><input type="radio" name="wishlist_sharing" id="rad_priv" value="Private"></td>
					<td><label for="rad_priv"><?php _e( 'Private', 'wc_wishlist' ); ?> <span class="wl-small">- <?php _e( 'Only you can see this list.', 'wc_wishlist' ); ?></span></label></td>
				</tr>
			</table>
			</p>



			<?php if ( WC_Wishlists_Settings::get_setting( 'wc_wishlist_notifications_enabled', 'disabled' ) == 'enabled' ): ?>
				<p><?php _e( 'Email Notifications', 'wc_wishlist' ); ?></p>
				<p class="form-row">
				<table class="wl-rad-table">
					<tr>
						<td><input type="radio" id="rad_notification_yes" name="wishlist_owner_notifications" value="yes" <?php checked( true ); ?>></td>
						<td><label for="rad_notification_yes"><?php _e( 'Yes', 'wc_wishlist' ); ?> <span class="wl-small">- <?php _e( 'Send me an email if a price reduction occurs.', 'wc_wishlist' ); ?></span></label></td>
					</tr>
					<tr>
						<td><input type="radio" id="rad_notification_no" name="wishlist_owner_notifications" value="no"></td>
						<td><label for="rad_notification_no"><?php _e( 'No', 'wc_wishlist' ); ?> <span class="wl-small">- <?php _e( 'Do not send me an email if a price reduction occurs.', 'wc_wishlist' ); ?></span></label></td>
					</tr>
				</table>
				</p>
			<?php endif; ?>
				
			<div class="wl-clear"></div>
			<p class="form-row">
				<input type="submit" class="button alt" name="update_wishlist" value="<?php _e( 'Create List', 'wc_wishlist' ); ?>">
			</p>
		</form>
	</div><!-- /wl form -->
</div><!-- /wishlist-wrapper -->
<?php do_action( 'woocommerce_wishlists_after_wrapper' ); ?>
