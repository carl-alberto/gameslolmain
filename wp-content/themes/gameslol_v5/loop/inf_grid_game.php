<?php

	if( !isset($force_quickdownload) ){ // check from shortcode
		$force_quickdownload = isset( $_GET['qd'] ) ? $_GET['qd'] : false;
	}

	if( isset($posts_to_show) ){ // check from shortcode
		$posts_per_page = $posts_to_show;
	} else {
		$posts_per_page = ( isset ($_GET['count']) ) ? ( $_GET['count'] ) : 24;
	}

	$paged = ( isset($_GET['paged']) ) ? $_GET['paged'] : 1;

	if( !isset($offset) ){  // check from shortcode
		$offset = ( isset ($_GET['offset']) ) ? ( $_GET['offset'] ) : 0;
	}

	$page_offset = $offset + ( ( $paged - 1 ) * $posts_per_page );
						
	$args = array(
			'orderby'        => 'postdate',
			'post_type'		 => 'post',
			'offset'		 => $page_offset,
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
		
		$total_posts = $query->found_posts - $offset;
		$total_pages = round( ($total_posts / $posts_per_page), 0);
		
	if( $paged < $total_pages ) { ?>
	<div id="LoadMore_<?php echo $paged; ?>"  class="loadmore container-fluid text-center">
		<a class="btn btn-lg btn-loadmore " 
		   data-page="<?php echo $paged + 1; ?>" data-pt="game"
		   data-count="<?php echo $posts_per_page; ?>" data-offset="<?php echo $offset; ?>"
		   <?php if($force_quickdownload) { echo 'data-qd="true"'; } ?> >
			<i class="fa fa-arrow-down"></i> MORE GAMES
		</a>
	</div>
	<?php }
    	wp_reset_postdata();
	?>

	<?php } else { ?>
		<p align="center">No posts found.</p>
	<?php } ?>