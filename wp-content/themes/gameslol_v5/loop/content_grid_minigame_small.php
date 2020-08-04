<?php 
		$game_info = get_the_minigame_info(get_the_id());
?>
<div class="item post-<?php the_ID(); ?>">
	<?php if($force_quickdownload){ ?>
	<a class="goQuickPlay" title="Play <?php the_title(); ?> for Free"
		data-ga-category="Mini Game" data-ga-action="<?php echo $ga_action; ?>"
		data-ga-title="<?php echo get_the_title(); ?>"
		data-game-id="<?php echo get_the_ID(); ?>"
		data-playerlink="<?php echo $game_info['player']; ?>">
	<?php } else { ?>
	<a href="<?php the_permalink(); ?>" title="Play <?php the_title(); ?> for Free">
	<?php } ?>
	<div class="preview">
		<?php
		$thumbnail = $game_info['icon'];
		if($thumbnail == "" ){
			$thumbnail = get_template_directory_uri().'/images/sample_img.png';
		}
		
		$html = '
		<img class="featured_image" src="'.$thumbnail.'" 
			alt = "'.$game_info['icon_alt'].'"
			title="'.$game_info['icon_alt'].'" />';
		
		$html = apply_filters( 'a3_lazy_load_images', $html, null );
		echo $html;
		?>
		
	</div>
	<div class="info" align="center">
		<span class="title notranslate"><?php the_title(); ?></span>
	</div>
	<?php if(!$force_quickdownload){ ?>
		</a>
	<?php } ?>
	<?php if( check_quickdownload( $force_quickdownload ) ){ 
	
			$ga_action = "Grid-Play";
	
	?>
			<div class="cta text-center">
				<button class=" downloadbtn active">
					<span class="btn_text">PLAY NOW</span>
				</button>
			</div>
	<?php } ?>
	<?php
			if ($game_info['rating'] > 0 ){
					?>
					<div class="rating">
						Rating: <?php echo $game_info['rating']; ?>
					</div>
			<?php
			}
	?>
	<?php if($game_info['is_new']){
		?><div class="tag new">NEW</div>
	
	<?php } ?>
		
	<?php if($force_quickdownload){ ?>
		</a>
	<?php } ?>
</div>