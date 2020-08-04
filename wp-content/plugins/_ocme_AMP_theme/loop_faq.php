<?php 
	$ampurl = get_the_permalink().'amp'; ?>
<div class="item">
	<a class="preview" href="<?php echo $ampurl; ?>">
		<?php $thumbnail = $relatedgame['thumbnail']; ?>
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