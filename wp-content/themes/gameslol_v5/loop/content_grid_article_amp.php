<?php 
	$ampurl = get_the_permalink().'amp'; ?>
<div class="item">
	<a class="preview" href="<?php echo $ampurl; ?>">
		<amp-img src="<?php echo get_the_post_thumbnail_url(); ?>"
			alt="<?php the_title(); ?> Featured Image"
			width="350" height="150" layout="responsive">
			<noscript><img
			src="<?php echo get_the_post_thumbnail_url(); ?>"
			alt="<?php the_title(); ?> Featured Image"></noscript></amp-img>
	</a>
	<div class="details">
		<?php amp_loop_title(); ?>
		<?php amp_loop_excerpt(); ?>
	</div>
</div>