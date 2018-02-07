<?php 
/**
 * Station Seven Popular Posts widget configuration
 */

class stnsvn_popular_posts extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'stnsvn_popular_posts',
			__( 'Station Seven Popular Posts', 'paloma' ),
			array(
				'description' => __( 'Select popular posts.', 'paloma' ),
				'classname'   => 'stnsvn_popular_posts',
			)
		);

	}

	public function widget( $args, $instance ) {
		$stnsvn_title = !empty( $instance['stnsvn_title'] ) ? $instance['stnsvn_title'] : __( 'Popular Posts', 'paloma' );
		$stnsvn_id = !empty( $instance['stnsvn_id'] ) ? $instance['stnsvn_id'] : '';
		$stnsvn_display_style = !empty( $instance['stnsvn_display_style'] ) ? $instance['stnsvn_display_style'] : 'row_posts';
		$stnsvn_display = isset( $instance['stnsvn_display'] ) ? $instance['stnsvn_display'] : array();
		$stnsvn_category = isset( $instance['stnsvn_category'] ) ? $instance['stnsvn_category'] : array();
		
		// Before widget tag
		echo $args['before_widget'];
		
		// Title
		if ( ! empty( $stnsvn_title ) ) {
			echo $args['before_title'] . $stnsvn_title . $args['after_title'];
		}
		
		// Recent Posts
		$stnsvn_post_ids = explode(",", $stnsvn_id); 
		$query = new WP_Query( array (
			'ignore_sticky_posts' => true,
			'post__in' => $stnsvn_post_ids,
			'orderby' => 'post__in'
		) );

		//Run the loop
		if ( $query->have_posts() ) : 

			//Render different layout depending on user options
			if($stnsvn_display_style == 'full_width_posts') { //Do full width posts

				while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="stnsvn-featured-article">
						<div class="block-featured">
							<?php if ($stnsvn_display && has_post_thumbnail()) { ?>
								<a href="<?php echo get_permalink(); ?>">
									<?php echo the_post_thumbnail('landscape-featured'); ?>
								</a>
							<?php } ?>

							<header>
								<?php 	
									if ($stnsvn_category){
					            		get_template_part( 'template-parts/content', 'category' ); 
					            	}
								?>

								<?php 	//Display post title ?>
		                             <h5 class="entry-title">
		                                 <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo the_title(); ?></a>
		                             </h5>

							</header><!-- .entry-header -->	
						</div>
					</div>
				<?php endwhile; 

			}

			else { //Do row posts

				while ( $query->have_posts() ) : $query->the_post();
					$post_title = ( get_the_title() ? get_the_title() : get_the_ID() );
					echo '<div class="stnsvn-featured-article">';
							

					if ($stnsvn_display){ ?>
							<div class="stnsvn-featured-img">
								<a href="<?php echo get_permalink(); ?>">
								<?php if (has_post_thumbnail()) {
									echo the_post_thumbnail('thumbnail'); 
								} ?>
								</a>
							</div>
					<?php  } ?>
					
						<div class="stnsvn-featured-rows">
							<?php //Display category if enabled
								if ($stnsvn_category){
				            		get_template_part( 'template-parts/content', 'category' ); 
				            	} 
								
							//Display post title ?>
                             <h5 class="entry-title">
                                 <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo the_title(); ?></a>
                             </h5>
						</div>
					</div>

				<?php 
				endwhile;

			}
		
		endif;
		wp_reset_postdata();
		
		// After widget tag
		echo $args['after_widget'];

	}

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array( 
			'stnsvn_title' => '',
			'stnsvn_id' => '',
			'stnsvn_display_style' => '',
			'stnsvn_display' => array(),
			'stnsvn_category' => array(),
		) );

		// Retrieve an existing value from the database
		$stnsvn_title = !empty( $instance['stnsvn_title'] ) ? $instance['stnsvn_title'] : '';
		$stnsvn_id = !empty( $instance['stnsvn_id'] ) ? $instance['stnsvn_id'] : '';
		$stnsvn_display_style = !empty( $instance['stnsvn_display_style'] ) ? $instance['stnsvn_display_style'] : '';
		$stnsvn_display = isset( $instance['stnsvn_display'] ) ? $instance['stnsvn_display'] : array();
		$stnsvn_category = isset( $instance['stnsvn_category'] ) ? $instance['stnsvn_category'] : array();

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'stnsvn_title' ) . '" class="stnsvn_title_label">' . __( 'Title', 'paloma' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'stnsvn_title' ) . '" name="' . $this->get_field_name( 'stnsvn_title' ) . '" class="widefat" value="' . esc_attr( $stnsvn_title ) . '">';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'stnsvn_id' ) . '" class="stnsvn_id_label">' . __( 'Post IDs to display', 'paloma' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'stnsvn_id' ) . '" name="' . $this->get_field_name( 'stnsvn_id' ) . '" class="widefat" value="' . esc_attr( $stnsvn_id ) . '">';
		echo '	<span class="description">' . __( 'Enter comma-separated list of post IDs', 'paloma' ) . '</span>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'stnsvn_display_style' ) . '" class="stnsvn_display_style_label">' . __( 'Select display style', 'paloma' ) . '</label>';
		echo '	<select id="' . $this->get_field_id( 'stnsvn_display_style' ) . '" name="' . $this->get_field_name( 'stnsvn_display_style' ) . '" class="widefat">';
		echo '		<option value="row_posts" ' . selected( $stnsvn_display_style, 'row_posts', false ) . '> ' . __( 'Row Posts', 'paloma' ) . '</option>';
		echo '		<option value="full_width_posts" ' . selected( $stnsvn_display_style, 'full_width_posts', false ) . '> ' . __( 'Full Width Posts', 'paloma' ) . '</option>';
		echo '	</select>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'stnsvn_display' ) . '" class="stnsvn_display_label">' . __( 'Display featured images', 'paloma' ) . '</label><br>';
		echo '	<label>';
		echo '		<input type="checkbox" name="' . $this->get_field_name( 'stnsvn_display' ) . '[]" value="" ' . ( in_array( '', $stnsvn_display )? 'checked="checked"' : '' ) . '>';
		echo '	</label><br>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'stnsvn_category' ) . '" class="stnsvn_category_label">' . __( 'Display category meta', 'paloma' ) . '</label><br>';
		echo '	<label>';
		echo '		<input type="checkbox" name="' . $this->get_field_name( 'stnsvn_category' ) . '[]" value="" ' . ( in_array( '', $stnsvn_category )? 'checked="checked"' : '' ) . '>';
		echo '	</label><br>';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['stnsvn_title'] = !empty( $new_instance['stnsvn_title'] ) ? strip_tags( $new_instance['stnsvn_title'] ) : '';
		$instance['stnsvn_id'] = !empty( $new_instance['stnsvn_id'] ) ? strip_tags( $new_instance['stnsvn_id'] ) : '';
		$instance['stnsvn_display_style'] = !empty( $new_instance['stnsvn_display_style'] ) ? strip_tags( $new_instance['stnsvn_display_style'] ) : '';
		$instance['stnsvn_display'] = !empty( $new_instance['stnsvn_display'] ) ? array_map( 'strip_tags', $new_instance['stnsvn_display'] ) : array();
		$instance['stnsvn_category'] = !empty( $new_instance['stnsvn_category'] ) ? array_map( 'strip_tags', $new_instance['stnsvn_category'] ) : array();


		return $instance;

	}

}

function stnsvn_register_widgets() {
	register_widget( 'stnsvn_popular_posts' );
}
add_action( 'widgets_init', 'stnsvn_register_widgets' );