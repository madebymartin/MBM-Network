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
        print '<li><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><span class="sidebuttonoverlay"></span>' . wp_get_attachment_image( $term->image_id, 'tiny' ) . '<span class="linktitle">' . esc_html( $term->name ) . '</span></a></li>';
    }
}
print '</ul>';
?>
</div>