<ul>
<!-- LOGIN LOGOUT LINK -->

<?php
global $current_user;
get_currentuserinfo();
if (!(is_user_logged_in())) { ?>

<li>
<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Login</a>
</li>

<?php } elseif
    (
    (($current_user->user_login) == "brock")   ||
    (($current_user->user_login) == "admin")
    )
    {
      echo "<li>";
	  echo "<a href=\"";
      echo get_option('siteurl');
      echo "/wp-admin/\">Dashboard</a>";
	  echo "</li>";
      } else { ?>
<li>
<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
</li>
<?php } ?>
	

<!-- ADMIN LINK IF LOGGED IN AS ADMINISTRATOR -->
<?php if (current_user_can('administrator')){ ?>
<li>
<a href="<?php echo site_url(); ?>/wp-admin">Admin</a>
</li>
<?php }else{ ?>
<!-- Add content for non-trade roles here... -->
<?php }?>

</ul>
