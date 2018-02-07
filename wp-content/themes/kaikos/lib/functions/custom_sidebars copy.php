<?php
function customsidebars() { 

?>
<div class="aside main-aside">

<h3 class="phone">Telephone
<span><br>0121 421 3243</span>
</h3>


<h3 class="address">Find Us
<span><br>
282 Hagley Road West<br>
Quinton<br>
Birmingham<br>
B68 0NR</span>
</h3>

</div>

<?php
	if(is_tax('haircategory') ) { ?>
<div class="aside main-aside">
<h3>Hair Treatments</h3>
<?php 
$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
'taxonomy'     => 'haircategory',
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
<?php }



	elseif(is_tax('spacategory') ) { ?>
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
<?php }


	elseif(is_tax('beautycategory') ) { ?>
<div class="aside main-aside">
<h3>Beauty Treatments</h3>
<?php 
$terms = apply_filters( 'taxonomy-images-get-terms', '', array(
'taxonomy'     => 'beautycategory',
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
<?php }





} 
add_action('thematic_betweenmainasides','customsidebars', 9);
?>