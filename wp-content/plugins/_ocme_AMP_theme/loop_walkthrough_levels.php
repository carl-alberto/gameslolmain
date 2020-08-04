<div class="grid grid_levels">
	<?php
		for( $level = 1 ; $level <= $levelcount ; $level++){ 
		$is_available = ($walkthroughs[$level]) ? true : false;
	?>

		<a class="item level-<?php echo $level; ?> <?php if($is_available){ echo 'active'; } ?>"
			<?php if($is_available){ ?>
				href="<?php echo get_the_permalink($walkthroughs[$level])."amp"; ?>"
			<?php } ?>
		>
				<span class="leveltext">Level</span>
				<span class="levelnum"><?php echo $level; ?></span>
			<?php if($is_available){ ?></a><?php } ?>


	<?php } ?>
</div>