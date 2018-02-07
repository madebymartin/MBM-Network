<?php
add_filter( 'gform_save_field_value_50_32', 'mbm_survey_coupon_code', 10, 4 );
function mbm_survey_coupon_code( $value, $lead, $field, $form ) {
    $newvalue = substr(md5(rand()), 0, 7);
    $newvalue = strtoupper($newvalue);
    return $newvalue;
}

add_filter("gform_entry_post_save", "survey_form_coupon", 10, 2);
function survey_form_coupon($entry, $form){

    if ($form["id"] == '50'){

        //$code = substr(md5(rand()), 0, 7);
        $code = $entry['32'];
        $email = $entry['1'];
        $fname = $entry['4.3'];
        $sname = $entry['4.6'];

        // Create store credit for user's next order (for the value they paid)
        $survey_coupon_5pounds = array(
            'post_title'        => $code,
            'post_content'      => 'Survey £5 reward',
            'post_excerpt'      => 'Survey Reward: ' . $email,
            'post_status'       => 'publish',
            'post_author'       => 1,
            'post_type'         => 'shop_coupon',
            'comment_status'    => 'closed'
        );
        $survey_coupon_5pounds_id = wp_insert_post( $survey_coupon_5pounds );
        add_post_meta($survey_coupon_5pounds_id, 'discount_type', 'fixed_cart', true);
        add_post_meta($survey_coupon_5pounds_id, 'coupon_amount', '4.166666', true);
        add_post_meta($survey_coupon_5pounds_id, 'free_gift_shipping', 'no', true);
        add_post_meta($survey_coupon_5pounds_id, 'individual_use', 'yes', true);
        add_post_meta($survey_coupon_5pounds_id, 'free_shipping', 'no', true);
        add_post_meta($survey_coupon_5pounds_id, 'exclude_product_categories', '314', false); //spa vouchers
        // add_post_meta($survey_coupon_5pounds_id, 'exclude_product_categories', '239', false); // samples
        //add_post_meta($survey_coupon_5pounds_id, 'customer_email', $email, true);
        add_post_meta($survey_coupon_5pounds_id, 'minimum_amount', '25', true);
        add_post_meta($survey_coupon_5pounds_id, 'usage_limit', '1', true);
        add_post_meta($survey_coupon_5pounds_id, 'usage_limit_per_user', '1', true);

    }
    return $entry;
}
?>