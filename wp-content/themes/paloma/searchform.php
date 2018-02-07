<?php
/**
 * Template for displaying search forms in paloma
 *
 * @package paloma
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'paloma' ); ?></span>
	</label>
    <input type="search" id="<?php echo $unique_id; ?>"
    class="search-field"
    placeholder="<?php echo _x( 'Search', 'Search field placeholder', 'paloma' ); ?>"
    value="<?php echo get_search_query() ?>" 
    name="s" />
	<button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'paloma' ); ?></span>
	</button>
</form>