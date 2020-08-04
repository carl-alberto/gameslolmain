<?php $game_info = get_the_game_info(get_the_id()); ?>
<li class="item post-<?php the_ID(); ?>">
	<div class="post_content"
			data-gametitle="<?php the_title();?>"
			data-postID="<?php the_ID();?>"
			data-downloadlink="<?php echo $game_info['link']; ?>"
			data-downloadlink-mobile="<?php echo $game_info['link_apk']; ?>"
			data-downloadlink-mac="<?php echo $game_info['link_mac']; ?>" >
		<div class="preview">
			<?php
			$thumbnail = $game_info['icon'];
			if($thumbnail == "" ){
				$thumbnail = get_template_directory_uri().'/images/sample_img.png';
			}
			?>
			<img class="game_icon" src="<?php echo $thumbnail; ?>" 
				alt = "<?php echo $game_info['icon_alt']; ?>"
				title="<?php echo $game_info['icon_alt']; ?>" />
		</div>
		<?php 
			$ga_action = "Icon-Click";
			if( is_category() ){
				$ga_action = "Category-Icon-Click";
			} elseif( is_tag() ) {
				$ga_action = "Tag-Icon-Click";
			}
		?>
		<div class="overlay goQuickDownload"
				data-ga-category="Game" data-ga-action="<?php echo $ga_action; ?>"
				data-ga-title="<?php echo get_the_title(); ?>"
				data-game-id="<?php echo get_the_ID(); ?>">
			<span class="btn_text">COMING SOON</span></div>
	</div>
</li>