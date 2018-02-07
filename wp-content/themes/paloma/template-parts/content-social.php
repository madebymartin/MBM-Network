<?php
/**
 * Template part for displaying the social icons.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

<?php //grab vars from customizer
    $stnsvn_fb_link = get_theme_mod( 'stnsvn_fb_link', '' );
    $stnsvn_pinterest_link = get_theme_mod( 'stnsvn_pinterest_link', '' );
    $stnsvn_instagram_link = get_theme_mod( 'stnsvn_instagram_link', '' );
    $stnsvn_twitter_link = get_theme_mod( 'stnsvn_twitter_link', '' );
    $stnsvn_google_link = get_theme_mod( 'stnsvn_google_link', '' );
    $stnsvn_bloglovin_link = get_theme_mod( 'stnsvn_bloglovin_link', '' );
    $stnsvn_custom_icon_1 = get_theme_mod( 'stnsvn_custom_icon_1', '' );
    $stnsvn_custom_icon_1_link = get_theme_mod( 'stnsvn_custom_icon_1_link', '' );
    $stnsvn_custom_icon_2 = get_theme_mod( 'stnsvn_custom_icon_2', '' );
    $stnsvn_custom_icon_2_link = get_theme_mod( 'stnsvn_custom_icon_2_link', '' );
    $stnsvn_custom_icon_3 = get_theme_mod( 'stnsvn_custom_icon_3', '' );
    $stnsvn_custom_icon_3_link = get_theme_mod( 'stnsvn_custom_icon_3_link', '' );
    $stnsvn_custom_icon_4 = get_theme_mod( 'stnsvn_custom_icon_4', '' );
    $stnsvn_custom_icon_4_link = get_theme_mod( 'stnsvn_custom_icon_4_link', '' );
    $stnsvn_custom_icon_5 = get_theme_mod( 'stnsvn_custom_icon_5', '' );
    $stnsvn_custom_icon_5_link = get_theme_mod( 'stnsvn_custom_icon_5_link', '' );
    $stnsvn_custom_icon_6 = get_theme_mod( 'stnsvn_custom_icon_6', '' );
    $stnsvn_custom_icon_6_link = get_theme_mod( 'stnsvn_custom_icon_6_link', '' );
    $stnsvn_target_blank = get_theme_mod( 'stnsvn_target_blank', 1 );
?>

<span class="stnsvn-social-icons">
	<?php //Facebook
		if ($stnsvn_fb_link || '' ){ ?>
			<a href="<?php echo $stnsvn_fb_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>
				<i class="fa fa-facebook fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Pinterest
		if ($stnsvn_pinterest_link || '' ){ ?>
			<a href="<?php echo $stnsvn_pinterest_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>
				<i class="fa fa-pinterest-p fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Instagram
		if ($stnsvn_instagram_link || '' ){ ?>
			<a href="<?php echo $stnsvn_instagram_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>
				<i class="fa fa-instagram fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Twitter
		if ($stnsvn_twitter_link || '' ){ ?>
			<a href="<?php echo $stnsvn_twitter_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>
				<i class="fa fa-twitter fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Google+
		if ($stnsvn_google_link || '' ){ ?>
			<a href="<?php echo $stnsvn_google_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>
				<i class="fa fa-google-plus fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Bloglovin'
		if ($stnsvn_bloglovin_link || '' ){ ?>
			<a href="<?php echo $stnsvn_bloglovin_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>
				<i class="fa fa-heart fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Custom icon 1
		if ( $stnsvn_custom_icon_1 || '' ){ ?>
			<a href="<?php echo $stnsvn_custom_icon_1_link; ?>" 
				<?php //set target blank
					if ($stnsvn_target_blank == 1){ 
						echo 'target="_blank"'; 
				} ?> 
			>

				<?php //Display custom FA icon ?>
				<i class="fa fa-<?php echo $stnsvn_custom_icon_1; ?> fa-fw"></i>
			</a>
	<?php } ?>

	<?php //Custom icon 2
	if ( $stnsvn_custom_icon_2 || '' ){ ?>
		<a href="<?php echo $stnsvn_custom_icon_2_link; ?>" 
			<?php //set target blank
				if ($stnsvn_target_blank == 1){ 
					echo 'target="_blank"'; 
			} ?> 
		>

			<?php //Display custom FA icon ?>
			<i class="fa fa-<?php echo $stnsvn_custom_icon_2; ?> fa-fw"></i>
		</a>
	<?php } ?>

	<?php //Custom icon 3
	if ( $stnsvn_custom_icon_3 || '' ){ ?>
		<a href="<?php echo $stnsvn_custom_icon_3_link; ?>" 
			<?php //set target blank
				if ($stnsvn_target_blank == 1){ 
					echo 'target="_blank"'; 
			} ?> 
		>

			<?php //Display custom FA icon ?>
			<i class="fa fa-<?php echo $stnsvn_custom_icon_3; ?> fa-fw"></i>
		</a>
	<?php } ?>

	<?php //Custom icon 4
	if ( $stnsvn_custom_icon_4 || '' ){ ?>
		<a href="<?php echo $stnsvn_custom_icon_4_link; ?>" 
			<?php //set target blank
				if ($stnsvn_target_blank == 1){ 
					echo 'target="_blank"'; 
			} ?> 
		>

			<?php //Display custom FA icon ?>
			<i class="fa fa-<?php echo $stnsvn_custom_icon_4; ?> fa-fw"></i>
		</a>
	<?php } ?>

	<?php //Custom icon 5
	if ( $stnsvn_custom_icon_5 || '' ){ ?>
		<a href="<?php echo $stnsvn_custom_icon_5_link; ?>" 
			<?php //set target blank
				if ($stnsvn_target_blank == 1){ 
					echo 'target="_blank"'; 
			} ?> 
		>

			<?php //Display custom FA icon ?>
			<i class="fa fa-<?php echo $stnsvn_custom_icon_5; ?> fa-fw"></i>
		</a>
	<?php } ?>

	<?php //Custom icon 6
	if ( $stnsvn_custom_icon_6 || '' ){ ?>
		<a href="<?php echo $stnsvn_custom_icon_6_link; ?>" 
			<?php //set target blank
				if ($stnsvn_target_blank == 1){ 
					echo 'target="_blank"'; 
			} ?> 
		>

			<?php //Display custom FA icon ?>
			<i class="fa fa-<?php echo $stnsvn_custom_icon_6; ?> fa-fw"></i>
		</a>
	<?php } ?>

</span>
