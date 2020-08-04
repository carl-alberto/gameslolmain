<?php

/* Grids */
/* For Homepage */

class ocmeGames_HomeGrid extends WP_Widget {
  
	public function __construct() {
	$widget_options = array( 
	  'classname' => 'ocme_homegrid',
	  'description' => 'Displays grid of posts for homepage',
	);
	parent::__construct( 'ocme_homegrid', '*OCME Games: Home Grid Box', $widget_options );
	}
	
	public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance[ 'title' ]);
	$text_content = $instance[ 'text_content' ];
	$posts_to_show =  ($instance[ 'posts_to_show' ] > 0) ? $instance[ 'posts_to_show' ] : 10;
	$post_type = $instance[ 'post_type' ];
    
	echo $args['before_widget']; ?>
	
 	<div class="home_widget_box">
	<?php echo $args['before_title'] . $title . $args['after_title'] ; ?>
		<div class="widget_text container-fluid">
			<p><?php echo $text_content; ?></p>
		</div>
		<?php
			switch($post_type){
				case 'minigame': ?>
				<div class="grid <?php if( get_query_var("amp")<>1) { 
											echo 'grid_minigame container-fluid'; }
										else { echo 'grid_article'; }
				 ?>">
					<?php
					$query_args = array(
							'post_status'	 => 'publish',
							'post_type'		 => 'minigame',
							'orderby'        => 'postdate',
							'posts_per_page' => $posts_to_show
						);

						$the_query = new WP_Query( $query_args ); 

						if ( $the_query->have_posts() ) : 
						while ( $the_query->have_posts() ) : $the_query->the_post(); 
								if(get_query_var("amp") == 1) {
									include( locate_template( 'loop/content_grid_minigame_amp.php', false, false ) );
								} else {
									include( locate_template( 'loop/content_grid_minigame.php', false, false ) );
								}
								endwhile;
					endif;
					?>
				</div>		
			<?php break;
				case 'article': ?>
				<div class="grid grid_article <?php if( get_query_var("amp")<>1) { echo 'container-fluid'; } ?>">
						<?php
						$query_args = array(
								'post_status'	 => 'publish',
								'post_type'		 => 'article',
								'orderby'        => 'postdate',
								'posts_per_page' => $posts_to_show
							);

							$the_query = new WP_Query( $query_args ); 

							if ( $the_query->have_posts() ) : 
							while ( $the_query->have_posts() ) : $the_query->the_post();
					
								if(get_query_var("amp") == 1) {
									include( locate_template( 'loop/content_grid_article_amp.php', false, false ) );
								} else {
									include( locate_template( 'loop/content_grid_article.php', false, false ) );
								}
								endwhile;
						endif;
						?>
				</div>
			<?php break;
				case 'review': ?>
				<div class="grid grid_article container-fluid">
						<?php
						$query_args = array(
								'post_status'	 => 'publish',
								'post_type'		 => 'review',
								'orderby'        => 'postdate',
								'posts_per_page' => $posts_to_show
							);

							$the_query = new WP_Query( $query_args ); 

							if ( $the_query->have_posts() ) : 
							while ( $the_query->have_posts() ) : $the_query->the_post(); 
								if(get_query_var("amp") == 1) {
									include( locate_template( 'loop/content_grid_article_amp.php', false, false ) );
								} else {
									include( locate_template( 'loop/content_grid_article.php', false, false ) );
								}
								endwhile;
				
						endif;
						?>
				</div>
			<?php break;
			}
		?>
    </div>
	
	<?php echo $args['after_widget'];
	
	}

	public function form( $instance ) {
	  $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
	  $text_content = ! empty( $instance['text_content'] ) ? $instance['text_content'] : '';
	  $posts_to_show = ! empty( $instance['posts_to_show'] ) ? $instance['posts_to_show'] : '10';
	  $post_type = ! empty( $instance['post_type'] ) ? $instance['post_type'] : ''; ?>

	  <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'post_type' ); ?>">Post Type:</label>
		<select id="<?php echo $this->get_field_id( 'post_type' ); ?>"
				name="<?php echo $this->get_field_name( 'post_type' ); ?>">
			<option name="minigame" value="minigame" <?php if($post_type == 'minigame'){ echo 'selected'; }?>>Mini Games</option>
			<option name="article" value="article" <?php if($post_type == 'article'){ echo 'selected'; }?>>Articles</option>
			<option name="review" value="review" <?php if($post_type == 'review'){ echo 'selected'; } ?>>Reviews</option>
		</select>
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'posts_to_show' ); ?>"># of posts:</label>
		<input type="number" id="<?php echo $this->get_field_id( 'posts_to_show' ); ?>" name="<?php echo $this->get_field_name( 'posts_to_show' ); ?>" min="1" value="<?php echo $posts_to_show; ?>" />
	  </p>
	  <p>
		<label for="<?php echo $this->get_field_id( 'text_content' ); ?>">Text Content:</label><br>
		<textarea id="<?php echo $this->get_field_id( 'text_content' ); ?>" name="<?php echo $this->get_field_name( 'text_content' ); ?>" rows="5" style="width: 100%;"><?php echo esc_attr( $text_content ); ?></textarea>
	  </p>
	 <?php 
	}
	
	public function update( $new_instance, $old_instance ) {
	  $instance = $old_instance;
	  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	  $instance[ 'text_content' ] = $new_instance[ 'text_content' ];
	  $instance[ 'post_type' ] = strip_tags( $new_instance[ 'post_type' ] );
	  $instance[ 'posts_to_show' ] = strip_tags( $new_instance[ 'posts_to_show' ] );
	  return $instance;
	}
	
}


function register_ocmeGames_HomeGrid() { 
  register_widget( 'ocmeGames_HomeGrid' );
}

add_action( 'widgets_init', 'register_ocmeGames_HomeGrid' );

?>