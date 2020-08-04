
	<?php 
		$game_info = get_the_game_info(get_the_id());
		$is_available = ( get_the_walkthrough_page( get_the_ID() )  
						 && get_the_walkthrough_count(get_the_ID()) > 0 ) ? true : false;
		$permalink = get_the_permalink( get_the_walkthrough_page( get_the_ID() ) );
		
if($is_available){ ?>





<div class="item post-<?php the_ID(); ?>">
	

	<div class="preview">
		<?php if($is_available){ ?>
		<a href="<?php echo $permalink; ?>" title="Download and Play <?php the_title(); ?> on PC"> <?php } ?>
		<?php
		$thumbnail = $game_info['icon'];
		if($thumbnail == "" ){
			$thumbnail = get_template_directory_uri().'/images/sample_img.png';
		}
		
		$html = '
		<img class="game_icon '.$game_info['flipped'].'" src="'.$thumbnail.'" 
			alt = "'.$game_info['icon_alt'].'"
			title="'.$game_info['icon_alt'].'" />';
		
		$html = apply_filters( 'a3_lazy_load_images', $html, null );
		echo $html;
		?>
		<?php if($is_available){ ?></a><?php } ?>
		<?php
		if(!$is_available){ ?>
			<div class="overlay">
				COMING SOON
			</div>
		<?php }
		?>
	</div>
	<div class="info" align="center">
		<a <?php if($is_available) { ?> href="<?php echo $permalink; ?>" title="Download and Play <?php the_title(); ?> on PC" <?php } ?>>
			<span class="title notranslate"><?php the_title(); ?></span>
		</a>
	</div>
</div>

<?php }
		?>