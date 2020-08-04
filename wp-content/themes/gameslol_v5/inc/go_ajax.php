<?php

add_action( 'wp_ajax_nopriv_download_go', 'download_go' );
add_action( 'wp_ajax_download_go', 'download_go' );

function download_go(){
	
	$post_id = ( isset($_GET['thepost']) ) ? $_GET['thepost'] : 0;
	if($post_id > 0) {
		download_count($post_id);
	}
	
	die();
}

function download_count($post_id){
	$game_downloads = get_post_meta($post_id, 'game_downloads', true);
		if($game_downloads == "") {
			$game_downloads = 0;
		}
		update_post_meta( $post_id, 'game_downloads', $game_downloads + 1 );
}

add_action( 'wp_ajax_nopriv_quickdownload_checkgamedata', 'quickdownload_checkgamedata' );
add_action( 'wp_ajax_quickdownload_checkgamedata', 'quickdownload_checkgamedata' );

function quickdownload_checkgamedata(){

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		
		$os = $_GET['os'];
		$game_info = get_the_game_info($_GET['gameid']);

		$downloadlink = "";
		
		switch($os){
			case 'Android': //for Mobile
			 $downloadlink = $game_info['link_apk'];
			 break;
		  case 'Mac':	//for Mac
			 $downloadlink = $game_info['link_mac'];
			 break;
		  case 'PC':	//for Windows
			 $downloadlink = $game_info['link'];
			 break;
		  default:
			 $downloadlink = $game_info['link'];
		}

		if($downloadlink <> ""){			
			$return['is_available'] = true;
			$return['downloadlink'] = $downloadlink;
		} else {		
			$return['is_available'] = false;
		}
		
		echo json_encode($return);
		die();
	}
		exit();
}

add_action( 'wp_ajax_nopriv_quickdownload_go', 'quickdownload_go' );
add_action( 'wp_ajax_quickdownload_go', 'quickdownload_go' );

function quickdownload_go(){

	$post_id = ( isset($_GET['gameid']) ) ? $_GET['gameid'] : 0;
	if($post_id > 0) {
		
		// add to download count
		download_count($post_id);
		
		// return game data
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 

			$os = $_GET['os'];
			$game_info = get_the_game_info($post_id);

			$return['icon'] = $game_info['icon'];
			$return['logo'] = $game_info['floatingbutton'];

			$downloadlink = "";
			switch($os){
				case 'Android': //for Mobile
				 $downloadlink = $game_info['link_apk'];
				 break;
			  case 'Mac':	//for Mac
				 $downloadlink = $game_info['link_mac'];
				 break;
			  case 'PC':	//for Windows
				 $downloadlink = $game_info['link'];
				 break;
			  default:
				 $downloadlink = $game_info['link'];
			}

			$return['downloadlink'] = $downloadlink;

			echo json_encode($return);
			die();
		}
		
		exit();
		
	}
}

add_action( 'wp_ajax_nopriv_load_next_posts', 'load_next_posts' );
add_action( 'wp_ajax_load_next_posts', 'load_next_posts' );

function load_next_posts( ){
				
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		$pt = ( isset($_GET['pt']) ) ? $_GET['pt'] : 0;
		if($pt == 'game'){
			include( locate_template( 'loop/inf_grid_game.php', false, false ) );
		} elseif($pt == 'app'){
			include( locate_template( 'loop/inf_grid_app.php', false, false ) );
		}
		die();
	}
	
	exit();
}

?>