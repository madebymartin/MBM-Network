<?php
/* Add "Trade Customer" role */
add_role('trade-customer', 'Trade Customer', array(
    'read' => true, // True allows that capability
    'edit_posts' => false,
    'delete_posts' => false,
	'access_trade_content' => true,
));

?>