<?php $wishlist = new WC_Wishlists_Wishlist( $_GET['wlid'] ); ?>

<?php
$current_owner_key = WC_Wishlists_User::get_wishlist_key();
$sharing = $wishlist->get_wishlist_sharing();
$sharing_key = $wishlist->get_wishlist_sharing_key();
$wl_owner = $wishlist->get_wishlist_owner();

$notifications = get_post_meta($wishlist->id, '_wishlist_owner_notifications', true);
if (empty($notifications)){
	$notifications = 'yes';
}

$wishlist_items = WC_Wishlists_Wishlist_Item_Collection::get_items( $wishlist->id, true );

$treat_as_registry = false;
?>

<?php
if ( $wl_owner != WC_Wishlists_User::get_wishlist_key() && !current_user_can( 'manage_woocommerce' ) ) :

	die();

endif;
?>

<?php do_action( 'woocommerce_wishlists_before_wrapper' ); ?>
<div id="wl-wrapper" class="product woocommerce"> <!-- product class so woocommerce stuff gets applied in tabs -->

	<?php if ( function_exists( 'wc_print_messages' ) ) : ?>
		<?php wc_print_messages(); ?>
	<?php else : ?>
		<?php WC_Wishlist_Compatibility::wc_print_notices(); ?>
	<?php endif; ?>


			<?php if ( sizeof( $wishlist_items ) > 0 ) : ?>

				<div class="wl-form">
					<form  action="" enctype="multipart/form-data" method="post">
						<input type="hidden" name="wlid" value="<?php echo $wishlist->id; ?>" />
						<?php echo WC_Wishlists_Plugin::action_field( 'edit-list' ); ?>
						<?php echo WC_Wishlists_Plugin::nonce_field( 'edit-list' ); ?>

						<table class="wl-rad-table-mbm">
							<tr>
								<td class="wl_title">
									<input required type="text" name="wishlist_title" id="wishlist_title" class="input-text" value="<?php echo esc_attr( $wishlist->post->post_title ); ?>" onclick="select()" />
									<input type="submit" class="rename-button" name="update_wishlist" value="<?php _e( 'Rename', 'wc_wishlist' ); ?>">
								</td>
								<td>
									<select class="wl-priv-sel" name="wishlist_sharing" onchange="this.form.submit()">
										<option <?php selected($sharing, 'Shared'); ?> id="rad_shared" value="Shared"><?php _e('Shared', 'wc_wishlist'); ?></option>
										<option <?php selected($sharing, 'Private'); ?> id="rad_priv" value="Private"><?php _e('Private', 'wc_wishlist'); ?></option>
									</select>
									<br>
									<a class="wlconfirm" data-message="<?php _e( 'Are you sure you want to delete this list?', 'wc_wishlist' ); ?>" href="<?php $wishlist->the_url_delete(); ?>"><?php _e( 'Delete list', 'wc_wishlist' ); ?></a>
									<?php if ( ($sharing == 'Public' || $sharing == 'Shared') && count( $wishlist_items ) ) : ?>
										<br><a href="<?php $wishlist->the_url_view(); ?>&preview=true"><?php _e( 'Preview List', 'wc_wishlist' ); ?></a>
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<td class="share">
									<?php if ( $sharing == 'Public' || $sharing == 'Shared' ) : ?>
										<?php if ( $wishlist_items && count( $wishlist_items ) ) : ?>
											<div class="wl-meta-share">
												<?php woocommerce_wishlists_get_template( 'wishlist-sharing-menu2.php', array('id' => $wishlist->id) ); ?>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</td>
								<td></td>
							</tr>
						</table>

						
						
						<?php if (WC_Wishlists_Settings::get_setting( 'wc_wishlist_notifications_enabled', 'disabled' ) == 'enabled'): ?>
						<p><?php _e('Email Notifications', 'wc_wishlist'); ?></p>
						<p class="form-row">
							<table class="wl-rad-table">
								<tr>
									<td><input type="radio" id="rad_notification_yes" name="wishlist_owner_notifications" value="yes" <?php checked( 'yes', $notifications ); ?>></td>
									<td><label for="rad_notification_yes"><?php _e( 'Yes', 'wc_wishlist' ); ?> <span class="wl-small">- <?php _e( 'Send me an email if a price reduction occurs.', 'wc_wishlist' ); ?></span></label></td>
								</tr>
								<tr>
									<td><input type="radio" id="rad_notification_no" name="wishlist_owner_notifications" value="no" <?php checked( 'no', $notifications ); ?>></td>
									<td><label for="rad_notification_no"><?php _e( 'No', 'wc_wishlist' ); ?> <span class="wl-small">- <?php _e( 'Do not send me an email if a price reduction occurs.', 'wc_wishlist' ); ?></span></label></td>
								</tr>
							</table>
						</p>
						<?php endif; ?>
						
					</form>
					<div class="wl-clear"></div>
				</div><!-- /wl form -->










				<form action="<?php $wishlist->the_url_edit(); ?>" method="post" class="wl-form" id="wl-items-form">
					<input type="hidden" name="wlid" value="<?php echo $wishlist->id; ?>" />
					<?php WC_Wishlists_Plugin::nonce_field( 'manage-list' ); ?>
					<?php echo WC_Wishlists_Plugin::action_field( 'manage-list' ); ?>
					<input type="hidden" name="wlmovetarget" id="wlmovetarget" value="0" />

					

					<table class="shop_table cart wl-table manage" cellspacing="0">
						<thead>
							<tr>
								<th class="check-column"><input type="checkbox" name="" value="" /></th>
								<th class="product-remove">&nbsp;</th>
								<th class="product-thumbnail">&nbsp;</th>
								<th class="product-name"><?php _e( 'Product', 'wc_wishlist' ); ?></th>
								<th class="product-price"><?php _e( 'Price', 'wc_wishlist' ); ?></th>
								<th class="product-quantity ctr"><?php _e( 'Qty', 'wc_wishlist' ); ?></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ( $wishlist_items as $wishlist_item_key => $item ) {
								$_product = $item['data'];
								if ( $_product->exists() && $item['quantity'] > 0 ) {
									?>
									<tr class="cart_table_item">
										<td class="check-column" >
											<input type="checkbox" name="wlitem[]" value="<?php echo $wishlist_item_key; ?>" />
										</td>
										<td class="product-remove">
											<a href="<?php echo woocommerce_wishlist_url_item_remove( $wishlist->id, $wishlist_item_key ); ?>" class="remove wlconfirm" title="<?php _e( 'Remove this item from your wishlist', 'wc_wishlist' ); ?>" data-message="<?php esc_attr( _e( 'Are you sure you would like to remove this item from your list?', 'wc_wishlist' ) ); ?>">&times;</a>
										</td>

										<!-- The thumbnail -->
										<td class="product-thumbnail">
											<?php
											printf( '<a href="%s">%s</a>', esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product_id', $item['product_id'] ) ) ), $_product->get_image() );
											?>
										</td>

										<td class="product-name">
											<?php
											if ( WC_Wishlist_Compatibility::is_wc_version_gte_2_1() ) {
												if ( !$_product->is_visible() ) {
													echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $item, $wishlist_item_key );
												} else {
													echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( is_array( $item['variation'] ) ? add_query_arg( $item['variation'], $_product->get_permalink() ) : $_product->get_permalink() ), $_product->get_title() ), $item, $wishlist_item_key );
												}
											} else {
												printf( '<a href="%s">%s</a>', esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product_id', $item['product_id'] ) ) ), apply_filters( 'woocommerce_in_wishlist_product_title', $_product->get_title(), $_product, $wishlist_item_key ) );
											}

											// Meta data
											echo $woocommerce->cart->get_item_data( $item );

											// Availability
											$availability = $_product->get_availability();

											if ( $availability['availability'] ) :
												echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
											endif;
											?>

											<?php do_action( 'woocommerce_wishlist_after_list_item_name', $item, $wishlist ); ?>
										</td>

										<!-- Product price -->
										<td class="product-price">
											<?php
											if ( WC_Wishlist_Compatibility::is_wc_version_gte_2_1() ) {
												$price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $item, $wishlist_item_key );
											} else {
												$product_price = ( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) ? $_product->get_price_excluding_tax() : $_product->get_price();
												$price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $item, $wishlist_item_key );
											}
											?>

											<?php echo apply_filters( 'woocommerce_wishlist_list_item_price', $price, $item, $wishlist ); ?>
										</td>

										<!-- Quantity inputs -->
										<td class="product-quantity">
											<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $wishlist_item_key );
											} else {
												$product_quantity_value = apply_filters( 'woocommerce_wishlist_list_item_quantity_value', $item['quantity'], $item, $wishlist );

												$step = apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
												$min = apply_filters( 'woocommerce_quantity_input_min', '', $_product );
												$max = apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

												$product_quantity = sprintf( '<div class="quantity"><input type="text" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $wishlist_item_key, $step, $min, $max, esc_attr( $product_quantity_value ) );
											}
											?>

											<?php echo $product_quantity; ?>

										</td>
										<?php if ( $treat_as_registry ) : ?>
											<td class="product-quantity">
												<?php $quantity_purchased = apply_filters( 'woocommerce_wishlist_item_purchased_quantity', isset( $item['quantity_purchased'] ) ? $item['quantity_purchased'] : 0, $wishlist_item_key ); ?>
												<?php
												$quantity_remaining = (int) $item['quantity'] - (int) $quantity_purchased;
												$quantity_remaining = $quantity_remaining > 0 ? absint( $quantity_remaining ) : 0;
												?>
												<?php echo apply_filters( 'woocommerce_wishlist_item_needs_quantity', $quantity_remaining, $wishlist_item_key ); ?>
											</td>
										<?php endif; ?>
										<td class="product-purchase">
											<?php if ( $_product->product_type != 'external' && $_product->is_in_stock() && apply_filters( 'woocommerce_wishlist_user_can_purcahse', true, $_product ) ) : ?>
												<a href="<?php echo woocommerce_wishlist_url_item_add_to_cart( $wishlist->id, $wishlist_item_key, $wishlist->get_wishlist_sharing() == 'Shared' ? $wishlist->get_wishlist_sharing_key() : false, 'edit' ); ?>" class="button alt"><?php _e( 'Add to Cart', 'wc_wishlist' ); ?></a>
											<?php elseif ( $_product->product_type == 'external' ) : ?>
												<a href="<?php echo esc_url( $_product->get_product_url() ); ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo $_product->single_add_to_cart_text(); ?></a>
											<?php endif; ?>

										</td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>


					<div class="wl-row">
						<table width="100%" cellpadding="0" cellspacing="0" class="wl-actions-table">
							<tbody>
								<tr>
									<td>
										<select class="wl-sel move-list-sel" name="wlupdateaction" id="wleditaction1">
											<option selected="selected"><?php _e( 'With Selection...', 'wc_wishlist' ); ?></option>
											<option value="add-to-cart"><?php _e( 'Add to Cart', 'wc_wishlist' ); ?></option>
											<option value="quantity"><?php _e( 'Update Quantities', 'wc_wishlist' ); ?></option>
											<option value="quantity-add-to-cart"><?php _e( 'Update Quantities and Add to Cart', 'wc_wishlist' ); ?></option>
											<option value="remove"><?php _e( 'Remove from List', 'wc_wishlist' ); ?></option>
											<optgroup label="<?php _e( 'Move to another List', 'wc_wishlist' ); ?>">
												<?php $lists = WC_Wishlists_User::get_wishlists(); ?>
												<?php if ( $lists && count( $lists ) ) : ?>
													<?php foreach ( $lists as $list ) : ?>
														<?php if ( $list->id != $wishlist->id ) : ?>
															<option value="<?php echo $list->id; ?>"><?php $list->the_title(); ?> ( <?php echo $wishlist->get_wishlist_sharing( true ); ?> )</option>
														<?php endif; ?>
													<?php endforeach; ?>
												<?php endif; ?>
												<option value="create"><?php _e( '+ Create A New List', 'wc_wishlist' ); ?></option>
											</optgroup>
										</select>
									<td>
										<button class="button small wl-but wl-add-to btn-apply"><?php _e( 'Go', 'wc_wishlist' ); ?></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div><!-- wl-row wl-clear -->




				</form>

			<?php else : ?>
				<?php $shop_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
				<?php _e( 'You do not have anything in this list.', 'wc_wishlist' ); ?> <a href="<?php echo $shop_url; ?>"><?php _e( 'Go Shopping', 'wc_wishlist' ); ?></a>.

			<?php endif; ?>


	<?php woocommerce_wishlists_get_template( 'wishlist-email-form.php', array('wishlist' => $wishlist) ); ?>
</div>

<?php do_action( 'woocommerce_wishlists_after_wrapper' ); ?>