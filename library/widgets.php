<?php



if ( function_exists('register_sidebar') ) {
 	register_sidebar(array(
		'name'=> 'General Sidebar',
		'id' => 'sidebar-generic',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));
 	register_sidebar(array(
		'name'=> '404 Sidebar',
		'id' => 'sidebar-404',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));
 	register_sidebar(array(
		'name'=> 'Homepage Events',
		'id' => 'home-events',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}



// Creating the widget 
class lscu_connect_widget extends WP_Widget {

	public $number_contacts = 6;


	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'lscu_connect_widget', 

			// Widget name will appear in UI
			__('Connect With Us', 'lscu_widget_domain'), 

			// Widget description
			array( 'description' => __( 'A custom widget to display contact information on LSCU.', 'lscu_widget_domain'), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		// open the ripon widget
		echo $args['before_widget'];

		// before and after widget arguments are defined by themes
		echo $args['before_title'] . "Connect With Us" . $args['after_title'];

		$counter = 1;
		while ( $counter <= $this->number_contacts ) {
			if (   !empty( $instance[ 'name' . $counter ] ) 
				|| !empty( $instance[ 'image' . $counter ] ) 
				|| !empty( $instance[ 'email' . $counter ] ) 
				|| !empty( $instance[ 'phone' . $counter ] ) ) {
			?>
			<div class="contact">
				<?php if ( !empty( $instance[ 'image' . $counter ] ) ) { ?><img src="<?php print $instance[ 'image' . $counter ] ?>"><?php } ?>
				<p><?php 
				print ( !empty( $instance[ 'name' . $counter ] ) ? '<strong>' . $instance[ 'name' . $counter ] . '</strong><br>' : '' ); 
				print ( !empty( $instance[ 'title' . $counter ] ) ? $instance[ 'title' . $counter ] . '<br>' : '' ); 
				print ( !empty( $instance[ 'email' . $counter ] ) ? '<a href="mailto:' . $instance[ 'email' . $counter ] . '">' . $instance[ 'email' . $counter ] . '</a><br>' : '' );
				print ( !empty( $instance[ 'phone' . $counter ] ) ? '<a href="tel:' . $instance[ 'phone' . $counter ] . '">' . $instance[ 'phone' . $counter ] . '</a><br>' : '' );
				?></p>
			</div>
			<?php
			}
			$counter++;
		}

		// close the widget tag
		echo $args['after_widget'];
	}
			

	// Widget Backend 
	public function form( $instance ) {
		// Widget admin form
		$counter = 1;
		while ( $counter <= $this->number_contacts ) {
			?>
		<h4>Contact #<?php print $counter ?></h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' . $counter ); ?>"><?php _e( 'Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' . $counter ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'name' . $counter ] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' . $counter ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' . $counter ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' . $counter ] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image' . $counter ); ?>"><?php _e( 'Image:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' . $counter ); ?>" name="<?php echo $this->get_field_name( 'image' . $counter ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'image' . $counter ] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' . $counter ); ?>"><?php _e( 'Email:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' . $counter ); ?>" name="<?php echo $this->get_field_name( 'email' . $counter ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'email' . $counter ] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'phone' . $counter ); ?>" name="<?php echo $this->get_field_name( 'phone' . $counter ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'phone' . $counter ] ); ?>" />
		</p>
		<hr>
			<?php
			$counter++;
		}
	}
	

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$counter = 1;
		while ( $counter <= $this->number_contacts ) {
			$instance[ 'name' . $counter ] = $new_instance[ 'name' . $counter ];
			$instance[ 'title' . $counter ] = $new_instance[ 'title' . $counter ];
			$instance[ 'image' . $counter ] = $new_instance[ 'image' . $counter ];
			$instance[ 'email' . $counter ] = $new_instance[ 'email' . $counter ];
			$instance[ 'phone' . $counter ] = $new_instance[ 'phone' . $counter ];
			$counter++;
		}

		return $instance;
	}

}



// Register and load the widget
function lscu_load_widget() {
	register_widget( 'lscu_connect_widget' );
}
add_action( 'widgets_init', 'lscu_load_widget' );


?>