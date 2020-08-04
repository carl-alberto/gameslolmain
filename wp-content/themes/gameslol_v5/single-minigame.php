<?php get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

add_gameviews(get_the_ID());
$game_info = get_the_minigame_info(get_the_id());

?>
	<div id="minigamepage" class="container-fluid page playpage"
		data-gametitle="<?php the_title();?>"
		data-postID="<?php the_ID();?>"
		data-playerlink="<?php echo $game_info['player']; ?>">
		
	<?php
		if($game_info['banner'] <> "" ){ ?>
		<section id="gamebanner" class="container-fluid">
			<?php if($game_info['header_video'] <> '') { ?>
				<video class="video_overlay" autoplay muted loop >
							<source src="<?php echo $game_info['header_video'] ?>" type="video/mp4">
							Your browser does not support the video tag.
				</video>
			<?php } else { ?>
				<img class="banner" src="<?php echo $game_info['banner']; ?>"
					  alt="<?php echo $game_info['banner_alt']; ?>"
					  title="<?php echo $game_info['banner_alt'];  ?>" >
			<?php } ?>
			<div class="overlay">
				<?php if($game_info['floatingbutton'] <> "" ){ ?>
				<div class="gameimg">
					<img src="<?php echo $game_info['floatingbutton']; ?>"
						  alt="<?php echo $game_info['floatingbutton_alt']; ?>"
						  title="<?php echo $game_info['floatingbutton_alt'];  ?>" >
				</div>
				<?php } ?>
				<button class="goPlay playbtn" data-ga-category="Mini Game" data-ga-action="Center-Banner-Play">
					<span class="btn_text">Play Now</span></button>
			</div>

		</section>
		<?php } ?>
			
		<section id="gameheader" class="container-fluid">
			<div class="sectioncontent container">
				<?php if($game_info['icon'] <> "" ){ ?>
				<div id="game_icon">
					<img class="game_icon" src="<?php echo $game_info['icon']; ?>"
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
					<p class="meta categories"><?php the_terms(get_the_ID(), 'minigame_tag', '', '', ''); ?></p>
						
				</div>
			</div>
		</section>
		
		<?php if($game_info['floatingbutton'] <> "" ){ ?>
			<div id="gamebutton">
				<img class="gameimg"
					src="<?php echo $game_info['floatingbutton']; ?>"
					alt="<?php echo $game_info['floatingbutton_alt']; ?>"
					title="<?php echo $game_info['floatingbutton_alt'];  ?>" > 
				<button class="goPlay playbtn" data-ga-category="Mini Game" data-ga-action="Floating-Button-Play">
					<span class="btn_text">Play Now</span></button>
			</div>
		<?php } ?>
		<h1 id="page_title" class="container">
				<?php if($game_info['customh1'] <> '' ) { ?>
						<span class="notranslate"><?php echo $game_info['customh1']; ?></span>
					<?php } else { ?>
						Download <span class="notranslate"><?php the_title(); ?></span> on PC
					<?php } ?>
		</h1>
		<section id="gamecontent" class="container-fluid">
			<div class="sectioncontent container">
				<?php the_content(); ?>
			<p align="center">	
				<button class="goPlay playbtn" data-ga-category="Mini Game" data-ga-action="Bottom-Banner-Play">
					<span class="btn_text">Play Now</span></button>
			</p>		
		</section>
		
		<!----- POPUP GAME PLAYER ----->
		<?php include( locate_template( 'inc/minigame_popup.php', false, false ) ); ?>
		
		
		<!----- RELATED GAMES & ARTICLES ----->
		
		<?php 
			$query_id = array( get_the_ID() );
		?>
		<section id="relatedgames" class="container-fluid">
			<div class="sectionheader">
				<div class="container">
				<h3>Recommended Mini Games for you</h3>
				</div>
			</div>
			<div class="sectioncontent container">
				<?php include( locate_template( 'inc/related_minigames.php', false, false ) ); ?>
			</div>
		</section>
		<?php if(!check_chromeOS()){ ?>
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
		<?php } ?>
		
</div>

<?php endwhile; else : ?>
	
		<h1>Page not found</h1>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		
<?php endif; 
get_footer(); ?>