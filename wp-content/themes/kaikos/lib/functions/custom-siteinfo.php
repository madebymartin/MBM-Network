<?php function childtheme_override_siteinfo() { ?>

Copyright © <?php bloginfo( 'name'); ?> <?php echo date('Y'); ?>   |   Website created by <a href="http://totallydesignandprint.com" target="blank">TDP</a>

<ul>
<li>
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
      echo "/wp-admin/\">Dashboard</a>";
      } else { ?>
<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
<?php } ?>

</li>
</ul>


<?php wp_nav_menu( array(
	'menu' => 'Footer menu',
	'container'       => '',
	'container_class' => '',
	'menu_id' => '',
	'menu_class' => ''
	)); ?>






<?php } 
?>