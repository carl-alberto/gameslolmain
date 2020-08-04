<?php

/* Tag List */
/* For Sidebar */

class ocmeGames_Connects extends WP_Widget {
  
	public function __construct() {
	$widget_options = array( 
	  'classname' => 'ocme_connects',
	  'description' => 'Displays list of social media links',
	);
	parent::__construct( 'ocme_connects', '*OCME Games: Connect', $widget_options );
	}
	
	public function widget( $args, $instance ) {
    
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	$url_facebook = $instance[ 'url_facebook' ];
	$url_twitter = $instance[ 'url_twitter' ];
	$url_pinterest = $instance[ 'url_pinterest' ];
	$url_discord = $instance[ 'url_discord' ];
    
	echo $args['before_widget']; ?>
	
 	<div class="widget_connect">
	<?php echo $args['before_title'] . $title . $args['after_title'] ; ?>
		<div class="clearfix"></div>
		<ul>
			<?php
      		if( $url_discord <> "") { ?>
			<li class="connect_discord"><a href="<?php echo $url_discord; ?>" title="Discord" target="_blank">
				<img src="<?php echo get_template_directory_uri() . '/images/socialmedia/discord.png'; ?>">
				Discord</a>
			</li>
			<?php }
			if( $url_facebook <> "") { ?>
			<li class="connect_facebook"><a href="<?php echo $url_facebook; ?>" title="Facebook" target="_blank">
				<img src="<?php echo get_template_directory_uri() . '/images/socialmedia/facebook.png'; ?>">
				Facebook</a>
			</li>
			<?php }
			if( $url_twitter <> "") { ?>
			<li class="connect_twitter"><a href="<?php echo $url_twitter; ?>" title="Twitter" target="_blank">
				<img src="<?php echo get_template_directory_uri() . '/images/socialmedia/twitter.png'; ?>">
				Twitter</a>
			</li>
			<?php }
			if( $url_pinterest <> "") { ?>
			<li class="connect_pinterest"><a href="<?php echo $url_pinterest; ?>" title="Pinterest" target="_blank">
				<img src="<?php echo get_template_directory_uri() . '/images/socialmedia/pinterest.png'; ?>">
				Pinterest</a>
			</li>
			<?php } ?>
		</ul>
    </div>
	
	<?php echo $args['after_widget'];
	
	}

	public function form( $instance ) {
	  $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
	  $url_facebook = ! empty( $instance['url_facebook'] ) ? $instance['url_facebook'] : '';
	  $url_twitter = ! empty( $instance['url_twitter'] ) ? $instance['url_twitter'] : '';
	  $url_pinterest = ! empty( $instance['url_pinterest'] ) ? $instance['url_pinterest'] : ''; 
	  $url_discord = ! empty( $instance['url_discord'] ) ? $instance['url_discord'] : '' ?>
	  <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'url_facebook' ); ?>">Facebook URL:</label>
		<input type="url" id="<?php echo $this->get_field_id( 'url_facebook' ); ?>" name="<?php echo $this->get_field_name( 'url_facebook' ); ?>" value="<?php echo esc_attr( $url_facebook ); ?>" />
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'url_twitter' ); ?>">Twitter URL:</label>
		<input type="url" id="<?php echo $this->get_field_id( 'url_twitter' ); ?>" name="<?php echo $this->get_field_name( 'url_twitter' ); ?>" value="<?php echo esc_attr( $url_twitter ); ?>" />
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'url_pinterest' ); ?>">Pinterest URL:</label>
		<input type="url" id="<?php echo $this->get_field_id( 'url_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'url_pinterest' ); ?>" value="<?php echo esc_attr( $url_pinterest ); ?>" />
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'url_discord' ); ?>">Discord URL:</label>
		<input type="url" id="<?php echo $this->get_field_id( 'url_discord' ); ?>" name="<?php echo $this->get_field_name( 'url_discord' ); ?>" value="<?php echo esc_attr( $url_discord ); ?>" />
	  </p>
	 <?php 
	}
	
	public function update( $new_instance, $old_instance ) {
	  $instance = $old_instance;
	  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	  $instance[ 'url_facebook' ] = strip_tags( $new_instance[ 'url_facebook' ] );
	  $instance[ 'url_twitter' ] = strip_tags( $new_instance[ 'url_twitter' ] );
	  $instance[ 'url_pinterest' ] = strip_tags( $new_instance[ 'url_pinterest' ] );
	  $instance[ 'url_discord' ] = strip_tags( $new_instance[ 'url_discord' ] );
	  return $instance;
	}
	
}


function register_ocmeGames_Connects() { 
  register_widget( 'ocmeGames_Connects' );
}

add_action( 'widgets_init', 'register_ocmeGames_Connects' );

?>