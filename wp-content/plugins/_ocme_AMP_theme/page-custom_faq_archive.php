<?php
/* Template Name: Custom FAQ Archive Page */
?>
<?php amp_header(); ?>

<div id="pageheader">
		<?php amp_title(); ?>	
	</div>
	<div id="pagecontent" class="container">
		<div class="content">
		<?php amp_content(); ?>
		</div>
		<div class="grid grid_walkthrough">
		<?php
				$args = array(
						'post_status' => 'publish',
						'orderby'     => 'date',
						'posts_per_page' => -1
					);

					$posts = get_posts( $args );
					$grid_games = array();
		
					foreach ( $posts as $thepost ) {
						$post_id = $thepost->ID;
						$grid_games[$post_id] = get_the_faq_count($post_id);
					}

					arsort($grid_games);
		
					foreach($grid_games as $game_id => $game_walkthrough){
						global $post;
						$post = get_post($game_id);
						include( 'loop_grid_faq.php' );
						
					}
					
					
			?>
		</div>
		
	</div>


<?php amp_footer(); ?>