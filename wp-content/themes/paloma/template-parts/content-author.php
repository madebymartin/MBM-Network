<?php
/**
 * Template part for displaying author bio content in single.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */
?>
<?php $id = get_the_author_meta( 'ID' ); ?> 

<div class="author-info">
	<div class="author-photo">
		<?php 	$author_photo = get_field('author_photo', 'user_'. $id ); 

			if ($author_photo) {
				// image vars
				$url = $author_photo['url'];
				$alt = $author_photo['alt'];
				echo '<img src="' , $url , '" alt="' , $alt , '">'; 
			}
		?>

	</div>


	<div class="author-bio">
		<?php //author info
		$author_website = get_field('author_website', 'user_'. $id ); 
		$author_facebook = get_field('author_facebook', 'user_'. $id ); 
		$author_twitter = get_field('author_twitter', 'user_'. $id ); 
		$author_pinterest = get_field('author_pinterest', 'user_'. $id ); 
		$author_instagram = get_field('author_instagram', 'user_'. $id ); ?>

		<h3>
			<?php if ($author_website) { ?>
				<a href="<?php echo $author_website; ?>" target="_blank">
			<?php }

				echo __('Author: ', 'stnsvn'); the_author();

			 if ($author_website) { ?>
				</a>
			<?php } ?>

		</h3>

		<p><?php the_author_meta( 'description' ); ?> </p>

		<div class="author-social">
			<?php if ($author_facebook) { ?>
				<a href="<?php echo $author_facebook; ?>" target="_blank">
					<i class="fa fa-facebook" aria-hidden="true"></i>
				</a>
			<?php }

			if ($author_twitter) { ?>
				<a href="<?php echo $author_twitter; ?>" target="_blank">
					<i class="fa fa-twitter" aria-hidden="true"></i>
				</a>
			<?php }

			if ($author_pinterest) { ?>
				<a href="<?php echo $author_pinterest; ?>" target="_blank">
					<i class="fa fa-pinterest" aria-hidden="true"></i>
				</a>
			<?php }

			if ($author_instagram) { ?>
				<a href="<?php echo $author_instagram; ?>" target="_blank">
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</a>
			<?php } ?>

		</div>

	</div>
	
</div>

