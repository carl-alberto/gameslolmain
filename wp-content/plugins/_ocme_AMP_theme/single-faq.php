<?php amp_header(); ?>
<?php

add_gameviews(get_the_ID());

$faq_info = get_the_faq_info(get_the_id());
$game = get_post($faq_info['relatedgame']);
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
			<h2><?php echo get_the_title($game->ID); ?></h2>
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
		

	<?php 
		if( !wp_get_post_parent_id( get_the_ID() ) ) { ?>

		<div id="faq" class="container">
		<?php
		$posts_per_page = -1;
		$current_page = ( get_query_var( 'faqpaged' ) ) ? get_query_var( 'faqpaged' ) : 1;
		$query = new WP_Query( array(
				'post_type' => 'faq',
				'post_parent' => get_the_ID(),
				'posts_per_page' => $posts_per_page,
				'paged' => $current_page
		) );

		if ( $query->have_posts() ) : ?>
			<div class="loop_faq">
			<?php		
			while ( $query->have_posts() ) : $query->the_post(); 
						include( 'loop_faq.php' );
			endwhile; ?>
			</div>
		<?php endif; ?>
			
		</div>
		<?php } else {
			?>
			<p align="center">
			<a href="<?php echo get_the_permalink(wp_get_post_parent_id( get_the_ID() )) . 'amp'; ?>" class="reviewbtn yellow">Back to <b><?php echo get_the_title($game->ID); ?></b> FAQ</a>
			</p>

			<?php 
		} ?>
		
		</div>	
	
	</div>

<?php amp_footer(); ?>