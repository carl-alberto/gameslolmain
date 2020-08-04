<?php $game_info = get_the_minigame_info(get_the_ID());
	 $ampurl = get_the_permalink(get_the_ID())."amp";
?>
<div class="item">
	<a class="preview" href="<?php echo $ampurl; ?>">
		<amp-img src="<?php echo $game_info['thumbnail']; ?>"
			alt="<?php echo $game_info['thumbnail_alt']; ?>"
			width="350" height="150" layout="responsive">
			<noscript><img
			src="<?php echo $game_info['thumbnail']; ?>"
			alt="<?php echo $game_info['thumbnail_alt']; ?>"></noscript></amp-img>
	</a>
	<div class="details">
		<?php amp_loop_title(); ?>
		<?php amp_loop_excerpt(); ?>
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
</div>