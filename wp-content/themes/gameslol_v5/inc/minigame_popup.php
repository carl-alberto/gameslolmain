	<div class="modal fade" id="game_player" tabindex="-1" role="dialog" aria-labelledby="gamePlayer" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
			  <a href="<?php echo site_url(); ?>">
			  <img class="modal-logo" alt="<?php echo bloginfo('name'); ?> free game download website logo" title="<?php echo bloginfo('name'); ?> free game download website logo" src="<?php echo get_theme_mod( 'setting_logo'); ?>" />
			  </a>
				<h5 class="modal-title">Now Playing &raquo; <strong><span class="minigame-title"><?php the_title(); ?></span></strong></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  	x
				</button>
			  </div>
				<div class="modal-body">
					<?php if( is_singular('minigame') ){
						$player_link = $game_info['player'];
						} ?>
					<iframe class="game_player_window" frameborder="0" src="<?php echo $player_link; ?>">
					</iframe>
				</div>
			</div>
		  </div>
	</div>