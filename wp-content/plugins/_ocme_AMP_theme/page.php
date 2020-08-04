<?php amp_header(); ?>

<?php
	if(is_home()){ ?>
	
	<div id="frontpage" class="container">
		<?php include('front-page.php'); ?>
	</div>
	
	<?php } else { ?>
	
	<div id="pageheader">
		<?php amp_title(); ?>
	</div>
	<div id="pagecontent" class="container">
		<?php amp_featured_image(); ?>
		<?php amp_content(); ?>
	</div>

	<?php } ?> 

<?php amp_footer(); ?>