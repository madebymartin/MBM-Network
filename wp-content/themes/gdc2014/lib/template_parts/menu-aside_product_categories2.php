<?php
    $args = array(
        'parent'        =>  '0',
        'hide_empty' => '0',
        'exclude'   => '239',
    );
    $categories = get_terms( 'product_cat', $args );

$queried_object = get_queried_object();
$current_term = $queried_object->name;

if ( sizeof( $categories ) ) { ?>
    <div class="aside-category-list">
        <ul>

            <?php 
            foreach ( $categories as $category ) :
                $term = get_term_by( 'id', $category->term_id, 'product_cat' );
                $term_name = $term->name;
                $term_id = $category->term_id;
                $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ); 
                //$image = wp_get_attachment_url( $thumbnail_id );
                $image = wp_get_attachment_image_src( $thumbnail_id, '200sq')['0'];
                if(!empty($image)){$thumb_image = '<img src="' . $image . '" alt="' . $term_name . '" />';}
                else{$thumb_image = '<img src="//wc.germaine-de-capuccini.co.uk/wp-content/themes/gdc_responsive/images/gdc-background.jpg"/>';}
                
                if ($term_name == $current_term){ $currentclass = ' currentitem'; } else{$currentclass = '';}

                if ( ! empty( $term )) :
                    echo '<li class="asideproductcat' . $currentclass . '"><a href="' . get_term_link( $term->slug, 'product_cat' ) . '" title="' . $term_name . '"><div class="image-wrap">' . $thumb_image . '<span class="info-icon"></span></div><p>' . $term_name . '</p></a></li>';
                endif;
            endforeach; ?>
                    
        </ul>
    </div>
<br>
<?php } else {} ?>