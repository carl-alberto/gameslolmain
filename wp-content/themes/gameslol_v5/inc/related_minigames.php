
	<?php
	if(is_singular('minigame')) {
			$args = array (
					'post_type'	   => 'minigame',
				    'post__not_in' => $query_id,
					'orderby'        => 'rand',
					'showposts' => 4
			);
	}
	else {
			$args = array(
					'orderby'   => 'rand',
					'showposts' => 4
			);
	}
	$the_query = new WP_Query( $args ); 

	if ( $the_query->have_posts() ) : ?>
		
	<div class="grid grid_minigame container-fluid">
		
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php include( locate_template( 'loop/content_grid_minigame.php', false, false ) ); ?>

	<?php endwhile; ?>
	
	</div>
	<?php else: ?>
		No posts found.
	<?php endif; ?>