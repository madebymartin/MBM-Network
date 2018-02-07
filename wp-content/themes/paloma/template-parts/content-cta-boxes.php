<?php
/**
 * Template part for displaying the paloma Call to Action boxes
 *
 * @package paloma
 */
?>

<aside id="cta-boxes">

    <?php //display image blocks
    //load vars
    $stnsvn_cta_cols = get_theme_mod('stnsvn_cta_cols', '3');
    $stnsvn_cta1_upload = get_theme_mod('stnsvn_cta1_upload', '');
    $stnsvn_cta1_upload_url = wp_get_attachment_url($stnsvn_cta1_upload);
    $stnsvn_cta1_text = get_theme_mod('stnsvn_cta1_text', '');
    $stnsvn_cta1_url = get_theme_mod('stnsvn_cta1_url', '');
    $stnsvn_cta1_tab = get_theme_mod('stnsvn_cta1_tab', '');
    $stnsvn_cta2_upload = get_theme_mod('stnsvn_cta2_upload', '');
    $stnsvn_cta2_upload_url = wp_get_attachment_url($stnsvn_cta2_upload);
    $stnsvn_cta2_text = get_theme_mod('stnsvn_cta2_text', '');
    $stnsvn_cta2_url = get_theme_mod('stnsvn_cta2_url', '');
    $stnsvn_cta2_tab = get_theme_mod('stnsvn_cta2_tab', '');
    $stnsvn_cta3_upload = get_theme_mod('stnsvn_cta3_upload', '');
    $stnsvn_cta3_upload_url = wp_get_attachment_url($stnsvn_cta3_upload);
    $stnsvn_cta3_text = get_theme_mod('stnsvn_cta3_text', '');
    $stnsvn_cta3_url = get_theme_mod('stnsvn_cta3_url', '');
    $stnsvn_cta3_tab = get_theme_mod('stnsvn_cta3_tab', '');
    ?>

     <div class="clear landing-image-blocks paloma-columns-<?php echo $stnsvn_cta_cols; ?>">


            <div class="image-block paloma-column">

                <?php if( $stnsvn_cta1_url ): ?>
                    <a href="<?php echo $stnsvn_cta1_url; ?>" <?php if ($stnsvn_cta1_tab == 1){ echo 'target="_blank"'; } ?> >
                <?php endif; ?>

                    <img src="<?php echo $stnsvn_cta1_upload_url; ?>">

                    <?php if( $stnsvn_cta1_text ): ?>
                        <h4><?php echo $stnsvn_cta1_text; ?></h4>
                    <?php endif; ?>
                    
	            <?php if( $stnsvn_cta1_url ): ?>
	                </a>
	            <?php endif; ?>
            </div>

            <div class="image-block paloma-column">

                <?php if( $stnsvn_cta2_url ): ?>
                    <a href="<?php echo $stnsvn_cta2_url; ?>" <?php if ($stnsvn_cta2_tab == 1){ echo 'target="_blank"'; } ?> >
                <?php endif; ?>

                    <img src="<?php echo $stnsvn_cta2_upload_url; ?>">

                    <?php if( $stnsvn_cta2_text ): ?>
                        <h4><?php echo $stnsvn_cta2_text; ?></h4>
                    <?php endif; ?>

                <?php if( $stnsvn_cta2_url ): ?>
                    </a>
                <?php endif; ?>
             </div>

        <?php if( $stnsvn_cta_cols == '3' ): ?>

            <div class="image-block paloma-column">

                <?php if( $stnsvn_cta3_url ): ?>
                    <a href="<?php echo $stnsvn_cta3_url; ?>" <?php if ($stnsvn_cta3_tab == 1){ echo 'target="_blank"'; } ?>>
                <?php endif; ?>

                    <img src="<?php echo $stnsvn_cta3_upload_url; ?>">

                    <?php if( $stnsvn_cta3_text ): ?>
                        <h4><?php echo $stnsvn_cta3_text; ?></h4>
                    <?php endif; ?>

                <?php if( $stnsvn_cta3_url ): ?>
                    </a>
                <?php endif; ?>
             </div>
        <?php endif; ?>

     </div>

</aside>