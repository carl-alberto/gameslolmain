<?php get_header(); ?>

<div id="infopage" class="container-fluid page archivepage" 
		data-os="PC">
	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
			<div id="pageheader" class="container-fluid section_bg">
				<h1 id="page_title" align="center" class="container"><?php the_title(); ?></h1>
			</div>
			<div id="pagecontent" class="container">
				
				  <?php the_content(); ?>
				  
			</div>
			
		<?php endwhile; endif; 
	?>
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

<?php get_footer(); ?>