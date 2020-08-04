<div class="item post-<?php the_ID(); ?>">
	<div class="item-content">
		<div class="rank"><?php echo $x; ?></div>
		<div class="preview">
			<?php
				$game_info = get_the_game_info(get_the_id());
				$thumbnail = $game_info['icon_sm'];
				if($thumbnail == "" ){
					$thumbnail = $game_info['icon'];
				}
				if($thumbnail == "" ){
					$thumbnail = get_template_directory_uri().'/images/sample_img.png';
				}
			
				$html = '
				<img class="game_icon '.$game_info['flipped'].'" src="'.$thumbnail.'" 
					alt = "'.$game_info['icon_alt'].'"
					title="'.$game_info['icon_alt'].'"
					width="60" height="60" />';

				$html = apply_filters( 'a3_lazy_load_images', $html, null );
				echo $html;
				?>
			
		</div>
		<div class="cta">
			<span class="title"><span class="notranslate"><?php the_title(); ?></span></span>
			<?php //gameslol_svg( 'arrow-down' , '50px', '35px' , '#FFF' ); ?>
		</div>
	</div>
	<a class="item-link" href="<?php the_permalink(); ?>" title="Download and Play <?php the_title(); ?> on PC"></a>
</div>