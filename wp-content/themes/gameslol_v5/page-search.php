<?php /* Template Name: Search Form Page*/  ?>
<?php get_header(); ?>


<div id="archivepage" class="container-fluid page">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<div id="pageheader" class="container-fluid section_bg">
		<h1 id="page_title" align="center" class="container"><?php the_title(); ?></h1>
	</div>
	<div id="pagecontent" class="container">
		<?php the_content(); ?>
		<?php
			include( locate_template( 'searchform.php', false, false ) ); 
		?>
			
	</div>
	
	<?php endwhile; else : ?>
	
		<h1>Page not found</h1>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		
	<?php endif; ?>
	
</div>		

<?php get_footer(); ?>