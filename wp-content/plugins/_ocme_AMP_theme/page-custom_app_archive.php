<?php
/* Template Name: Custom Unblocked App Archive Page */
?>
<?php amp_header(); ?>

<div id="pageheader">
		<?php amp_title(); ?>	
	</div>
	<div id="pagecontent" class="container">
	<div id="app_categories" class="category_cloud">
			<b>APP CATEGORIES</b>
			<?php $app_categories = get_terms([
								'taxonomy' => 'app_category',
								'hide_empty' => true,
							]);
				foreach($app_categories as $cat){
					$cat_terms = get_option( "taxonomy_term_".$cat->term_id );
					$tag_color = $cat_terms['tag_color'];
					$tag_archive = get_term_link($cat,'app_category').'amp';
				?>
					<a href="<?php echo $tag_archive; ?>"
						style="color: <?php echo $tag_color; ?>;">
						<b><?php echo $cat->name; ?></b> (<?php echo $cat->count; ?>)
					</a>
				<?php 
				}
			?>
	</div>
		<div class="content">
		<?php amp_content(); ?>
		</div>
		<div class="grid grid_game">
		<?php
			$args = array(
					'post_type'	=> 'unblockedapp',
					'post_status'	=> 'publish',
					'orderby'        => 'postdate',
					'posts_per_page' => -1
				);
				$the_query = new WP_Query( $args ); 
				if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php include('loop_grid_game.php'); ?>

				<?php endwhile;
		endif;	?>
		</div>
		
	</div>

<?php amp_footer(); ?>