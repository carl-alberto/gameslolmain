<?php get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

add_gameviews(get_the_ID());
$game_info = get_the_game_info(get_the_id());

$templateclass = '';
switch($game_info['template']){
	case 'Template 1': $templateclass = 'gptemplate_1'; break;
    case 'Template 2': $templateclass = 'gptemplate_2'; break;
}
?>
	<div id="gamepage" class="container-fluid page downloadpage <?php echo $templateclass; ?>"
		data-gametitle="<?php the_title();?>"
		data-postID="<?php the_ID();?>"
		data-downloadlink="<?php echo $game_info['link']; ?>"
		data-downloadlink-mobile="<?php echo $game_info['link_apk']; ?>"
		data-downloadlink-mac="<?php echo $game_info['link_mac']; ?>"
		data-packagename="<?php echo $game_info['app_id']; ?>"
		data-os="PC" >
	<?php
		
		switch($game_info['template']){
		
		case 'Template 1':
			include( locate_template( 'inc/single_videoheader_1.php', false, false ) );
			break;
		case 'Template 2':
			include( locate_template( 'inc/single_videoheader_2.php', false, false ) );
			break;
		default:
		
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
								<span class="btn_text">PLAY NOW</span>
						</button>
				</div>
				
			</section>
		<?php } ?>
			
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
					<div class="symantec_seal">
					<table width="100" border="0" cellpadding="2" cellspacing="0" 
                        title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
                        <tr><td width="100" align="center" valign="top">
                        <script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=games.lol&amp;size=S&amp;use_flash=NO&amp;use_transparent=Yes&amp;lang=en"></script>
                        </td></tr></table>
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
						<span class="btn_text">PLAY NOW</span></button>
			</div>
		<?php } ?>
		<h1 id="page_title" class="container">
				<?php if($game_info['customh1'] <> '' ) { ?>
						<span class="notranslate"><?php echo $game_info['customh1']; ?></span>
					<?php } else { ?>
						Download <span class="notranslate"><?php the_title(); ?></span> on PC
					<?php } ?>
		</h1>
		<?php if($game_info['video'] <> "" && !has_shortcode( $post->post_content, 'gameslol_slider') ){ ?>
		<section id="gamevideo" class="container-fluid">
			
			<div class="sectioncontent container <?php echo $game_info['flipped']; ?>">
				<iframe width="853" height="505"
                	src="https://www.youtube.com/embed/<?php echo $game_info['video_id']; ?>?autoplay=0">
                </iframe>
			</div>
		</section>
		<?php } ?>
		
		<section id="gamecontent" class="container-fluid <?php echo $game_info['flipped']; ?>">
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