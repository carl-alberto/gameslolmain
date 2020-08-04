<?php get_header(); ?>
<div id="archivepage" class="container-fluid page">
	<div id="pageheader" class="container-fluid section_bg minigames_header">
		<div class="minigames_share">
			<?php echo do_shortcode("[addtoany]"); ?>
		</div>
		<?php
			$page_title = ( get_option("minigame_page_title") <> '' ) ? get_option("minigame_page_title") : 'Mini Games';
		?>
		<h1 id="page_title" class="minigames_title" align="center"><?php echo $page_title; ?></h1>
		<h2 id="page_subtitle" class="minigames_subtitle"><?php echo get_option("minigame_page_subtitle"); ?></h2>
	</div>
	<div id="pagecontent" class="container-expand">
		<div id="minigame_tags" class="container-fluid">
			<b>MINI GAME TAGS</b>
			<?php $minigame_tags = get_terms([
								'taxonomy' => 'minigame_tag',
								'hide_empty' => false,
							]);
				foreach($minigame_tags as $tag){
					$tag_color = get_option( "taxonomy_term_".$tag->term_id );
					$tag_color = $tag_color['tag_color'];
					$tag_archive = get_term_link($tag,'minigame_tag');
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
		<div class="grid grid_minigame container-fluid">
		<?php while(have_posts()) : the_post(); 
			include( locate_template( 'loop/content_grid_minigame.php', false, false ) );
			endwhile;?>
		</div>
		
		<div id="pagination" align="center" class="container-fluid">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?><br>
		<div class="container">
			<?php echo get_option("minigame_page_content"); ?>
		</div>

	</div>
	
</div>
<?php get_footer(); ?>