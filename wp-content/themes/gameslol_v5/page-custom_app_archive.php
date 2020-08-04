<?php
/* Template Name: Custom Unblocked App Archive Page */
?>
<?php get_header(); ?>
<div id="archivepage" class="container-fluid page archivepage" 
		data-os="PC">
	
	<div id="pageheader" class="container-fluid section_bg">
	<h1 id="page_title" align="center"><?php the_title(); ?></h1>
</div>
<div id="pagecontent" class="container-expand">
	<div id="minigame_tags" class="container-fluid">
			<b>APP CATEGORIES</b>
			<?php $app_categories = get_terms([
								'taxonomy' => 'app_category',
								'hide_empty' => true,
							]);
				foreach($app_categories as $cat){
					$cat_terms = get_option( "taxonomy_term_".$cat->term_id );
					$tag_color = $cat_terms['tag_color'];
					$tag_archive = get_term_link($cat,'app_category');
				?>
					<a href="<?php echo $tag_archive; ?>"
						style="color: <?php echo $tag_color; ?>;">
						<b><?php echo $cat->name; ?></b> (<?php echo $cat->count; ?>)
					</a>
				<?php 
				}
			?>
	</div>
	<div class="container">
		<p align="center">
			<?php the_content(); ?>
		</p>		
	</div>
	<div id="apps_all" class="grid grid_game container">
		<?php
			include( locate_template( 'loop/inf_grid_app.php', false, false ) );
		?>
	</div>
	
	
	<?php
	global $post;
	if( has_shortcode( $post->post_content, 'gameslol_grid') ){
		?>
		<!----- LIGHTBOX FOR DOWNLOAD ----->
		<?php
		$arrowlogo = get_theme_mod( 'setting_logo');
		$lightboxicon = get_theme_mod( 'setting_logo');
		include 'inc/game_lightbox.php';
		?>
		<!----- LIGHTBOX FOR PLAY ----->
		<?php
		include( locate_template( 'inc/minigame_popup.php', false, false ) );
	}
	?>
	
</div>	
</div>
<?php get_footer(); ?>