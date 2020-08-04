<?php
//[popular posts]
function ocmegames_shortcode_gameslol_grid( $atts ){
	$a = shortcode_atts( array(
						'type' => 'game',
						'count' => 6,
						'offset' => 0,
						'infinite' => 'false',
						'quickdownload' => 'false',
						'posts' => '',
						'random' => 'false' 
			), $atts );
	
	
	$posts_to_show = ($a[ 'count' ] == 'all') ? -1 : (int) $a[ 'count' ];
	$offset = (int) $a[ 'offset' ];
	$infinite = ($a[ 'infinite' ] == 'true') ? true : false;
	$force_quickdownload = ($a[ 'quickdownload' ] == 'true') ? true : false;
	$post_type = ( $a['type'] == 'game' ) ? 'post' : $a['type'];
	$random = ($a[ 'random' ] == 'true') ? true : false;
		
	if( $infinite == "true" && $a['posts'] == "" && $post_type == "post" ){
			
		ob_start();
		
		if( $a['type'] == 'post' | $a['type'] == 'game' ){
		?>
		<div class="gameslol_grid grid grid_game container">
			<?php

				include( locate_template( 'loop/inf_grid_game.php', false, false ) );
		
			?>
		</div>
		<?php 
		} else {
			echo 'infinite scrolling is only available for games';
		}
		return ob_get_clean();
		 
		
	} else {

			$args = array(
						'orderby'		 => 'postdate',
						'post_type'		 => $post_type,
						'order'			 => 'DESC',
						'post_status'	 => 'publish'
					);
				
			if( $a['posts'] <> '' ){
				$posts_array = explode( ',' , $a['posts'] );
				$args['post__in'] = $posts_array;
				$args['posts_per_page'] = -1;
			} else {
				$args['posts_per_page'] = $posts_to_show;
				$args['offset'] = $offset;
			}
		
			if( $random ){
				$args['orderby'] = 'rand';
			}
		
			global $post;
			$posts = get_posts($args);
			ob_start();
			
			if(is_front_page() && get_query_var("amp") <> 1){ ?>
				<div class="gameslol_grid grid grid_game grid_frontpage container-fluid">
			<?php } elseif( get_query_var("amp") == 1 ) { ?>
				<div class="grid grid_game">
			<?php } else { ?>
				<div class="gameslol_grid grid grid_game container">
			<?php } ?>
				<?php
				foreach ( $posts as $post ){
					setup_postdata( $post );
					if($post_type == 'post'){
						if(is_front_page() && get_query_var("amp") <> 1){
							include( locate_template( 'loop/content_grid_game_frontpage.php', false, false ) );
						} elseif( get_query_var("amp") == 1 ) { 
							include( locate_template( 'loop/content_grid_game_amp.php', false, false ) );
						} else { 
							include( locate_template( 'loop/content_grid_game.php', false, false ) );
						}
					} elseif ($post_type == 'minigame'){
						include( locate_template( 'loop/content_grid_minigame_small.php', false, false ) );
					}
				}
				wp_reset_postdata();
				?>

			</div>
			<?php 
			return ob_get_clean();

	}
			
}

function ocmegames_shortcode_gameslol_slider( $atts ){
	$a = shortcode_atts( array(
						'id' => '',
						'columns' => 2,
			), $atts );
	
	
	$post_id = (int) $a[ 'id' ];
	$columnTotal = (int) $a[ 'columns' ];

	if($post_id == null | $post_id == 0){
		global $post;
		$post_id = get_the_ID();
	}			
		ob_start();
		if(get_post($post_id)){
			
			$gameinfo = get_the_game_info($post_id);
			$video_url = $gameinfo['video'];
			$video_id = $gameinfo['video_id'];
			if ($gameinfo['screenshot'][0] != "" || $gameinfo['screenshot'][1] != "" || $gameinfo['screenshot'][2] != "" || $gameinfo['screenshot'][3] != "") {
              if ($gameinfo['flipped']=="flipped") {
              ?>
              <style>
                  .ekko-lightbox img {
                      -webkit-transform: scaleX(-1);
                      transform: scaleX(-1);
                  }
              </style>
              <?php
              }
		?>

		<div class="shortcode_gameslol_slider row container-fluid">
			<div class="box gamepreviews container-fluid">
			  <div class="screenshots">
				<div class="slick-carousel">
		    
				<?php
		    	if ($video_url != null && $video_url != "") {
		    	?>
		    	<div class="item video">
			    	<div class="video-wrapper">
						<iframe class="yt-player a3-notlazy" src="https://www.youtube.com/embed/<?php echo $video_id ?>?controls=1&rel=0"></iframe>
					</div>
		    	</div>
		    	<?php
		    	}
		    	?>
				<?php
					$withUploaded = 0;
					foreach ($gameinfo['screenshot'] as $screenshot) {
						if ($screenshot != null && $screenshot != "") {
							$withUploaded++;
					?>
					    <div class="item">
					    	<a href="<?php echo $screenshot ?>" data-toggle="lightbox" >
							  <img src="<?php echo $screenshot ?>" class="img-fluid a3-notlazy">
							</a>
					    </div>
					<?php
						}
					}
				?>
				</div>
				<div class="prevArrow"><?php gameslol_svg( 'chev-left' , '20px' , '20px' , 'darkgray' ); ?></div>
				<div class="nextArrow"><?php gameslol_svg( 'chev-right' , '20px' , '20px' , 'darkgray' ); ?></div>
			  </div>
			</div>
		</div>
		<?php
			}
		}else{
			echo  "<div class='alert alert-danger'>Screenshot Slider: Post does not exist!</div>";
		}

		return ob_get_clean();

	
			
}

add_shortcode( 'gameslol_grid', 'ocmegames_shortcode_gameslol_grid' );
add_shortcode( 'gameslol_slider', 'ocmegames_shortcode_gameslol_slider' );

?>