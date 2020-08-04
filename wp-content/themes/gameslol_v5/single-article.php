<?php get_header(); ?>

<style type="text/css">
#pagecontent img{ display:block; margin:0 auto; }
</style>

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();

	$info = get_the_article_info(get_the_id());

	if($info['gameID'] <> "" ){ 
		$relatedgame = get_the_game_info($info['gameID']);
	}
		?>
		
<div id="articlepage" class="container-fluid page downloadpage"
		data-gametitle="<?php echo get_the_title($info['gameID']);?>"
		data-postID="<?php echo $info['gameID'];?>"
		data-downloadlink="<?php echo $relatedgame['link']; ?>"
		data-downloadlink-mac="<?php echo $relatedgame['link_mac']; ?>"
		data-downloadlink-mobile="<?php echo $relatedgame['link_apk']; ?>"
		data-packagename="<?php echo $relatedgame['app_id']; ?>"
		data-os="PC" >
		
	
		
			<div id="pageheader" class="container-fluid section_bg">
				<h1 id="page_title" align="center" class="container"><?php the_title(); ?></h1>
			</div>
				<?php 
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail_url();
					?>
					<div id="pagebanner" class="container">
						<img id="featured_img" src="<?php echo $thumbnail; ?>"
							alt="<?php the_title(); ?>"
							title="<?php the_title(); ?>" />
					</div>
					<?php
					} 
			  	?>
			 <?php if ($info['video_id']<>"") { ?>
			<div id="video" class="container">
               <iframe width="853" height="505"
                	src="https://www.youtube.com/embed/<?php echo $info['video_id']; ?>?autoplay=0">
                </iframe>
			</div>
			<?php } ?>
			<div id="pagecontent" class="container">
		  
			  <?php the_content(); ?>
			  <hr/>
			<p class="meta text-secondary" align="right">Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
		  	
			</div>
			  <?php if($info['gameID'] <> "" ){ ?>
		    <section id="gamedownload" class="container-fluid section_bg">
			<div class="sectionheader">
				<div class="container">
				<h3>Game Download</h3>
				</div>
			</div>
			<br/>
			<div class="sectioncontent container">
				<h2>Get ready to play!</h2>
						<button class="goDownload downloadbtn" data-ga-category="Article" data-ga-action="Bottom-Banner-Download"><span class="btn_text">PLAY NOW</span></button>
				<br/>
				<h4>
					Follow these easy steps to complete<br/>
					your <?php echo get_the_title($info['gameID']); ?> installation.
				</h4>
				<br/>
				<div class="downloadsteps row">
					<div class="col-sm">
						<span class="stepnum">1</span><br>
						Click the downloaded file at the bottom of your screen.
					</div>
					<div class="col-sm">
						<span class="stepnum">2</span><br>
						Click "Yes" on the system dialog window to start of your game installation.
					</div>
					<div class="col-sm">
						<span class="stepnum">3</span><br>
						Once download is completed, the game will start automatically.
					</div>
				</div>
			</div>
			
		</section>
			<?php } ?>		  
			
		  	<?php 
				if($relatedgame['floatingbutton'] <> "") { ?>
				
				<div id="gamebutton" class="stick">
				<img class="gameimg <?php echo $relatedgame['flipped']; ?>"
					src="<?php echo $relatedgame['floatingbutton']; ?>"
					alt="<?php echo $relatedgame['floatingbutton_alt']; ?>"
					title="<?php echo $relatedgame['floatingbutton_alt'];  ?>" > 
					<button class="goDownload downloadbtn" data-ga-category="Article" data-ga-action="Floating-Button-Download">
						<span class="btn_text">PLAY NOW</span></button>
				
			<?php 
				} ?>
			  	
				  
			</div>
			
		<!----- LIGHTBOX FOR DOWNLOAD ----->
		<?php 
			$arrowlogo = $relatedgame['floatingbutton'];
			$lightboxicon = $game_info['icon'];
			include 'inc/game_lightbox.php'; ?>
		
		<?php endwhile; endif; 
	?>
</div>

<?php get_footer(); ?>