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
		<div class="grid grid_game">
		<?php while(have_posts()) : the_post(); 
			include( 'loop_grid_game.php' );
			endwhile;?>
		</div>
		<?php
			// $mainpage_url = get_post_type_archive_link( 'unblockedapp' );
			$mainpage_url = get_the_permalink(get_page_by_path('apps')).'amp';
		?>
		<p align="center"><a class="reviewbtn yellow" href="<?php echo $mainpage_url; ?>">Back to All Unblocked Apps</a></p>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>