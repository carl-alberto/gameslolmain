<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
			<?php include( locate_template( 'loop/content_grid_game.php', false, false ) ); ?>
		
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>