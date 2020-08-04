<?php
/* Template Name: Custom FAQ Archive Page */
?>
<?php get_header(); ?>
<div id="archivepage" class="container-fluid page archivepage" 
		data-os="PC">
	
	<div id="pageheader" class="container-fluid section_bg">
	<h1 id="page_title" align="center"><?php the_title(); ?></h1>
</div>
<div id="pagecontent" class="container-expand">
	<div class="container">
		<p align="center">
			<?php the_content(); ?>
		</p>		
	</div>
	<div class="grid grid_walkthrough grid_icons container-fluid">

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
			
					foreach($grid_games as $game_id => $game_faq){
						global $post;
						$post = get_post($game_id);
						include( locate_template( 'loop/content_grid_faq.php', false, false ) );
						
					}
					
			?>
			
		</div>
</div>	
</div>
<?php get_footer(); ?>