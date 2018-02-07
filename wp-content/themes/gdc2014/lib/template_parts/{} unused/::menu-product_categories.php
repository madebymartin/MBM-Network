<?php global $wp_query; 
$args = array(
    'parent'        =>  '0',
    'hide_empty' => '0',
    'exclude'   => '239',
);
$categories = get_terms( 'product_cat', $args );


	if ( sizeof( $categories ) ) { ?>

    <div class="category-list">
        <ul>
            <?php foreach ( $categories as $category ) :
                $term = get_term_by( 'id', $category->term_id, 'product_cat' );

                $subcatargs = array(
                    'orderby'       => 'name', 
                    'order'         => 'ASC',
                    'hide_empty'    => '0', 
                    'child_of'      => $term->term_id
                ); 
                $subcategories = get_terms( 'product_cat', $subcatargs );

                if ( ! empty( $term )) :
                    $title = $term->name;
                    $thumb = jigoshop_product_cat_image( $term->term_id );
                    if ( $thumb['thumb_id'] )
                      $thumb_image = wp_get_attachment_image( $thumb['thumb_id'], '200sq' );
                    else
                      $thumb_image = jigoshop_get_image_placeholder( '200sq' );
                    ?>

                    <li class="productcat <?php echo $term->slug; ?> <?php if ($loop%$columns==0) echo 'last'; if (($loop-1)%$columns==0) echo 'first'; ?>">
                            <a href="<?php echo get_term_link( $term->slug, 'product_cat' ); ?>" title="<?php echo $title; ?>">
                                <div class="image-wrap">
                                    <?php echo $thumb_image; ?>
                                    <span class="info-icon"></span>
                                </div>
                                <h3><?php echo ( strlen( $title ) > 70 ) ? substr( $title , 0, 70) . '...' : $title; ?></h3>
                            </a>
                            
                            <div class="prodcatinfo">
                                <p class="mobilehide"><?php echo $term->description; ?></p>

                                    <?php if ( ! empty( $subcategories )) : ?>


                                        <ul class="subcats">
                                            <?php foreach ( $subcategories as $subcategory ) : 
                                            $subcat_term = get_term_by( 'id', $subcategory->term_id, 'product_cat' );
                                            $subcatname = $subcat_term->name;

                                            if ( ! empty( $subcat_term )) :
                                            ?>

                                            <li><a class="entypo-right-dir" href="<?php echo get_term_link( $subcategory->slug, 'product_cat' ); ?>" title="<?php echo $subcatname; ?>">
                                                <?php echo $subcategory->name; ?>
                                            </a></li>

                                            <?php endif;
                                            endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                            </div>

                    </li>


                <?php endif; ?>
            <?php endforeach; ?>




                    <li class="productcat <?php echo $term->slug; ?> <?php if ($loop%$columns==0) echo 'last'; if (($loop-1)%$columns==0) echo 'first'; ?>">
                        <a href="<?php echo get_permalink( '5830' ); ?>" title="Special Offers">
                            
                            <div class="image-wrap">
                                <?php echo get_the_post_thumbnail('5830', '200sq'); ?>
                                <span class="info-icon"></span>
                            </div>

                            <h3>Special Offers</h3>
                        </a>
                        <div class="prodcatinfo">
                            <p class="mobilehide">All products currently on special offer</p>
                        </div>
                    </li>
        </ul>
    </div>
<?php } else{} ?>