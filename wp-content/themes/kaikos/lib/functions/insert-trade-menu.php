<?php
function trade_downloads() {
?>

<!-- TRADE MENU IF LOGGED IN AS TRADE -->

	<?php
	if (current_user_can('trade-customer')){ ?>
<?php
    //menu for editor role
    wp_nav_menu( array(
	'menu' => 'Trade Only',
	'container'       => 'ul',
	'container_class' => '',
	'menu_id' => '',
	'menu_class' => 'trademenu'
	)); ?>
	<?php 
	}else{
    //Add content for non-trade roles here...
	} ?>


<!-- TRADE MENU IF LOGGED IN AS ADMIN -->

	<?php
	if (current_user_can('administrator')){ ?>
<?php
    //menu for editor role
    wp_nav_menu( array(
	'menu' => 'Trade Only',
	'container'       => 'ul',
	'container_class' => '',
	'menu_id' => '',
	'menu_class' => 'trademenu'
	)); ?>
	<?php 
	}else{
    //Add content for non-trade roles here...
	} ?>


<!-- TRADE MENU IF LOGGED IN AS DISTRIBUTOR -->

	<?php
	if (current_user_can('distributor')){ ?>
<?php
    //menu for editor role
    wp_nav_menu( array(
	'menu' => 'Trade Only',
	'container'       => 'ul',
	'container_class' => '',
	'menu_id' => '',
	'menu_class' => 'trademenu'
	)); ?>
	<?php 
	}else{
    //Add content for non-trade roles here...
	} ?>




<?php
}
add_action('thematic_abovemainasides','trade_downloads', 7);
?>