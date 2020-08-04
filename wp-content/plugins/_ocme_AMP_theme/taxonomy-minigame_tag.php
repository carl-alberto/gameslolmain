<?php amp_header(); ?>

<?php
	$the_tax = get_queried_object();
	$tax_terms = get_option( "taxonomy_term_".$the_tax->term_id );
?>
	<div id="pageheader">
		<h2><?php echo single_term_title( '', false ); ?></h2>
	</div>
	<div id="pagecontent" class="container">
		<h1><?php if($tax_terms['custom_title'] <> "") {
				echo $tax_terms['custom_title'];
			  } else {
				echo single_term_title( '', false );
				} ?>
		</h1>
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
		<p align="center"><a class="reviewbtn yellow" href="<?php echo get_post_type_archive_link( 'minigame' ); ?>amp">Back to All Mini Games</a></p>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>