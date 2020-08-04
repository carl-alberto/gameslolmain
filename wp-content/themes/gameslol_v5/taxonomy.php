<?php get_header(); ?>

<?php
	$the_tax = get_queried_object();
	$tax_terms = get_option( "taxonomy_term_".$the_tax->term_id );
?>

<div id="archivepage" class="container-fluid page">
	<div id="pageheader" class="container-fluid section_bg">
		<div class="row">
			<div class="col-12 col-md-3">
			</div>
			<div class="col">
				<h2 align="center" class="archive_subtitle">
				<?php  echo single_term_title( '', false ); ?>
				</h2>
			</div>
			<div id="archive_share" class="col-12 col-md-3 text-center text-md-right">
				<?php echo do_shortcode("[addtoany]"); ?>
			</div>
		</div>
		
	</div>
	<div id="pagecontent" class="container-expand">
		<h1 id="page_title" align="center">
		<?php if($tax_terms['custom_title'] <> "") {
				echo $tax_terms['custom_title'];
			  } else {
				echo single_term_title( '', false );
				}
		?></h1>
		<?php if($tax_terms['video_url'] <> "" ){ 
				$video_link = explode('/', $tax_terms['video_url']);
				$video_id = $video_link[4];
		?>
		<div id="term_video" class="container-fluid text-center">
				
               <iframe width="853" height="505"
                	src="https://www.youtube.com/embed/<?php echo $video_id; ?>?autoplay=0">
                </iframe>
		</div>
		<?php } ?>
		<div id="term_description" class="container" align="center">
			<p>
			<?php echo term_description($the_tax->term_id); ?>
			</p>
		</div>
		<?php if(have_posts()) : 
		
			if(is_tax('app_category')){
				$grid = 'grid_game';
			  } elseif(is_tax('minigame_tag')) {
				$grid = 'grid_minigame';
			  } else {
				$grid = 'grid_game';
			  }
		?>
		<div class="grid <?php echo $grid; ?> container-fluid">
		<?php while(have_posts()) : the_post(); 
			include( locate_template( 'loop/content_'.$grid.'.php', false, false ) );
			endwhile;?>
		</div>
		<div id="pagination" align="center" class="container-fluid">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
		<br>
		
		
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
		<div id="term_content" class="container">
			
			<?php $the_content = stripslashes($tax_terms['custom_content']);
				echo apply_filters('the_content', $the_content); ?>
			
			<p align="center"><br>
				<?php if(is_tax('app_category')){
					?><a href="<?php echo get_the_permalink(get_page_by_path('apps')->ID); ?>" class="btn btn-sm btn-warning">Back to All Apps</a>
					<?php
				  } elseif(is_tax('minigame_tag')) {
					?><a href="<?php echo get_post_type_archive_link('minigame'); ?>" class="btn btn-sm btn-warning">Back to All Mini Games</a>
					<?php
				  }
				?>
			</p>
		</div>
	</div>
	
</div>
<?php get_footer(); ?>