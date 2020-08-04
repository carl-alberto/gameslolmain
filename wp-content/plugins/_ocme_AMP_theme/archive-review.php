<?php amp_header(); ?>

	<div id="pageheader">
		<h1>Game Reviews</h1>
	</div>
	<div id="pagecontent" class="container">
		<?php if(have_posts()) : ?>
		<div class="grid grid_article">
		<?php while(have_posts()) : the_post(); 
			include( 'loop_grid_review.php' );
			endwhile;?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>