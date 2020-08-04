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
		
			<p align="center"><?php $description =  strip_tags(term_description($the_tax->term_id));
				echo $description; ?>
		 </p>
		<?php if(have_posts()) : ?>
		<div class="grid grid_game">
		<?php while(have_posts()) : the_post(); 
			include( 'loop_grid_game.php' );
			
			endwhile;?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
<?php amp_footer(); ?>