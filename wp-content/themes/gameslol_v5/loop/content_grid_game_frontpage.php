<div class="item post-<?php the_ID(); ?>">
	<div class="preview">
		<a href="<?php the_permalink(); ?>" title="Download and Play <?php the_title(); ?> on PC">
		<?php
		$game_info = get_the_game_info(get_the_id());
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
		</a>
	</div>
	<div class="info">
		<a href="<?php the_permalink(); ?>" title="Download and Play <?php the_title(); ?> on PC">
		<span class="title notranslate"><?php the_title(); ?></span>
		</a>
	</div>
	<?php if( check_quickdownload( $force_quickdownload ) && get_query_var("amp") <> 1){ 
			if( is_category() ){
				$ga_action = "Category-Download";
			} else {
				$ga_action = "Tag-Download";
			}
		?>
				<div class="cta text-center">
                      <button class="goQuickDownload downloadbtn"
                              data-ga-category="Game" data-ga-action="<?php echo $ga_action; ?>"
                              data-ga-title="<?php echo get_the_title(); ?>"
                              data-game-id="<?php echo get_the_ID(); ?>"
                              data-game-dl-win="<?php echo $game_info['link']; ?>"
                              data-game-dl-apk="<?php echo $game_info['link_apk']; ?>"
                              data-game-dl-mac="<?php echo $game_info['link_mac']; ?>"
      						  data-packagename="<?php echo $game_info['app_id']; ?>">
                          <span class="btn_text">PLAY NOW</span>
                          <span class="btn_icon" style="display: none;"><?php echo $game_info['icon']; ?></span>
                          <span class="btn_logo" style="display: none;"><?php echo $game_info['floatingbutton']; ?></span>
                      	  <span class="btn_flipped" style="display: none;"><?php echo $game_info['flipped']; ?></span>
                      </button>
				</div>
		<?php } ?>
	<?php
			if ($game_info['rating'] > 0 ){
					?>
					<div class="rating">
						Rating: <?php echo $game_info['rating']; ?>
					</div>
			<?php
			}
	?>
	<?php if($game_info['is_new']){
		?><div class="tag new">NEW</div>
	<?php } ?>
	
	
</div>