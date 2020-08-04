<?php amp_header(); ?>

	<div id="pageheader">
		<h1>Unblocked Apps</h1>
	</div>
	<div id="pagecontent" class="container">
		<?php if(have_posts()) : ?>
		<div class="grid grid_game">
		<?php while(have_posts()) : the_post(); 
			include( 'loop_grid_game.php' );
			endwhile;?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>