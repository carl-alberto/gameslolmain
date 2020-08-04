<?php $game_info = get_the_game_info(get_the_ID());
	$ampurl = get_the_permalink().'amp'; ?>
	
	<div class="item post-<?php the_ID(); ?>">
	<div class="item-content">
		<div class="rank"><?php echo $x; ?></div>
		<div class="preview">
			<?php
				$thumbnail = $game_info['icon_sm'];
				if($thumbnail == "" ){
					$thumbnail = $game_info['icon'];
				}
				if($thumbnail == "" ){
					$thumbnail = get_template_directory_uri().'/images/sample_img.png';
				}
				?>
				<amp-img src="<?php echo $thumbnail; ?>"
					alt="<?php echo $game_info['icon_alt']; ?>"
					layout="responsive" width="60" height="60">
					<noscript><img 
					src="<?php echo $thumbnail; ?>"
					alt="<?php echo $game_info['icon_alt']; ?>"></noscript></amp-img>

		</div>
		<div class="cta">
			<span class="title"><span class="notranslate"><?php the_title(); ?></span></span>
		</div>
	</div>
	<a class="item-link" href="<?php echo $ampurl; ?>" title="Download and Play <?php the_title(); ?> on PC"></a>
</div>