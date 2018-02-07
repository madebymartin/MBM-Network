<?php
// Register and load the widget
if ( ! function_exists( 'mbm_load_widgets' ) ) {
    function mbm_load_widgets() {
        register_widget( 'mbm_treatments_menu' );
    }
}
add_action( 'widgets_init', 'mbm_load_widgets' );




/**
 * Treatment Menu Nav Widget
 */

// Creating the widget 
class mbm_treatments_menu extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
            'mbm_treatments_menu', 

// Widget name will appear in UI
            __('Treatment Menu Navigation', 'mbm_treatments_menu_domain'), 

// Widget description
            array( 'description' => __( 'Shows link to treatment categories', 'mbm_treatments_menu_domain' ), ) 
            );
    }

// Creating widget front-end
// This is where the action happens
    public function widget( $args, $instance ) {

        if($instance){$title = $instance['title'];}else{$title = 'Treatment Menu';}
        $title = apply_filters( 'widget_title', $title );



        $treatment_categories = get_terms( array(
            'taxonomy' => 'treatment_category',
            'hide_empty' => true,
        ) );

        $treatmentpages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template-treatments.php'
        ));
        $treatmentpage = $treatmentpages['0'];
        $treatmentpage_id = $treatmentpage->ID;
       

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) ){
            echo $args['before_title'] . $title . $args['after_title'];
        }




        if ( ! empty( $treatment_categories ) && ! is_wp_error( $treatment_categories ) ){
            echo '<ul class="treatment-menu">';
            if(!empty($treatmentpage_id)){ echo '<li><a href="'. get_permalink($treatmentpage_id) .'">All Treatments</a></li>'; }
            
            foreach ( $treatment_categories as $treatment_category ) {
                echo '<li><a title="'. $treatment_category->name .'" href="'. get_term_link($treatment_category->term_id) .'">' . $treatment_category->name . '</a></li>';
            }
            echo '</ul>';
        }






        echo $args['after_widget'];

    }



// Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Treatment Menu', 'mbm_treatments_menu_domain' );
        }


// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 

    }
    
// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} 