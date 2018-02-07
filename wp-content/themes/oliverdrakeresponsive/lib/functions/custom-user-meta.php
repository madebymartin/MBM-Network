<?php
add_filter('user_contactmethods','adjust_contact_methods',10,1);
function adjust_contact_methods( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  unset($contactmethods['twitter']);
  unset($contactmethods['googleplus']);
  return $contactmethods;
}

add_action( 'personal_options', array ( 'T5_Hide_Profile_Bio_Box', 'start' ) );
//* Captures the part with the biobox in an output buffer and removes it.
//* @author Thomas Scholz, <info@toscho.de>
class T5_Hide_Profile_Bio_Box
{
     //* Called on 'personal_options'.
     //* @return void
    public static function start()
    {
        $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
        add_action( $action, array ( __CLASS__, 'stop' ) );
        ob_start();
    }
    //Strips the bio box from the buffered content.
    //@return void
    public static function stop()
    {
        $html = ob_get_contents();
        ob_end_clean();

        // remove the headline
        $headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
        $html = str_replace( '<h3>' . $headline . '</h3>', '', $html );

        // remove the table row
        $html = preg_replace( '~<tr>\s*<th><label for="description".*</tr>~imsUu', '', $html );
        print $html;

    }
}




// ADD META FIELD DISPLAY / INPUT
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>

	<h3>Account information</h3>
	<table class="form-table">
		<tr>
			<th><label for="accountnumber">Account Number</label></th>
			<td><input type="text" name="accountnumber" id="accountnumber" value="<?php echo esc_attr( get_the_author_meta( 'accountnumber', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="accountnumber">Phone Number</label></th>
			<td><input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="accountnumber">Address 1</label></th>
			<td><input type="text" name="address1" id="address1" value="<?php echo esc_attr( get_the_author_meta( 'address1', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="accountnumber">Address 2</label></th>
			<td><input type="text" name="address2" id="address2" value="<?php echo esc_attr( get_the_author_meta( 'address2', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="accountnumber">Town</label></th>
			<td><input type="text" name="town" id="town" value="<?php echo esc_attr( get_the_author_meta( 'town', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="accountnumber">County</label></th>
			<td><input type="text" name="county" id="county" value="<?php echo esc_attr( get_the_author_meta( 'county', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="accountnumber">Postcode</label></th>
			<td><input type="text" name="postcode" id="postcode" value="<?php echo esc_attr( get_the_author_meta( 'postcode', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

	</table>
<?php }



// RECORD META FIELDS
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'accountnumber', $_POST['accountnumber'] );
	update_usermeta( $user_id, 'phone', $_POST['phone'] );
	update_usermeta( $user_id, 'address1', $_POST['address1'] );
	update_usermeta( $user_id, 'address2', $_POST['address2'] );
	update_usermeta( $user_id, 'town', $_POST['town'] );
	update_usermeta( $user_id, 'county', $_POST['county'] );
	update_usermeta( $user_id, 'postcode', $_POST['postcode'] );
}
?>