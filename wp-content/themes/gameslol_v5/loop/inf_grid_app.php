<?php

	$force_quickdownload = true;
	$posts_per_page = 24;
	$paged = ( isset($_GET['paged']) ) ? $_GET['paged'] : 1;
	$args = array(
			'orderby'        => 'postdate',
			'post_type'		 => 'unblockedapp',
			'paged'		 	 => $paged,
			'posts_per_page' => $posts_per_page,
			'post_status'	 => 'publish',
			'order'			 => 'DESC'
		);
				
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
	?>
			<?php while($query->have_posts()) : $query->the_post();
				include( locate_template( 'loop/content_grid_game.php', false, false ) );
				endwhile;
			?>

	<?php 
	if($paged < $query->max_num_pages) { ?>
	<div id="LoadMore_<?php echo $paged; ?>"  class="loadmore container-fluid text-center">
		<a class="btn btn-lg btn-loadmore " 
		   data-page="<?php echo $paged + 1; ?>" data-pt="app">
			<i class="fa fa-arrow-down"></i> MORE APPS
		</a>
	</div>
	<?php }
    	wp_reset_postdata();
	?>

	<?php } else { ?>
		<p align="center">No posts found.</p>
	<?php } ?>