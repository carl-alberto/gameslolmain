<?php get_header(); ?>

<style type="text/css">
#pagecontent img{ display:block; margin:0 auto; }
</style>
<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();

		$info = get_the_review_info(get_the_id());

		if($info['gameID'] <> "" ){ 
			$relatedgame = get_the_game_info($info['gameID']);
		}
	?>
		
<div id="reviewpage" class="container-fluid page downloadpage"
		data-gametitle="<?php echo get_the_title($info['gameID']);?>"
		data-postID="<?php echo $info['gameID'];?>"
		data-downloadlink="<?php echo $relatedgame['link']; ?>"
		data-downloadlink-mobile="<?php echo $relatedgame['link_apk']; ?>"
		data-os="PC" >
		
	
		
			<div id="pageheader" class="container-fluid section_bg">
				<h1 id="page_title" align="center" class="container">Review for: <?php echo get_the_title($info['gameID']); ?></h1>
			</div>
			<?php 
				if ( $relatedgame['banner'] <> '' ) {
					?>
					<div id="pagebanner" class="container">
						<img id="featured_img" src="<?php echo $relatedgame['banner']; ?>"
							alt="<?php echo $relatedgame['banner_alt']; ?>"
							title="<?php echo $relatedgame['banner_alt']; ?>" />
					</div>
					<?php
					} 
			?>
			
		<div id="pagecontent" class="container">
			<h2 align="center"><?php the_title(); ?></h2>
			  <?php the_content(); ?>
			  
			  <p align="center">
					<a class="downloadbtn" href="<?php echo get_the_permalink($info['gameID']); ?>">
						<span class="btn_text">PLAY NOW</span></span>
					</a>
			  </p>

			<?php if( $info['source'] <> '' ){ ?>
				<hr/>
			<p class="meta text-secondary" align="right">Source: <a href="<?php echo $info['source']; ?>" target="_blank"><?php the_title(); ?></a></p>
		<?php } ?>
		  
			</div>
			
			
		<?php endwhile; endif; 
	?>
</div>

<?php get_footer(); ?>