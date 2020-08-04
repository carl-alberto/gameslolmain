<?php get_header(); ?>
   
	<div id="_404page" class="container-fluid page">
		<div class="container">		
			<div class="_404zomzom">
				<img src="<?php echo get_template_directory_uri(); ?>/images/zomzom.png" />
			</div>
			<div class="_404messagetop">
				<h2>Oops!<br/>You have found Zomzom, the Zombie!</h2>
				<p>Run home before he comes for your brains!</p>
			</div>
			<div class="_404messagebottom">
				<h1><i class="fa fa-exclamation-triangle"></i>404</h1>
				<p>Sorry, the page you're looking for can't be found.<br/>
				Use the search bar above to find something else! </p>
				<p align="center"><a href="<?php echo site_url(); ?>" class="_404button">Go Home</a></p>
				</div>
			</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>