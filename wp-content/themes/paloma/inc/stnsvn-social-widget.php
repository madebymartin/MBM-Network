<?php
/**
 * Social icons widget configuration
 */
    class stnsvn_social_icons_widget extends WP_Widget {
       
    	/** constructor */
		    function __construct() {

				/**
				 * Default widget option values.
				 */
				$this->defaults = apply_filters( 'stnsvn_social_default_styles', array(
					'title'                  => '',
				) );

				$widget_ops = array(
					'classname'   => 'stnsvn_social_icons_widget',
					'description' => __('Displays social icons set in customizer.', 'paloma'),
				);

				$control_ops = array(
					'id_base' => 'stnsvn_social_icons_widget',
				);

				parent::__construct( 'stnsvn_social_icons_widget', __( 'Station Seven Social Icons', 'paloma' ), $widget_ops, $control_ops );
			}

		/** @see WP_Widget::widget. Renders widget on front end */
		    function widget($args, $instance) {
		        extract( $args );
		    // these are our widget options
		   	$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		    echo $before_widget;
		    if ( $title ) {
		    echo $before_title . $title . $after_title;
		    }
		         //Display social icons set in customizer
		         get_template_part( 'template-parts/content', 'social' );

		    	echo $after_widget;
		    }

	    /** @see WP_Widget::form. Renders widget in admin */
	    	function form( $instance ) {

				/** Merge with defaults */
				$instance = wp_parse_args( (array) $instance, $this->defaults );
				?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'simple-social-icons' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</p>
				<p>
					<?php _e('Social media links can be configured under Appearance > Customize > Social Media Icons', 'paloma'); ?>
				</p>
			    <?php
			    }

}
// register widget
    add_action('widgets_init', create_function('', 'return register_widget("stnsvn_social_icons_widget");'));