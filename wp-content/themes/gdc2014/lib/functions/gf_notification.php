<?php
add_action('gform_pre_submission_18', 'recommendations');
function recommendations($form) {
    $GLOBALS['skintype'] = $_POST['input_24'];
    $GLOBALS['age'] = $_POST['input_25'];

    add_filter('the_content', 'recommended');
}

add_shortcode('gform_recommendations', 'recommended');
function recommended() {
    global $age;
    global $skintype;

    /* CLEANSER / TONER LOOP */
    $cleansetoneloop = new WP_Query(array( 
        'post_type' => 'recommended',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'age_group',
                'field' => 'slug',
                'terms' => $age,
            ),
            array(
                'taxonomy' => 'skintype',
                'field' => 'slug',
                'terms' => $skintype,
            ),
            array(
                'taxonomy' => 'recommendation_type',
                'field' => 'slug',
                'terms' => 'cleanser-toner',
            ),
        ),
        'orderby' => 'title',
        'posts_per_page' => '-1', 
        'order' => 'ASC',
    ));

    while ($cleansetoneloop->have_posts()) : $cleansetoneloop->the_post(); ?>
        <div class="recommend cleansertoner">
            <h2>Your recommended cleansing / toning option:</h2>
            <?php the_title(); ?><br />
            <?php if (has_post_thumbnail()) the_post_thumbnail('thumb'); ?>
        </div>
    <?php endwhile;

    /* EXFOLIATOR LOOP */
    $exfoliatorloop = new WP_Query(array(
        'post_type' => 'recommended',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'age_group',
                'field' => 'slug',
                'terms' => $age,
            ),
            array(
                'taxonomy' => 'skintype',
                'field' => 'slug',
                'terms' => $skintype,
            ),
            array(
                'taxonomy' => 'recommendation_type',
                'field' => 'slug',
                'terms' => 'facial-exfoliator',
            ),
        ),
        'orderby' => 'title',
        'posts_per_page' => '-1', 
        'order' => 'ASC',
    ));

    while ($exfoliatorloop->have_posts()) : $exfoliatorloop->the_post(); ?>
        <div class="recommend">
            <h2>Your recommended facial exfoliation:</h2>
            <?php the_title(); ?><br />
            <?php if (has_post_thumbnail()) the_post_thumbnail('thumb'); ?>
        </div>
    <?php endwhile; 
}
?>