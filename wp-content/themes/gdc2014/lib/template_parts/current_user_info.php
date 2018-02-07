<?php 
$current_user = wp_get_current_user();
$currentuserid = get_current_user_id();
$accountnumber = get_user_meta($currentuserid, 'accountnumber');
$accountname =  get_user_meta($currentuserid, 'accountname');
echo '<div class="note">';
echo 'Signed in as: ' . $current_user->display_name . '<br>';
echo 'Account Number: ' . $accountnumber['0'] . '<br>';
echo 'Account Name: ' . $accountname['0'] . '<br>';
echo '</div>';
?>