<?php get_header(); ?>

<div id="archivepage" class="container-fluid page">
	<div id="pageheader" class="container-fluid section_bg">
		<h1 id="page_title" align="center" class="container">
			<?php printf( esc_html__( 'Search Results for: %s', stackstar ), '<span class="notranslate">' . get_search_query() . '</span>' ); ?>
		</h1>
	</div>

	
	<div id="pagecontent" class="container">
		<?php if(have_posts()) : ?>
		
		<div class="grid <?php echo (check_chromeOS()) ? 'grid_minigame' : 'grid_game'; ?> container-fluid">
		<?php while(have_posts()) : the_post(); 
			if(check_chromeOS()) {
				include( locate_template( 'loop/content_grid_minigame.php', false, false ) );
			} else {
				include( locate_template( 'loop/content_grid_game.php', false, false ) );
			}
			endwhile;?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	<?php
			include( locate_template( 'searchform.php', false, false ) ); 
		?>
	</div>
	
</div>
<?php get_footer(); ?>