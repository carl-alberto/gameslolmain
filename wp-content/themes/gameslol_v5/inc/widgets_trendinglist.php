<?php

/* Article Grid */
/* For Homepage */

class ocmeGames_TrendingList extends WP_Widget {
  
	private $countposts = 10;
	
	public function __construct() {
	$widget_options = array( 
	  'classname' => 'ocme_trendinglist_custom',
	  'description' => 'Display a list of top games',
	);
	parent::__construct( 'ocme_trendinglist_custom', '*OCME Games: Trending Games List', $widget_options );
	}
	
	public function widget( $args, $instance ) {
    
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	$postlist = array();
	for ($x = 1; $x <= $this->countposts; $x++) {
		$fieldname = "trending_".$x;
		$postlist[$x] = $instance[$fieldname];
	}
    
	echo $args['before_widget']; ?>
	
 	<div class="widget_trendinglist">
	<?php echo $args['before_title'] . $title . $args['after_title'] ; ?>
	<div class="clearfix"></div>
		<div class="list list_game container-fluid">
 		<?php
			global $post;
			$x = 1; 
			foreach($postlist as $mypost){
				if($mypost <> ''){
					$post = get_post($mypost);
					setup_postdata( $post );
					if(get_query_var('amp') == 1) {
						include( locate_template( 'loop/content_list_sidebar_amp.php', false, false ) );
					} else {
						include( locate_template( 'loop/content_list_sidebar.php', false, false ) );
					}
					$x++;
				}
			}
				wp_reset_postdata();
		?>
   		</div>
    </div>
	
	<?php echo $args['after_widget'];
	
	}

	public function form( $instance ) {
		
		$postlist = array();
		for ($x = 1; $x <= $this->countposts; $x++) {
			$fieldname = "trending_".$x;
			$postlist[$fieldname] = $instance[$fieldname];
		}
		
	  $title = ! empty( $instance['title'] ) ? $instance['title'] : '';  ?>
	  <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	  </p>
	  <p>Select up to <?php echo $this->countposts; ?> games to feature: </p>
	 <?php 
	  /* Top Games */

		$dropdown_array = get_posts_dropdown_array();
		
		for ($x = 1; $x <= $this->countposts; $x++) {
			$fieldname = "trending_".$x;
		?>
		<p>
		<label for="<?php echo $this->get_field_id( $fieldname ); ?>"><?php echo "#".$x; ?>: </label>
		<select name="<?php echo $this->get_field_name( $fieldname ); ?>" 
	 		id="<?php echo $this->get_field_id( $fieldname ); ?>">
	 		<option value=""></option>
		 	<?php foreach($dropdown_array as $post_id => $title){ ?>
				 <option value="<?php echo $post_id; ?>" <?php if($post_id == $postlist[$fieldname]){ echo 'selected'; } ?>><?php  echo $title; ?></option>
			<?php } ?>
	  	</select>
		  </p>
	  <?php
		} 
	}
	
	public function update( $new_instance, $old_instance ) {
	  $instance = $old_instance;
	  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		for ($x = 1; $x <= $this->countposts; $x++) {
			$fieldname = "trending_".$x;
			$instance[$fieldname] = strip_tags( $new_instance[$fieldname] );
		}
	  return $instance;
	}
	
}

function register_ocmeGames_TrendingList() { 
  register_widget( 'ocmeGames_TrendingList' );
}

add_action( 'widgets_init', 'register_ocmeGames_TrendingList' );

?>