<div class="divi">
<div class="item post-<?php the_ID(); ?> container">
	<div class="container-fluid row">
		<div class="preview col-sm-5 col-md-4">

			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php
			 		$thumbnail = $relatedgame['thumbnail'];
			?>
			<img class="featured_image <?php echo $relatedgame['flipped']; ?>" src="<?php echo $thumbnail; ?>" title="<?php the_title();?> Featured Image" >
			</a>
		</div>
		<div class="info col">
			<h2 class="title"><a class="readmore" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			<a class="readmore btn btn-sm btn-dark" href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</div>
</div>
</div>