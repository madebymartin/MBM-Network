<?php function childtheme_override_siteinfo() { ?>

<?php wp_nav_menu( array(
	'menu' => 'Footer menu',
	'container'       => '',
	'container_class' => '',
	'menu_id' => '',
	'menu_class' => 'footermenu'
	)); ?>


<ul class="footermenu right">

<?php
global $current_user;
get_currentuserinfo();
if (!(is_user_logged_in())) { ?>

<?php } elseif
    (
    (($current_user->user_login) == "editor")   ||
    (($current_user->user_login) == "admin")
    )
    {
      echo "<li>";
	  echo "<a href=\"";
      echo get_option('siteurl');
      echo "/wp-admin/\">Dashboard</a>";
	  echo "</li>";
      } else { ?>
<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></li>
<?php } ?>

<li class="copyright">© 2010-<?php echo date("Y");?> <?php bloginfo( 'name' ); ?></li>
</ul>


<div class="clear"></div>

<?php
        }

    //	add_action('thematic_footer', 'childtheme_override_siteinfo', 40);

?>
