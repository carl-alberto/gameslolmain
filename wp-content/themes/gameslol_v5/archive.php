<?php get_header(); ?>
<div id="archivepage" class="container-fluid page">
	<div id="pageheader" class="container-fluid section_bg">
		<h1 id="page_title" align="center"><?php echo single_cat_title('',false); ?></h1>
	</div>
	<div id="pagecontent" class="container-expand">
		<?php if(have_posts()) : ?>
		<div class="grid grid_game container-fluid">
		<?php while(have_posts()) : the_post(); 
			include( locate_template( 'loop/content_grid_game.php', false, false ) );
			endwhile;?>
		</div>
		<div class="container-fluid">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
</div>
<?php get_footer(); ?>