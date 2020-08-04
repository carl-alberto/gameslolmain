<?php

/*******************************************************/
/****** REWRITE RULES FOR REVIEWS AND AMP PAGES ********/
/*******************************************************/

/* ADD URL REWRITE RULES */
function ocmegames_rewrite_rules(){
	
	// Misc Custom Rewrite Tags
	add_rewrite_tag( '%relatedgame%', '(.*)' );
	add_rewrite_tag( '%pagetype%', '(.*)' );
	add_rewrite_tag( '%slug%', '(.*)' );
	add_rewrite_tag( '%rrID%', '(.*)' );
	add_rewrite_tag( '%faqpaged%', '(.*)' );
	
	// Add FAQ Page Query Var
	global $wp;
    $wp->add_query_var( 'faqpaged' );
  
  
	// HOMEPAGE
	add_rewrite_rule('^page/([0-9]*)$', 'index.php?pagetype=404', 'top');
	add_rewrite_rule('^amp/page/([0-9]*)$', 'index.php?pagetype=404&amp=1', 'top');
	
	// TWEAKS FOR AMP COMPATIBILITY
	// BLOG
	add_rewrite_rule('^blog/amp$', 'index.php?post_type=article&amp=1', 'top');
	add_rewrite_rule('^blog/amp/page/([0-9]*)$', 'index.php?post_type=article&paged=$matches[1]&amp=1', 'top');
	
	// REVIEWS
	add_rewrite_rule('^reviews/amp$', 'index.php?post_type=review&amp=1', 'top');
	
	// UNBLOCKED GAMES
	add_rewrite_rule('^android/category/(.*)/?', 'index.php?taxonomy=category&post_type=unblockedgame&term=$matches[1]', 'top');
	add_rewrite_rule('^android/amp/?$', 'index.php?page_id='.get_page_by_path("android")->ID.'&amp=1', 'top');
	// add_rewrite_rule('^android/amp$', 'index.php?post_type=unblockedgame&amp=1', 'top');
	add_rewrite_rule('^android/category/(.*)/amp$', 'index.php?taxonomy=category&post_type=unblockedgame&term=$matches[1]&amp=1', 'top');
	
	// UNBLOCKED APPS
	//apps amp page
	add_rewrite_rule('^apps/amp/?$', 'index.php?page_id='.get_page_by_path("apps")->ID.'&amp=1', 'top');
	//app_categories
	add_rewrite_rule('^apps/(?!amp$|amp/$)([^/]*)/?$', 'index.php?taxonomy=app_category&post_type=unblockedapp&term=$matches[1]', 'top');
	//app_categories amp
	add_rewrite_rule('^apps/(?!amp)([^/]*)/amp/?$', 'index.php?taxonomy=app_category&post_type=unblockedapp&term=$matches[1]&amp=1', 'top');
	
	//add_rewrite_rule('^apps/(.*)/amp$', 'index.php?taxonomy=app_category&post_type=unblockedapp&term=$matches[1]&amp=1', 'top');
	
	
	// WALKTHROUGHS
	//wt amp page
	add_rewrite_rule('^walkthroughs/amp/?$', 'index.php?page_id='.get_page_by_path("walkthroughs")->ID.'&amp=1', 'top');
	
	// MINIGAMES
	add_rewrite_rule('^mini-games/amp$', 'index.php?post_type=minigame&amp=1', 'top');
	add_rewrite_rule('^mini-games/amp/page/([0-9]*)$', 'index.php?post_type=minigame&paged=$matches[1]&amp=1', 'top');
	add_rewrite_rule('^mini-games/(.*)/amp$', 'index.php?taxonomy=minigame_tag&post_type=minigame&term=$matches[1]&amp=1', 'top');
	add_rewrite_rule('^mini-games/(.*)/amp/page/([0-9]*)$', 'index.php?taxonomy=minigame_tag&post_type=minigame&term=$matches[1]&paged=$matches[2]&amp=1', 'top');
	
	// SEARCH
	add_rewrite_rule('^search/(.*)/amp$', 'index.php?s=$matches[1]&amp=1', 'top');
	
	// FOR MINI GAME PLAYER PAGES
	add_rewrite_rule('^mini-game/play/(.*)/amp$', 'index.php?pagetype=404', 'top'); // no AMP for play pages
	add_rewrite_rule('^mini-game/play/(.*)/?', 'index.php?pagetype=mgplayer&slug=$matches[1]', 'top');
	
	// FOR REVIEW PAGES
	add_rewrite_rule('^rr/(.*)/?amp/?', 'index.php?pagetype=404', 'top'); // no AMP for review pages
	add_rewrite_rule('^rr/(.*)/?', 'index.php?pagetype=rr&rrID=$matches[1]', 'top');
	
	// FOR FAQ PAGES
	//faq amp page
	add_rewrite_rule('^faq/amp/?$', 'index.php?page_id='.get_page_by_path("faq")->ID.'&amp=1', 'top');
	//faq page by game (paginated)
	add_rewrite_rule('^faq/([^/]*)/page/([0-9]*)/?$','index.php?post_type=faq&name=$matches[1]&faqpaged=$matches[2]','top');

}

add_action('init', 'ocmegames_rewrite_rules');

/* %relatedgame% STRUCTURE TAG */
function relatedgames_post_link( $permalink, $post ) {
 
    // bail if %relatedgame% tag is not present in the url:
    if ( false === strpos( $permalink, '%relatedgame%'))
        return $permalink;
	
	switch($post->post_type){
		case 'faq':
		case 'article':
		case 'walkthrough':
		case 'review':
			$gameID = get_post_meta( $post->ID , $post->post_type.'_relatedgame' , true ); break;
		default:
			return $permalink;
	}
	
	$game_obj = get_post($gameID);
	$game_slug = $game_obj->post_name;
	
    $game_title = urlencode( $game_slug );
    $permalink = str_replace('%relatedgame%', $game_slug , $permalink );
  
    return $permalink;
}

add_filter('post_link', 'relatedgames_post_link', 10, 2 );
add_filter('post_type_link', 'relatedgames_post_link', 10, 2 );



/* REDIRECT IF CUSTOM PAGETYPE IS QUERIED  */
function ocmegames_template_redirect(){
	
	if(check_chromeOS()){
		$restrict = array('post', 'review', 'article');
		if(is_front_page() | is_singular($restrict) | is_post_type_archive($restrict) ) {
			wp_redirect( home_url( '/mini-games/' ) );
        	die;
		}
	}
	
	

	$pagetype = get_query_var( 'pagetype' );
	$relatedgame = get_query_var( 'relatedgame' );
	$slug = get_query_var('slug');
	$rrID = get_query_var('rrID');
	
		if ( !empty( $pagetype ) & $pagetype == 'mgplayer' & !empty( $slug )) {
				global $post;
				$args = array(
				  'name'        => $slug,
				  'post_type'   => 'minigame',
				  'post_status' => 'publish',
				  'numberposts' => 1
				);
				$posts = get_posts($args);
				if( !empty($posts) ) {
					$post = $posts[0];
					setup_postdata( $post );
                 	add_filter( 'wpseo_next_rel_link', '__return_false' );
					remove_action( 'wp_head', 'amp_frontend_add_canonical' , 1 );
					remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
					include(TEMPLATEPATH . '/inc/single_minigameplayer.php');
				} else {
					global $wp_query;
					$wp_query->set_404();
  					status_header( 404 );
  					get_template_part( 404 );
				}
				exit();
			
		} elseif ( !empty( $pagetype ) & $pagetype == 'rr' & !empty( $rrID ) ) {
				global $post;
				$post_id = get_query_var('rrID');
				$post = get_post($post_id);
				if( !empty($post) ){
					setup_postdata( $post );
					if ( $pagetype == 'rr' ) {
						add_filter( 'wpseo_next_rel_link', '__return_false' );
						remove_action( 'wp_head', 'amp_frontend_add_canonical' , 1 );
						remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
						include(TEMPLATEPATH . '/inc/single_reviewform.php');
					}
				} else {
					global $wp_query;
					$wp_query->set_404();
  					status_header( 404 );
  					get_template_part( 404 );
				}
				exit();
		} elseif ( !empty( $pagetype ) & $pagetype == '404' ) {
				
					global $wp_query;
					$wp_query->set_404();
  					status_header( 404 );
  					get_template_part( 404 );
			
				exit();
		}
  
  
		
}

add_action( 'template_redirect', 'ocmegames_template_redirect' );



?>
