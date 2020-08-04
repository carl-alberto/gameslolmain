<?php amp_header(); ?>
<?php

add_gameviews(get_the_ID());
$game_info = get_the_game_info(get_the_id());

?>
	<?php 
	if($game_info['banner'] <> "" ){ ?>
	<div id="gamebanner">
		<div class="bannerbg">
			<div class="bannerimg">
			<amp-img class="cover" src="<?php echo $game_info['banner']; ?>"
						alt="<?php echo $game_info['banner_alt']; ?>"
						layout="fill">
						<noscript><img
						src="<?php echo $game_info['banner']; ?>"
						alt="<?php echo $game_info['banner_alt']; ?>"></noscript></amp-img>
			</div>
		</div>
		<div class="banneroverlay">
			<?php if($game_info['floatingbutton'] <> "" ){ ?>
			<div class="gameimg">
				<amp-img class="contain" src="<?php echo $game_info['floatingbutton']; ?>"
							alt="<?php echo $game_info['floatingbutton_alt']; ?>"
							layout="fill">
							<noscript><img
							src="<?php echo $game_info['floatingbutton']; ?>"
							alt="<?php echo $game_info['floatingbutton_alt']; ?>"></noscript></amp-img>
			</div>
			<?php } ?>
			<a class="downloadbtn" href="<?php echo $game_info['link_apk']; ?>">
				<span class="notranslate">Play <?php the_title(); ?></span></a>
		</div>
	</div>
	<?php } ?>
	
	<div id="gamepageheader">
		<div class="container">
		<div class="icon">
			<amp-img src="<?php echo $game_info['icon']; ?>"
			alt="<?php echo $game_info['icon_alt']; ?>"
			width="100" height="100" layout="responsive">
			<noscript><img
			src="<?php echo $game_info['icon']; ?>"
			alt="<?php echo $game_info['icon_alt']; ?>"></noscript></amp-img>
		</div>
		<div class="title">
			<h2><?php the_title(); ?></h2>
			<?php echo $game_info['developer']; ?>
			
			</div>
			<?php
				if( is_singular( array( 'unblockedgame', 'post') ) ){ ?>
					<p class="meta categories"><?php the_category(' '); ?></p>
				<?php }
				elseif( is_singular('unblockedapp') ){ ?>
					<p class="meta categories"><?php the_terms( get_the_ID(), 'app_category'); ?></p>
				<?php } ?>
		</div>
		</div>
	</div>
	<div id="pagecontent" class="container">
		<h1>
		<?php if($game_info['customh1'] <> '' ) { ?>
			<?php echo $game_info['customh1']; ?>
		<?php } else { ?>
			Download <span class="notranslate"><?php the_title(); ?></span>
		<?php } ?>
		</h1>
		<?php if($game_info['video_id']<>'') { ?>
		<div class="gamevideo">
			<amp-youtube
				data-videoid="<?php echo $game_info['video_id']; ?>"
				layout="responsive"
				width="853" height="505"></amp-youtube>
		</div>
		<?php } ?>
		<div class="content">
			<?php amp_content(); ?>
		
		</div>	<br/>
		<p align="center">
			<a class="downloadbtn" href="<?php echo $game_info['link_apk']; ?>">
				<span class="notranslate">Play <?php the_title(); ?></span></a>
			</p>
	</div>
	<div id="gamereviews" class="container">
		<h2 class="widget_title">Ratings and Reviews</h2>
		<p align="center">
		<a class="reviewbtn" href="<?php the_permalink();?>#gamereviews">View All Reviews</a>
		<a class="reviewbtn yellow" href="<?php the_permalink();?>#gamereviews">Submit a Review</a>
		</p>
	</div>
	<div id="relatedgames" class="container">
		<h2 class="widget_title">Recommended Games for you</h2>
		<div class="grid grid_game">
			<?php
				$not_id = array(get_the_ID());
				$args = array(
				    'post__not_in'   => $not_id,
					'post_status'	 => 'publish',
					'orderby'        => 'rand',
					'posts_per_page' => 5
				);
			
				if( is_singular('unblockedgame') ){
					$args['post_type'] = "unblockedgame";
				}
				elseif( is_singular('unblockedapp') ){
					$args['post_type'] = "unblockedapp";
				}
			
				$the_query = new WP_Query( $args ); 
				if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php include('loop_grid_game.php'); ?>

				<?php endwhile;
			endif;	?>
		</div>
	</div>
	
	<div id="relatedarticles" class="container">
		<h2 class="widget_title">Related Articles</h2>
		<div class="grid grid_article">
			<?php
			
			$args = array(
					'post_type'			=> 'article',
					'post_status'		=> 'publish',
					'orderby'        => 'rand',
					'posts_per_page' => 2
				);
				$the_query = new WP_Query( $args ); 
				if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php include('loop_grid_article.php'); ?>

				<?php endwhile;
			endif;	?>
		</div>
	</div>

<?php amp_footer()?>