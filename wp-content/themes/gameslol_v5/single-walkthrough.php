<?php get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	$walkthrough_info = get_the_walkthrough_info(get_the_id());
	$game = get_post($walkthrough_info['relatedgame']);
	$relatedgame = get_the_game_info($game->ID);

?>
	<div id="walkthroughpage" class="container-fluid page downloadpage <?php echo $templateclass; ?>"
		data-gametitle="<?php echo get_the_title($game->ID);?>"
		data-postID="<?php echo $game->ID;?>"
		data-downloadlink="<?php echo $relatedgame['link']; ?>"
		data-downloadlink-mac="<?php echo $relatedgame['link_mac']; ?>"
		data-downloadlink-mobile="<?php echo $relatedgame['link_apk']; ?>"
		data-packagename="<?php echo $relatedgame['app_id']; ?>"
		data-os="PC" >
		
		<section id="gameheader" class="container-fluid">
			<div class="sectioncontent container">
				<?php if($relatedgame['icon'] <> "" ){ ?>
				<div id="game_icon">
					<a href="<?php echo get_the_permalink($game->ID); ?>"><img class="game_icon" src="<?php echo $relatedgame['icon']; ?>"
							alt="<?php echo $relatedgame['icon_alt']; ?>"
							title="<?php echo $relatedgame['icon_alt'];  ?>" ></a>
				</div>
				<?php } ?>
				<div id="game_meta">
					<div class="meta_title">
					<h2 id="title" class="notranslate"><?php echo get_the_title($game->ID); ?></h2>
					<p class="meta developer"><?php echo $relatedgame['developer']; ?></p>
					</div>
					<?php echo do_shortcode('[addtoany]'); ?>
				</div>
				<div id="game_title">
					<p class="meta categories"><?php the_category(' ', multiple, $game->ID); ?></p>
				</div>
			</div>
		</section>
		
		<?php 
			if( !wp_get_post_parent_id( get_the_ID() ) ) { ?>
		
			
			<h1 id="page_title" class="container" align="center">
				<?php the_title(); ?>
			</h1>
			<section id="walkthroughcontent" class="container-fluid">
				<div class="sectioncontent container">
					<?php the_content(); ?>
					<br/>
					<?php 
						$levelcount = $walkthrough_info['level'];
						$walkthroughs = get_the_walkthrough_levels($game->ID);
						include( locate_template( 'inc/related_walkthroughs.php', false, false ) );
					?>
				</div>
			</section>
		
		<?php } else { ?>
		
			<h2 id="page_title" class="container" align="center">
				<?php echo get_the_title($game->ID);?> - Level <?php echo $walkthrough_info['level']; ?>
			</h2>
			<section id="walkthroughcontent" class="container-fluid">
				<div class="sectioncontent container">
					<div class="row">
						<div class="col-auto walkthrough_nav">
							<?php if($walkthrough_info['prevlink'] <> "") { ?>
							<a href="<?php echo $walkthrough_info['prevlink']; ?>"
							   alt="Previous Level" title="Previous Level">
							<?php } ?>
								<span class="fa fa-caret-left"></span>
							<?php if($walkthrough_info['prevlink'] <> "") { ?>
							</a>
							<?php } ?>
						</div>
						<div class="col">
								<h1 id="level_title" align="center"><strong><?php the_title(); ?></strong></h1>
							<?php the_content(); ?>
						</div>
						<div class="col-auto walkthrough_nav">
							<?php if($walkthrough_info['nextlink'] <> "") { ?>
							<a href="<?php echo $walkthrough_info['nextlink']; ?>"
							   alt="Next Level" title="Next Level">
							<?php } ?>
								<span class="fa fa-caret-right"></span>
							<?php if($walkthrough_info['nextlink'] <> "") { ?>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
			<section id="relatedwalkthroughs">
				<div class="sectionheader container-fluid">
					<div class="container">
					<h3>View walkthroughs of other levels</h3>
					</div>
				</div>
				<div class="sectioncontent container">
					<?php 
					  	$parent_id = wp_get_post_parent_id(get_the_id());
					  	$parent_info = get_the_walkthrough_info($parent_id);
						$levelcount = $parent_info['level'];
						$walkthroughs = get_the_walkthrough_levels($game->ID);
						include( locate_template( 'inc/related_walkthroughs.php', false, false ) );
					?>
					
				</div>
			</section>

			<?php } ?>
		
			<p align="center"><a href="<?php echo get_the_permalink(get_page_by_path('walkthroughs')->ID); ?>" class="btn btn-sm btn-warning">Back to All Games Walkthroughs</a></p>

			<?php 
					if($relatedgame['floatingbutton'] <> "") { ?>

					<div id="gamebutton" class="stick">
					<img class="gameimg"
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

</div>

<?php endwhile; else : ?>
	
		<h1>Page not found</h1>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		
<?php endif; 
get_footer(); ?>