<?php
/**
 * Template part for displaying the share icons.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package paloma
 */

?>

<div class="share-group">
		<a class="fb-share-button share-button" href="#" onclick="
					window.open(
					  'https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>',
					  'facebook-share-dialog',
					  'width=625,height=430'
					); return false;" href="#" title="Facebook">			
	    	<i class="fa fa-facebook fa-fw"></i>
	    	<span><?php _e('Share', 'paloma');?></span>
	    </a>

    	<a class="pinterest-share share-button" data-pin-do="buttonBookmark" data-pin-custom="true" href="//www.pinterest.com/pin/create/button/" data-pin-url="<?php the_permalink(); ?>">
    		<i class="fa fa-pinterest fa-fw"></i>
    		<span><img src="#"><?php _e('Pin', 'paloma');?></span>
    	</a>

		<a class="twitter action-button twitter-share share-button" onclick="
					window.open(
					  'https://twitter.com/intent/tweet?text=<?php the_title();?> <?php the_permalink();?>',
					  'twitter-share-dialog',
					  'width=625,height=430'
					); return false;" href="#" title="Twitter">
			<i class="fa fa-twitter fa-fw"></i>
			<span><?php _e('Tweet', 'paloma');?></span>
		</a>

		<a class="email-share share-button" href="mailto:">
			<i class="fa fa-envelope fa-fw"></i>
			<span><?php _e('Email', 'paloma');?></span>
		</a>

		<a class="comment-share share-button" href="<?php echo the_permalink() . '#respond';?>">
			<i class="fa fa-comment fa-fw"></i>
			<span><?php _e('Comment', 'paloma');?></span>
		</a>
</div>
