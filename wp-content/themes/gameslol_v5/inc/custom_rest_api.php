<?php

/** CUSTOM REST API FUNCTIONS **/

/**
 * Grab post download data via slug & OS
 *
 * @param array $data Options for the function.
 * @return rest_response|error REST Response if found,
 * or error in not found/invalid.
 */
function customrest_getpostdata( $data ) {
	
  $posts = get_posts( array(
	'post_status'	 => 'publish',
	'post_type'		 => 'post',
	'name'			 => $data['slug']
  ) );

  $OS = strtolower($data['os']);
 
  if ( empty( $posts ) ) {
	  
	$error['stat'] =  404;
	$error['message'] = "Game '".$data['slug']."' not found!";
    return new WP_REST_Response( $error, 404 );
	  
  } else {
	  
	  global $post;
	  $post = $posts[0];
	  $game_info = get_the_game_info($post->ID);
	  
	  $post_info = array(
		'stat'			=> 200,
		'message'		=> 'Post found successfully.',
	  	'id' 			=> $post->ID,
		'title' 		=> $post->post_title,
		'url'			=> get_the_permalink($post->ID),
		'icon' 			=> $game_info['icon'],
		'developer' 	=> $game_info['developer'],
		'rating' 		=> $game_info['rating'],
		'downloads' 	=> $game_info['downloads'],
		'flipped'		=> $game_info['flipped']
	  );
	  
	  if($OS <> '') {
		  
		  $post_info['os'] = $OS;
		  
		  switch($OS){
			  case 'mac':
				  $post_info['download_url'] = $game_info['link_mac'];
				  break;
			  case 'apk':
				  $post_info['download_url'] = $game_info['link_apk'];
				  break;
			  case 'pc':
				  $post_info['download_url'] = $game_info['link'];
				  break;
			  default:
				$error['stat'] =  422;
				$error['message'] = "Invalid OS!";
				return new WP_REST_Response( $error, 422 );
		  }
	  }
	
	  return new WP_REST_Response( $post_info, 200 );
  }
}

function ocmegames_custom_rest_api(){
	
	register_rest_route( 
		'widget/v1', 
		'(?P<slug>[a-zA-Z0-9-]+)', 
		array(
			'methods' => 'GET',
			'callback' => 'customrest_getpostdata',
		  )
	);
	
	register_rest_route( 
		'widget/v1', 
		'(?P<slug>[a-zA-Z0-9-]+)/(?P<os>[a-zA-Z0-9-]+)', 
		array(
			'methods' => 'GET',
			'callback' => 'customrest_getpostdata',
		  )
	);
	
}

add_action( 'rest_api_init', 'ocmegames_custom_rest_api' );

?>