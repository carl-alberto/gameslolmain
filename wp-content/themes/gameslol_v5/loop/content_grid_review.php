<div class="item post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" title="<?php echo $game_info['review_title']; ?>">
	<div class="preview">
		<?php
		$info = get_the_review_info(get_the_id());
		$game_info = get_the_game_info($info['gameID']);
		$thumbnail = $game_info['thumbnail'];
		if($thumbnail == "" ){
			$thumbnail = get_template_directory_uri().'/images/sample_img.png';
		}
		
		$html = '
		<img class="featured_image '.$game_info['flipped'].'" src="'.$thumbnail.'" 
			alt = "'.$game_info['thumbnail_alt'].'"
			title="'.$game_info['thumbnail_alt'].'" />';
		
		$html = apply_filters( 'a3_lazy_load_images', $html, null );
		echo $html;
		?>
	</div>
	<div class="info">
		<span class="title"><?php the_title(); ?></span>
		<?php the_excerpt(); ?>
		<span class="readmore">Read More...</span>
	</div>
	</a>
</div>