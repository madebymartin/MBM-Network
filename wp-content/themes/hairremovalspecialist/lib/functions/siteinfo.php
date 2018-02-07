<?php function childtheme_override_siteinfo() { ?>

<a class="logo babtac" href="http://www.babtac.com/" target="blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/babtac.png" alt="babtac" title="babtac" /></a>
<a class="logo" href="http://www.electrolysis.co.uk/" target="blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/biae-logo.png" alt="biae" title="biae" /></a>



<ul class="floatleft">
<li>Copyright &#64; <?php echo date('Y'); ?> <?php bloginfo( 'name'); ?> - All Rights Reserved
</li>


<?php if ( get_post_meta(8, "_cmb_phone", true) ) { ?>
	<li>Telephone: <?php echo get_post_meta(8, "_cmb_phone", true); ?></li>	
<?php } else { ?>		
<?php }?>



	<?php
  global $current_user;
  get_currentuserinfo();
	if (!(is_user_logged_in())) { ?>

<?php } elseif
    (
    (($current_user->user_login) == "admin")
    )
    {
      echo "<a href=\"";
      echo get_option('siteurl');
      echo "/wp-admin/\">Dashboard</a></li>";
      } else { ?>
<li><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a></li>
<?php } ?>


</ul>


<?php wp_nav_menu( array(
	'menu' => 'Footer menu',
	'container'       => '',
	'container_class' => '',
	'menu_id' => '',
	'menu_class' => 'floatright'
	)); ?>





<?php } 
?>