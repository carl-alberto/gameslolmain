<?php get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

add_gameviews(get_the_ID());
$game_info = get_the_game_info(get_the_id());

?>
	<div id="gamepage" class="container-fluid page downloadpage"
		data-gametitle="<?php the_title();?>"
		data-postID="<?php the_ID();?>"
		data-downloadlink="<?php echo $game_info['link']; ?>"
		data-downloadlink-mobile="<?php echo $game_info['link_apk']; ?>"
		data-downloadlink-mac="<?php echo $game_info['link_mac']; ?>"
		data-os="PC" >
		
	<?php

			if($game_info['banner'] <> "" ){ ?>
			<section id="gamebanner" class="container-fluid">
				<img class="banner <?php echo $game_info['flipped']; ?>" src="<?php echo $game_info['banner']; ?>"
					  alt="<?php echo $game_info['banner_alt']; ?>"
					  title="<?php echo $game_info['banner_alt'];  ?>" >
				<div class="overlay">
					<?php if($game_info['floatingbutton'] <> "" ){ ?>
					<div class="gameimg">
						<img src="<?php echo $game_info['floatingbutton']; ?>"
                      		 class="<?php echo $game_info['flipped']; ?>"
							  alt="<?php echo $game_info['floatingbutton_alt']; ?>"
							  title="<?php echo $game_info['floatingbutton_alt'];  ?>" >
					</div>
					<?php } ?>
					<button class="goDownload downloadbtn" data-ga-category="Game" data-ga-action="Center-Banner-Download">
						<span class="btn_text">Play <?php the_title(); ?></span>
					</button>
				</div>
				
			</section>
		<?php } ?>
			
		<section id="gameheader" class="container-fluid">
			<div class="sectioncontent container">
				<?php if($game_info['icon'] <> "" ){ ?>
				<div id="game_icon">
					<img class="game_icon <?php echo $game_info['flipped']; ?>" src="<?php echo $game_info['icon']; ?>"
							alt="<?php echo $game_info['icon_alt']; ?>"
							title="<?php echo $game_info['icon_alt'];  ?>" > 
				</div>
				<?php } ?>
				<div id="game_meta">
					<div class="meta_title">
					<h2 id="title" class="notranslate"><?php the_title(); ?></h2>
					<p class="meta developer"><?php echo $game_info['developer']; ?></p>
					</div>
					<?php echo do_shortcode('[addtoany]'); ?>
				</div>
				<div id="game_title">
					<p class="meta categories"><?php the_category(' '); ?></p>
				</div>
			</div>
		</section>
		
		<?php if($game_info['floatingbutton'] <> "" ){ ?>
			<div id="gamebutton">
				<img class="gameimg <?php echo $game_info['flipped']; ?>"
					src="<?php echo $game_info['floatingbutton']; ?>"
					alt="<?php echo $game_info['floatingbutton_alt']; ?>"
					title="<?php echo $game_info['floatingbutton_alt'];  ?>" > 
				<button class="goDownload downloadbtn" data-ga-category="Game" data-ga-action="Floating-Button-Download">
						<span class="btn_text">Play <?php the_title(); ?></span>
				</button>
			</div>
		<?php } ?>
		<h1 id="page_title" class="container">
				<?php if($game_info['customh1'] <> '' ) { ?>
						<span class="notranslate"><?php echo $game_info['customh1']; ?></span>
					<?php } else { ?>
						Download <span class="notranslate"><?php the_title(); ?></span> on PC
					<?php } ?>
		</h1>
		<?php if($game_info['video'] <> "" ){ ?>
		<section id="gamevideo" class="container-fluid">
			
			<div class="sectioncontent container">
               <iframe width="853" height="505"
                	src="https://www.youtube.com/embed/<?php echo $game_info['video_id']; ?>?autoplay=0">
                </iframe>
			</div>
		</section>
		<?php } ?>
		
		<section id="gamecontent" class="container-fluid  <?php echo $game_info['flipped']; ?>">
			<div class="sectioncontent container">
				<?php the_content(); ?>
			</div>
			
		</section>
		<section id="gamedownload" class="container-fluid">
			<div class="sectionheader">
				<div class="container">
				<h3>Game Download</h3>
				</div>
			</div>
			<div class="sectioncontent container">
				<h2>Get ready to play!</h2>
				
					<button class="goDownload downloadbtn" data-ga-category="Game" data-ga-action="Bottom-Banner-Download">
						<span class="btn_text">Play <?php the_title(); ?></span>
					</button>
				<br/>
				<h4>
					Follow these easy steps to complete<br/>
					your <?php the_title(); ?> installation.
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
		<section id="gamereviews" class="container-fluid section_bg">
			<div class="sectionheader">
				<div class="container">
				<h3>Ratings and Reviews</h3>
				</div>
			</div>
			<div class="sectioncontent container">
				<style type="text/css">
						.rr_required:after { content: '' !important; }
						.rr_review_post_id, .rr_review_text .drop_cap { display: none; }
						.rr_review_text { font-size: 12pt; }
				</style>
				<div class="rich_reviews container-fluid">
					<?php echo do_shortcode('[RICH_REVIEWS_SHOW category="post" num="3" id="'.get_the_id().'"]'); ?>
				</div>
				
				<p align="center">
						<button class="btn btn-info" data-toggle="modal" data-target="#game_reviews_all" style="color: black; text-shadow: none;">View All Reviews</button>
						<button class="btn btn-warning" data-toggle="modal" data-target="#game_reviews_submit" style="color: black; text-shadow: none;">Submit a Review</button>
				</p>
			</div>
		</section>
		
		<!----- POPUP REVIEW FORM ----->
		<div class="modal fade" id="game_reviews_submit" tabindex="-1" role="dialog" aria-labelledby="gameReviewsSubmit" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Leave a Review for <?php the_title(); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			<div class="modal-body">
				<style type="text/css">
						/* #game_reviews_form{ padding-top: 50px; }*/
						.submitreview table{ width:100%; }
						.submitreview .rr_form_heading { width: 150px; }
						.submitreview input[type="submit"]{ background: #55C054; border: 1px solid green; padding: 10px 20px; border-radius: 5px; } </style>
									<div id="game_reviews_form" class="submitreview container-fluid">
									<?php // echo do_shortcode('[RICH_REVIEWS_FORM category="post"]'); ?>
									<iframe frameborder="0" width="100%" height="400" src="<?php echo site_url()."/rr/".get_the_ID(); ?>">
									</iframe>
									</div>
				 </div>
			</div>
		  </div>
		</div>

		<!----- POPUP ALL REVIEWS ----->
		<div class="modal fade" id="game_reviews_all" tabindex="-1" role="dialog" aria-labelledby="gameReviewsAll" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
					<h5 class="modal-title">All Reviews for <?php the_title(); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
			  </div>
			  <div class="modal-body">
					 <?php echo do_shortcode('[RICH_REVIEWS_SHOW category="post" num="all" id="'.get_the_id().'"]'); ?>
			  </div>
			</div>
		  </div>
		</div>
		
		<!----- LIGHTBOX FOR DOWNLOAD ----->
		
		<?php 
			$arrowlogo = $game_info['floatingbutton'];
			$lightboxicon = $game_info['icon'];
           	$lb_images_flipped = $game_info['flipped'];
			include 'inc/game_lightbox.php'; ?>
		
		<!----- RELATED GAMES & ARTICLES ----->
		
		<?php 
			$query_id = array( get_the_ID() );
			$cats = get_the_category();
			$query_cats = array();
			foreach($cats as $cat){
				array_push($query_cats, $cat->term_id);
			};
		?>
		
		<section id="relatedgames" class="container-fluid">
			<div class="sectionheader">
				<div class="container">
				<h3>Recommended Games for you</h3>
				</div>
			</div>
			<div class="sectioncontent container">
				<?php include( locate_template( 'inc/related_games.php', false, false ) ); ?>
			</div>
		</section>
		<section id="relatedarticles" class="container-fluid section_bg">
			<div class="sectionheader">
				<div class="container">
					<h3>Related Articles</h3>
				</div>
			</div>
			<div class="sectioncontent container">
			<?php include( locate_template( 'inc/related_articles.php', false, false ) ); ?>
			</div>
		</section>
		
</div>

<?php endwhile; else : ?>
	
		<h1>Page not found</h1>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		
<?php endif; 
get_footer(); ?>