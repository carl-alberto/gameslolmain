
	<?php
	if(is_singular('post')) {
			$args = array (
				    'post__not_in' => $query_id,
					'category__in' => $query_cats,
					'orderby'        => 'rand',
					'showposts' => 5
			);
	} elseif(is_singular('unblockedgame')) {
			$args = array (
				    'post_type' => 'unblockedgame',
				    'post__not_in' => $query_id,
					'category__in' => $query_cats,
					'orderby'        => 'rand',
					'showposts' => 5
			);
	} elseif(is_singular('unblockedapp')) {
			$args = array (
				    'post_type' => 'unblockedapp',
				    'post__not_in' => $query_id,
					'category__in' => $query_cats,
					'orderby'        => 'rand',
					'showposts' => 5
			);
	} else {
			$args = array(
					'orderby'        => 'rand',
					'showposts' => 5
			);
	}
	$the_query = new WP_Query( $args ); 

	if ( $the_query->have_posts() ) : ?>
		
	<div class="grid grid_game container-fluid">
		
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php include( locate_template( 'loop/content_grid_game.php', false, false ) ); ?>

	<?php endwhile; ?>
	
	</div>
	<?php else: ?>
		No posts found.
	<?php endif; ?>