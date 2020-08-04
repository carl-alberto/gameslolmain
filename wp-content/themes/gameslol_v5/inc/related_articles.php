
	<?php
	
	$showposts = 4;

	if(is_single()) {
		$args = array(
			'post_type'	 => 'article',
			'orderby'    => 'rand',
			'showposts'  => $showposts,
			'meta_query' => array(
				array(
					'key'     => 'article_relatedgame',
					'value'   => $query_id,
					'compare' => 'IN',
				),
			),
		);
	} else {
		$args = array(
			'post_type'	=> 'article',
			'orderby'   => 'rand',
			'showposts' => $showposts
			);
	}
	
	$the_query = new WP_Query( $args ); 
	
	$countposts = 0;
	$the_ids = array(); ?>


	<div class="grid grid_article container-fluid">
	
	<?php if ( $the_query->have_posts() ) : ?>
		
		
			<?php while ( $the_query->have_posts() ) : $the_query->the_post();
					include( locate_template( 'loop/content_grid_article.php', false, false ) );
					$countposts++;
					array_push($the_ids, get_the_ID());
			endwhile; ?>
			
	<?php endif; ?>
	
	<?php 
	// Show more articles for filler
		if($countposts < $showposts){
			$args = array(
					'post_type'	=> 'article',
					'orderby'   => 'rand',
					'post__not_in' => $the_ids,
					'showposts' => $showposts - $countposts
					);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
			include( locate_template( 'loop/content_grid_article.php', false, false ) );
			endwhile; endif;
		}
	?>
	
	</div>