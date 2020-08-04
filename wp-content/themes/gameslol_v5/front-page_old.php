<?php /* Template Name: Front Page */  ?>
<?php get_header(); ?>

<div id="homepage" class="container page container-expand archivepage" data-OS="PC">
		<div id="home_content_games">
			<?php 
				if(is_front_page()) {
					if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<h1 id="home_title"><?php the_title(); ?></h1>
						<div id="home_content_article"><?php the_content(); ?></div>
					<?php endwhile; endif; 
				}
			?>

		<?php
		wp_reset_postdata();
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
		<div id="default_sidebar" class="sidebar">
			<?php if ( is_active_sidebar( 'sidebar-widgets' ) )
					{ 
						dynamic_sidebar( 'sidebar-widgets' );
					} 
			?>
		</div>
	
		<div id="home_widgets">
		<?php if ( is_active_sidebar( 'homepage-widgets' ) )
				{ 
					dynamic_sidebar( 'homepage-widgets' );
				} 
		?>
		</div>
	
	
	
</div>


<?php get_footer(); ?>