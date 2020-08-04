<?php
/* Template Name: New Homepage (Dark Theme) */
get_header('new'); ?>

<!-- MARCH UPDATE : NEW HOMEPAGE -->
<div id="new_homepage" class="container-fluid page archivepage" data-OS="PC">
	
		<!-- SLIDER HERE -->
		<div id="home_featured_games" style="position: relative;">
			<?php echo do_shortcode("[gameslol_featuredslider]"); ?>
		</div>
		<!-- CAROUSEL HERE -->
		<div id="home_top_games" class="container" style="position: relative; margin-top: -60px;">
		<h2 class="widget_title">Top Free Games</h2>
			<?php echo do_shortcode('[gameslol_gamecarousel quickdownload="true"]'); ?>
		</div>
		<!-- NEW GAMES -->
		<div id="home_latest_games" class="container">
		<h2 class="widget_title">New Games</h2>
			<?php include( locate_template( 'inc/front_page_latest.php', false, false ) ); ?>
		<hr />
		</div>
		<!-- PAGE CONTENT -->
		<div id="home_content" class="container">
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="home_content_article" class="container-fluid">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
			<?php endwhile; endif; ?>
					
		<!-- WIDGETS -->
		<?php if ( is_active_sidebar( 'new-homepage-widgets' ) )
				{ ?>
		<div id="home_widgets" class="container-expand">			
		<hr />
				<?php dynamic_sidebar( 'new-homepage-widgets' ); ?>
		</div>
		<?php
				} 
		
		?>
		</div>
</div>

<?php
wp_reset_postdata();
get_footer('new'); ?>