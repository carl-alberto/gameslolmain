<div class="item post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	<div class="preview">
		<?php
		$thumbnail = get_the_post_thumbnail_url();
		if($thumbnail == "" ){
			$thumbnail = get_template_directory_uri().'/images/sample_img.png';
		}
		$html = '<img class="featured_image" src="'.$thumbnail.'" 
				title="'.get_the_title(get_the_ID()).' Featured Image" />';

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