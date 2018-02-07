<?php
// Register User Contact Methods
add_filter( 'user_contactmethods', 'gdc_custom_user_contact_methods' );
function gdc_custom_user_contact_methods( $contactmethods ) {

    $contactmethods['phone'] = __( 'Phone', 'gdc' );

    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    unset($contactmethods['twitter']);
    unset($contactmethods['facebook']);
    unset($contactmethods['googleplus']);
    unset($contactmethods['web']);

    return $contactmethods;
}




add_action( 'personal_options_update', 'gdc_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'gdc_save_extra_profile_fields' );
function gdc_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    /* Copy and paste this line for additional fields. */
    update_usermeta( $user_id, 'accountphone', $_POST['accountphone'] );
   
    update_usermeta( $user_id, 'shipping-first_name', $_POST['shipping-first_name'] );
    update_usermeta( $user_id, 'shipping-last_name', $_POST['shipping-last_name'] );
    update_usermeta( $user_id, 'shipping-company', $_POST['shipping-company'] );
    update_usermeta( $user_id, 'shipping-address', $_POST['shipping-address'] );
    update_usermeta( $user_id, 'shipping-address-2', $_POST['shipping-address-2'] );
    update_usermeta( $user_id, 'shipping-city', $_POST['shipping-city'] );
    update_usermeta( $user_id, 'shipping-state', $_POST['shipping-state'] );
    update_usermeta( $user_id, 'shipping-postcode', $_POST['shipping-postcode'] );

    update_usermeta( $user_id, 'billing-first_name', $_POST['billing-first_name'] );
    update_usermeta( $user_id, 'billing-last_name', $_POST['billing-last_name'] );
    update_usermeta( $user_id, 'billing-company', $_POST['billing-company'] );
    update_usermeta( $user_id, 'billing-address', $_POST['billing-address'] );
    update_usermeta( $user_id, 'billing-address-2', $_POST['billing-address-2'] );
    update_usermeta( $user_id, 'billing-city', $_POST['billing-city'] );
    update_usermeta( $user_id, 'billing-state', $_POST['billing-state'] );
    update_usermeta( $user_id, 'billing-postcode', $_POST['billing-postcode'] );

}


add_action( 'show_user_profile', 'gdc_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'gdc_show_extra_profile_fields' );
function gdc_show_extra_profile_fields( $user ) { ?>

    <h3>Custom Meta Boxes</h3>
    <table class="form-table">
            <tr>
                <th><label for="accountphone">Telephone</label></th>
                <td><input type="text" name="accountphone" id="accountphone" value="<?php echo esc_attr( get_the_author_meta( 'accountphone', $user->ID ) ); ?>" class="regular-text" /><br /></td>
            </tr>
    </table>


    <hr>
    <?php 
    
    // SHIPPING INFO
    $shipping_first_name = esc_attr( get_the_author_meta( 'shipping-first_name', $user->ID ) );
    $shipping_last_name = esc_attr( get_the_author_meta( 'shipping-last_name', $user->ID ) );
    $shipping_company = esc_attr( get_the_author_meta( 'shipping-company', $user->ID ) );
    $shipping_address = esc_attr( get_the_author_meta( 'shipping-address', $user->ID ) );
    $shipping_address2 = esc_attr( get_the_author_meta( 'shipping-address-2', $user->ID ) );
    $shipping_city = esc_attr( get_the_author_meta( 'shipping-city', $user->ID ) );
    $shipping_state = esc_attr( get_the_author_meta( 'shipping-state', $user->ID ) );
    $shipping_postcode = esc_attr( get_the_author_meta( 'shipping-postcode', $user->ID ) );

    if($shipping_first_name){
        echo '<hr><h3>Shipping Information</h3><table class="form-table">';

            if($shipping_first_name){
                echo '<tr><th><label>Name</label></th>';
                echo '<td>' . $shipping_first_name . ' ' . $shipping_last_name . '</td></tr>';
            }
            if($shipping_company){
                echo '<tr><th><label for="shipping-first_name">Company</label></th>';
                echo '<td>' . $shipping_company . '</td></tr>';
            }
            if($shipping_address){
                echo '<tr><th><label for="shipping-first_name">Address</label></th><td>';
                echo $shipping_address . '<br>';
            }
            if($shipping_address2){
                echo $shipping_address2 . '<br>';
            }
            if($shipping_city){
                echo $shipping_city . '<br>';
            }
            if($shipping_state){
                echo $shipping_state . '<br>';
            }
            if($shipping_postcode){
                echo $shipping_postcode . '';
            }
        echo '</td></tr></table>';
    }


    // BILLING INFO
    $billing_first_name = esc_attr( get_the_author_meta( 'billing-first_name', $user->ID ) );
    $billing_last_name = esc_attr( get_the_author_meta( 'billing-last_name', $user->ID ) );
    $billing_company = esc_attr( get_the_author_meta( 'billing-company', $user->ID ) );
    $billing_address = esc_attr( get_the_author_meta( 'billing-address', $user->ID ) );
    $billing_address2 = esc_attr( get_the_author_meta( 'billing-address-2', $user->ID ) );
    $billing_city = esc_attr( get_the_author_meta( 'billing-city', $user->ID ) );
    $billing_state = esc_attr( get_the_author_meta( 'billing-state', $user->ID ) );
    $billing_postcode = esc_attr( get_the_author_meta( 'billing-postcode', $user->ID ) );
    $billing_phone = esc_attr( get_the_author_meta( 'billing-phone', $user->ID ) );

    if($shipping_first_name){
        echo '<hr><h3>Billing Information</h3><table class="form-table">';

            if($billing_first_name){
                echo '<tr><th><label for="billing-first_name">Name</label></th>';
                echo '<td>' . $shipping_first_name . ' ' . $shipping_last_name . '</td></tr>';
            }
            if($billing_company){
                echo '<tr><th><label for="billing-first_name">Company</label></th>';
                echo '<td>' . $shipping_company . '</td></tr>';
            }
            if($billing_address){
                echo '<tr><th><label for="billing-first_name">Address</label></th>';
                echo '<td>' . $shipping_address . '<br>';
            }
            if($billing_address2){
                echo $shipping_address2 . '<br>';
            }
            if($billing_city){
                echo $shipping_city . '<br>';
            }
            if($billing_state){
                echo $shipping_state . '<br>';
            }
            if($billing_postcode){
                echo $shipping_postcode . '<br></td></tr>';
            }
            if($billing_phone){
                echo '<tr><th><label for="billing-phone">Phone</label></th>';
                echo '<td>' . $billing_phone . '</td></tr>';
            }
        echo '</td></tr></table><hr><br>';

    }
}
