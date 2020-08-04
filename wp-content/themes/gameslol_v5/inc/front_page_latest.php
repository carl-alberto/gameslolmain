<div class="grid grid_minigame container-fluid">
	<?php
	$query_args = array(
		'post_status'	 => 'publish',
		'post_type'		 => 'post',
		'orderby'        => 'postdate',
		'posts_per_page' => 10
	);

	$the_query = new WP_Query( $query_args ); 

	if ( $the_query->have_posts() ) : 
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
	include( locate_template( 'loop/content_grid_game_thumbnails.php', false, false ) );
	endwhile;
	endif;
	?>
</div>	