<?php
/* Template Name: Custom Game Archive Page */
?>
<?php get_header(); ?>
<div id="archivepage" class="container-fluid page archivepage" 
		data-os="PC">
	
	<div id="pageheader" class="container-fluid section_bg">
	<h1 id="page_title" align="center"><?php the_title(); ?></h1>
</div>
<div id="pagecontent" class="container-expand">
	<div class="container">
		<p align="center">
			<?php the_content(); ?>
		</p>		
	</div>
	<div id="game_all" class="grid grid_game container">
		<?php
			$force_quickdownload = true;
			include( locate_template( 'loop/inf_grid_game.php', false, false ) );
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