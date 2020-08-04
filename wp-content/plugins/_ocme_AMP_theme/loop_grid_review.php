<?php 
	$ampurl = get_the_permalink().'amp';
	$info = get_the_review_info(get_the_id());
	$thumbnail = get_the_post_thumbnail_url();
	if($thumbnail == ""){
		$game_info = get_the_game_info($info['gameID']);
		$thumbnail = $game_info['thumbnail'];
	}
	if($thumbnail == "" ){
		$thumbnail = get_template_directory_uri().'/images/sample_img.png';
	}
?>
<div class="item">
	<a class="preview" href="<?php echo $ampurl; ?>">
		<amp-img src="<?php echo $thumbnail; ?>"
			alt="<?php the_title(); ?> Featured Image"
			width="350" height="150" layout="responsive">
			<noscript><img
			src="<?php echo $thumbnail; ?>"
			alt="<?php the_title(); ?> Featured Image"></noscript></amp-img>
	</a>
	<div class="details">
		<?php amp_loop_title(); ?>
		<?php amp_loop_excerpt(); ?>
	</div>
</div>