<?php amp_header(); ?>

	<div id="pageheader">
		<h1>Editor's Blog</h1>
	</div>
	<div id="pagecontent" class="container">
		<?php if(have_posts()) : ?>
		<div class="grid grid_article">
		<?php while(have_posts()) : the_post(); 
			include( 'loop_grid_article.php' );
			endwhile;?>
		</div>
		<div id="pagination" class="container">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>