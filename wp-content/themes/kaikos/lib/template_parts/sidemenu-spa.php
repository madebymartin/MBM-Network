<div class="aside main-aside">
<h3>Spa Treatments</h3>
<?php 
$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
'taxonomy'     => 'spacategory',
'having_images' => 'true',
) );
print '<ul class="sidebarbuttons">';
if ( ! empty( $terms ) ) {
    foreach( (array) $terms as $term ) {
        print '<li><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '">' . wp_get_attachment_image( $term->image_id, 'tiny' ) . '' . esc_html( $term->name ) . '</a></li>';
    }
}
print '</ul>';
?>
</div>