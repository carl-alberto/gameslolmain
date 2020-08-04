<?php get_header(); ?>
<div id="archivepage" class="container-fluid page">
	<div id="pageheader" class="container-fluid section_bg">
		<h1 id="page_title" align="center"><?php echo (get_option('review_page_title') <> '') ? get_option('review_page_title') : get_the_archive_title(); ?></h1>
	</div>
	<div id="pagecontent" class="container-expand">
		<?php if( get_option('article_page_content') <> '' ){ ?>
		 <div class="container">
			 <?php echo get_option('article_page_content'); ?>
		</div><br>
		<?php } ?>
		<?php if(have_posts()) : ?>
		<div class="grid grid_article container-fluid">
		<?php while(have_posts()) : the_post(); 
			include( locate_template( 'loop/content_grid_article.php', false, false ) );
			endwhile;?>
		</div>
		
		<div id="pagination" align="center" class="container-fluid">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>
	</div>
	
</div>
<?php get_footer(); ?>