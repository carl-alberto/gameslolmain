<?php amp_header(); ?>
<?php

add_gameviews(get_the_ID());

$walkthrough_info = get_the_walkthrough_info(get_the_id());
$game = get_post($walkthrough_info['relatedgame']);
$relatedgame = get_the_game_info($game->ID);

?>
	<?php 
	if($relatedgame['banner'] <> "" ){ ?>
	<div id="gamebanner">
		<div class="bannerbg">
			<div class="bannerimg">
			<amp-img class="cover" src="<?php echo $relatedgame['banner']; ?>"
						alt="<?php echo $relatedgame['banner_alt']; ?>"
						layout="fill">
						<noscript><img
						src="<?php echo $relatedgame['banner']; ?>"
						alt="<?php echo $relatedgame['banner_alt']; ?>"></noscript></amp-img>
			</div>
		</div>
		<div class="banneroverlay">
			<?php if($relatedgame['floatingbutton'] <> "" ){ ?>
			<div class="gameimg">
				<amp-img class="contain" src="<?php echo $relatedgame['floatingbutton']; ?>"
							alt="<?php echo $relatedgame['floatingbutton_alt']; ?>"
							layout="fill">
							<noscript><img
							src="<?php echo $relatedgame['floatingbutton']; ?>"
							alt="<?php echo $relatedgame['floatingbutton_alt']; ?>"></noscript></amp-img>
			</div>
			<?php } ?>
			<a class="downloadbtn" href="<?php echo $relatedgame['link_apk']; ?>">
				<span class="notranslate">Play <?php echo get_the_title($game->ID); ?></span></a>
		</div>
	</div>
	<?php } ?>
	
	<div id="gamepageheader">
		<div class="container">
		<div class="icon">
			<amp-img src="<?php echo $relatedgame['icon']; ?>"
			alt="<?php echo $relatedgame['icon_alt']; ?>"
			width="100" height="100" layout="responsive">
			<noscript><img
			src="<?php echo $relatedgame['icon']; ?>"
			alt="<?php echo $relatedgame['icon_alt']; ?>"></noscript></amp-img>
		</div>
		<div class="title">
			<h2><?php the_title(); ?></h2>
			<?php echo $relatedgame['developer']; ?>
			<p class="meta categories"><?php the_category(' ', multiple, $game->ID); ?></p>
		</div>
		</div>
	</div>
	<div id="pagecontent" class="container">
		
		<h1>
			<span class="notranslate"><?php the_title(); ?></span>
		</h1>
		<div class="content">
			<?php amp_content(); ?>
		
		</div>	
	
	</div>

	<div id="walkthroughlevels" class="container">

	<?php  if( !wp_get_post_parent_id( get_the_ID() ) ) {  ?>
		<?php 
			$levelcount = $walkthrough_info['level'];
			$walkthroughs = get_the_walkthrough_levels($game->ID);
			include( 'loop_walkthrough_levels.php' );
		?>

	<?php } else { ?>
		
		<h2 class="widget_title">View walkthroughs of other levels</h2>
		<?php 
			$parent_id = wp_get_post_parent_id(get_the_id());
			$parent_info = get_the_walkthrough_info($parent_id);
			$levelcount = $parent_info['level'];
			$walkthroughs = get_the_walkthrough_levels($game->ID);
			include( 'loop_walkthrough_levels.php' );
		?>
	<?php } ?>


	</div>

<?php amp_footer(); ?>