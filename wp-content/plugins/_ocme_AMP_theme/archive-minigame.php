<?php amp_header(); ?>

	<div id="pageheader">
	<?php $page_title = ( get_option("minigame_page_title") <> '' ) ? get_option("minigame_page_title") : 'Mini Games'; ?>
		<h1><?php echo $page_title; ?></h1>
	</div>
	<div id="pagecontent" class="container">
		
		<div id="minigame_tags" class="category_cloud">
			<b>MINI GAME TAGS</b>
			<?php $minigame_tags = get_terms([
								'taxonomy' => 'minigame_tag',
								'hide_empty' => false,
							]);
				foreach($minigame_tags as $tag){
					$tag_color = get_option( "taxonomy_term_".$tag->term_id );
					$tag_color = $tag_color['tag_color'];
					$tag_archive = get_term_link($tag,'minigame_tag').'amp';
				?>
					<a href="<?php echo $tag_archive; ?>"
						style="color: <?php echo $tag_color; ?>;">
						<b><?php echo $tag->name; ?></b> (<?php echo $tag->count; ?>)
					</a>
				<?php 
				}
			?>
		</div>
		
		<?php if(have_posts()) : ?>
		<div class="grid grid_article">
		<?php while(have_posts()) : the_post(); 
			include( 'loop_grid_minigame.php' );
			endwhile;?>
		</div>
		<div id="pagination" class="container">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
		<div class="content">
			<?php echo get_option("minigame_page_content"); ?>
		</div>
		
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>