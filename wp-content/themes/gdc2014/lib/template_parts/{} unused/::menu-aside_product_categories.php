<div class="aside buyit">
	<?php
    $args = array(
        'parent'        =>  '0',
        'hide_empty' => '0',
        'exclude'   => '239',
    );
    $categories = get_terms( 'product_cat', $args );



if ( sizeof( $categories ) ) { ?>


    <div class="aside-category-list">
        <ul>
            <?php foreach ( $categories as $category ) :
                $term = get_term_by( 'id', $category->term_id, 'product_cat' );
                if ( ! empty( $term )) :
                    $title = $term->name;
                    $thumb = jigoshop_product_cat_image( $term->term_id );
                    if ( $thumb['thumb_id'] )
                      $thumb_image = wp_get_attachment_image( $thumb['thumb_id'], '200sq' );
                    else
                      $thumb_image = jigoshop_get_image_placeholder( '200sq' );
                    ?>

                    <li class="asideproductcat <?php echo $term->slug; ?> <?php if ($loop%$columns==0) echo 'last'; if (($loop-1)%$columns==0) echo 'first'; ?>">
                        <a href="<?php echo get_term_link( $term->slug, 'product_cat' ); ?>" title="<?php echo $title; ?>">
                            <div class="image-wrap">
                                <?php echo $thumb_image; ?>
                                <span class="info-icon"></span>
                            </div>
                         <p><?php echo ( strlen( $title ) > 70 ) ? substr( $title , 0, 70) . '...' : $title; ?></p>
                        </a>
                    </li>

                <?php endif; ?>
            <?php endforeach; ?>

		            <li class="asideproductcat <?php echo $term->slug; ?> <?php if ($loop%$columns==0) echo 'last'; if (($loop-1)%$columns==0) echo 'first'; ?>">
                        <a href="<?php echo get_permalink( '5830' ); ?>" title="Special Offers">
                            <div class="image-wrap">
                                <?php echo get_the_post_thumbnail('5830', '200sq'); ?>
                                <span class="info-icon"></span>
                            </div>
                         <p>Special Offers</p>
                        </a>
                    </li>
                    
        </ul>
    </div>
<br>
<div class="note"><a href="<?php echo get_permalink('5791'); ?>">Shop by Product Range</a></div>

<?php } else {} ?>
</div>