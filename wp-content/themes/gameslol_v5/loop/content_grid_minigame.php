<div class="item post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" title="Play <?php the_title(); ?> for Free">
	<div class="preview">
		<?php
		$game_info = get_the_minigame_info(get_the_id());
		$thumbnail = $game_info['thumbnail'];
		if($thumbnail == "" ){
			$thumbnail = get_template_directory_uri().'/images/sample_img.png';
		}
		
		$html = '
		<img class="featured_image" src="'.$thumbnail.'" 
			alt = "'.$game_info['thumbnail_alt'].'"
			title="'.$game_info['thumbnail_alt'].'" />';
		
		$html = apply_filters( 'a3_lazy_load_images', $html, null );
		echo $html;
		?>
		
	</div>
	<div class="info">
		<span class="title notranslate"><?php the_title(); ?></span>
		<?php the_excerpt(); ?>
		<span class="readmore">Read More...</span>
		
	</div>
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
	</a>
</div>