<?php
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Account information</h3>

	<table class="form-table">





		<tr>
			<th><label for="accountnumber">Account Number</label></th>

			<td>
				<input type="text" name="accountnumber" id="accountnumber" value="<?php echo esc_attr( get_the_author_meta( 'accountnumber', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>


		<tr>
			<th><label for="region">Region</label></th>

			<td>
				<input type="text" name="region" id="region" value="<?php echo esc_attr( get_the_author_meta( 'region', $user->ID ) ); ?>" class="regular-text" /><br />
			</td>
		</tr>




	</table>





<?php }


add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'accountnumber', $_POST['accountnumber'] );
	update_usermeta( $user_id, 'region', $_POST['region'] );
}


?>