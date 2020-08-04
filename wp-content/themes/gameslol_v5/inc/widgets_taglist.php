<?php

/* Tag List */
/* For Sidebar */

class ocmeGames_TagList extends WP_Widget {
  
	public function __construct() {
	$widget_options = array( 
	  'classname' => 'ocme_taglist',
	  'description' => 'Displays list of game tags',
	);
	parent::__construct( 'ocme_taglist', '*OCME Games: Tags', $widget_options );
	}
	
	public function widget( $args, $instance ) {
    
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
    
	echo $args['before_widget']; ?>
	
 	<div class="widget_taglist">
	<?php echo $args['before_title'] . $title . $args['after_title'] ; ?>
		<div class="clearfix"></div>
			<ul>
				<?php 
					$tags = get_terms( array(
							'taxonomy' => 'post_tag',
    						'hide_empty' => true,
							) );
					foreach($tags as $tag){ ?>
						<li><a href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>" title="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></a></li>
					<?php
					}
				?>
			</ul>
    </div>
	
	<?php echo $args['after_widget'];
	
	}

	public function form( $instance ) {
	  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
	  <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	  </p>
	 <?php 
	}
	
	public function update( $new_instance, $old_instance ) {
	  $instance = $old_instance;
	  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	  return $instance;
	}
	
}


function register_ocmeGames_TagList() { 
  register_widget( 'ocmeGames_TagList' );
}

add_action( 'widgets_init', 'register_ocmeGames_TagList' );

?>