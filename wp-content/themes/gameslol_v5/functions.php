<?php

function ocmegames_scripts() {
	
	// wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'css_bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'css_bootstrap_lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css' );
	
	//Sliders - only enqueue if slider is in page
	wp_register_style( 'css_slick-theme', get_template_directory_uri() . '/css/slick-theme.css');
	wp_register_style( 'css_slick', get_template_directory_uri() . '/css/slick.css');
	// if (check_slider()) {
		wp_enqueue_style( 'css_slick' );
		wp_enqueue_style( 'css_slick-theme' );
	//}
	
	wp_enqueue_style( 'css_main', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'css_custom', get_template_directory_uri() . '/css/custom.css' );
  
	
	/* TEMPORARY THEME -- comment out when not in use */
	// if(is_front_page()){
	// 	wp_enqueue_style( 'css_temporary', get_template_directory_uri() . '/css/avengers.css' );
	// } 

	// JQuery and Bootstrap.
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'js_gapi', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js' );
	wp_enqueue_script( 'js_popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' );
	wp_enqueue_script( 'js_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' );
	wp_enqueue_script( 'js_bootstrap_lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js' );

	wp_enqueue_script( 'js_scripts', get_theme_file_uri('/js/themescripts.js') );
	
	// Sliders
	wp_register_script( 'js_slick', get_theme_file_uri('/js/slick.min.js'), array( 'jquery' ) );
	wp_register_script( 'js_script_slider', get_theme_file_uri('/js/themescripts_slider.js'), array( 'js_slick' ) );
	//if (check_slider()) {
		wp_enqueue_script( 'js_slick' );
		wp_enqueue_script( 'js_script_slider' );
	//}
	wp_enqueue_script( 'js_scripts_startgame', get_theme_file_uri('/js/mobigame.js') );
	
	
	// AJAX
	
	$post_types = array('post', 'unblockedgame', 'unblockedapp', 'article', 'walkthrough', 'faq'); 
	$post_types_archive = array('walkthrough', 'faq');
	$page_templates_qd = array( 'page-custom_game_archive.php', 'page-custom_app_archive.php', 'page-new-frontpage.php' );

	if( is_singular($post_types)  | 
	   (is_archive($post_types_archive) && get_query_var('relatedgame')) ) {
		wp_enqueue_script( 'js_scripts_ajax', get_theme_file_uri('/js/themescripts_ajax_download.js') );

	} elseif ( is_singular('minigame') ) { 
		wp_enqueue_script( 'js_scripts_ajax', get_theme_file_uri('/js/themescripts_ajax_play.js') );
		
	} elseif( check_quickdownload() | is_page_template($page_templates_qd) ){
		wp_enqueue_script( 'js_scripts_ajax', get_theme_file_uri('/js/themescripts_ajax_quickdownload.js') );
		
	}

	wp_localize_script( 'js_scripts_ajax', 'wp_ajax', 
		array('ajax_url' => admin_url( 'admin-ajax.php' ),
			  'ajax_loading' => get_theme_file_uri('/images/loading.gif') ) );
	
	//wp_enqueue_script( 'js_scripts_video', get_theme_file_uri('/js/themescripts_videoplayer.js') );
	//wp_enqueue_script( 'js_easypaginate', get_theme_file_uri('/js/jquery.easyPaginate.js') );
	
	//Dequeue Dashicons in Frontend
	if (current_user_can( 'update_core' )) {
		return;
	}
	wp_deregister_style('dashicons');
}	

add_action( 'wp_enqueue_scripts', 'ocmegames_scripts' );

include 'inc/go_ajax.php';
include 'inc/customizer.php';
include 'inc/customizer_admin.php';
include 'inc/custom_rewrites.php';
include 'inc/custom_rest_api.php';
include 'inc/customfields_games.php';
include 'inc/customfields_unblockedgames.php';
include 'inc/customfields_unblockedapps.php';
include 'inc/customfields_minigames.php';
include 'inc/customfields_articles.php';
include 'inc/customfields_reviews.php';
include 'inc/customfields_walkthrough.php';
include 'inc/customfields_faq.php';
include 'inc/customfields_tax.php';
include 'inc/widgets.php';
include 'inc/shortcodes.php';

function debug_to_console( $data ) {
    if ( is_array( $data ) )
     $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
     else
     $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
    echo $output;
}

function ocmegames_meta_box_styles() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/admin-styles.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
		wp_enqueue_script( 'js_scripts_admin', get_theme_file_uri('/js/themescripts_admin.js') );
}
add_action( 'admin_enqueue_scripts', 'ocmegames_meta_box_styles' );

/*****************************************************
/**************** CUSTOM TITLE ***********************
/*****************************************************/ 

function ocmegames_title($title, $addBlogName = true)   
{  
    global $post;  
	$pageTitle = $title;
	
	$is_mg_player = (get_query_var('pagetype') == 'mgplayer');
      
    if ((is_home() | is_front_page()) && !($is_mg_player)) {  /*** HOMEPAGE ***/ 
		
		$pageTitle = bloginfo('name')." | ".bloginfo('description');
	
	} elseif (is_404()) {  /*** PAGE NOT FOUND*****/ 
		
		$pageTitle = "404 Page Not Found";

	} elseif (is_search()) {  /*** SEARCH PAGE *****/ 
		
		$pageTitle = "Search: ".wp_specialchars($s, 1); 
	
	} else {
	
		$pageTitle = '';

		if (is_category()) { /***** CATEGORY ARCHIVE PAGE *****/ 

			$pageTitle.="Category";
			$pageTitle = $pageTitle." | ".single_cat_title('',false);	

		} elseif( is_tax() ) { /******* CUSTOM TAXONOMIES ********/
			
			$pageTitle = get_the_archive_title();
			
		} elseif (is_singular('post')) { /***** GAME SINGLE PAGE *****/ 

			$pageTitle = "Download " . single_post_title('',false) . " on PC now";

		}  elseif (is_post_type_archive('article')) { /***** ARTICLE ARCHIVE PAGE *****/ 

			$pageTitle = "Editor's Blog";

		}  elseif (is_post_type_archive('review')) { /***** REVIEW ARCHIVE PAGE *****/ 

			$pageTitle = "Game Reviews";

		}  elseif (is_post_type_archive('minigame')) { /***** MINIGAME ARCHIVE PAGE *****/ 

			$pageTitle = "Mini Games";

		}	elseif (is_singular( array('article', 'walkthrough', 'faq', 'unblockedapp', 'unblockedgame'))) { /***** CPT SINGLE PAGE *****/ 

			$pageTitle = single_post_title('',false);

		}  elseif (is_singular('review')) { /***** REVIEW SINGLE PAGE *****/ 

			$pageTitle.= "Review - ".get_the_title(get_the_id());

		}  elseif (is_singular('minigame')) { /***** MINIGAME SINGLE PAGE *****/ 

			$pageTitle.= "Play ".get_the_title(get_the_id())." for Free Now";

		}  elseif ( $is_mg_player ) { /***** MINIGAME SINGLE PAGE *****/ 

			$pageTitle.= "Now Playing: ".get_the_title(get_the_id());

		}	elseif (is_page()) {  /***** PAGE *****/ 

			$pageTitle = $pageTitle.single_post_title('',false);

		} elseif( is_archive() ){
			
			$pageTitle = get_the_archive_title();
			
		}
	}
		
	if($addBlogName){

		$pageTitle = $pageTitle." | ".get_bloginfo('name');
	}
	
    return $pageTitle;  
}  

//add_filter('wp_title', 'ocmegames_title');

/*****************************************************
/************&**** BREADCRUMBS ***********************
/*****************************************************/

if( ! function_exists('ocmegames_breadcrumbs') ){
	function ocmegames_breadcrumbs(){
		
		//Output Breadcrumbs
		// DEFAULT - 1: Home
		?>
			<!-- BREADCRUMBS -->
			<script type="application/ld+json">
				{
				 "@context": "http://schema.org",
				 "@type": "BreadcrumbList",
				 "itemListElement": [{
				   "@type": "ListItem",
				   "position": 1,
				   "name": "Home",
				   "item": "<?php echo site_url('/','https'); ?>"
					}
		<?php
		
		if(!is_front_page()) {

			$bc_permalink = site_url('','https');
			if(is_post_type_archive() | is_archive()){
				global $wp;
				
				if(is_category()){
					$bc_title = single_cat_title('', false);
				} else {
					$bc_title = get_the_archive_title();
				}
				
				$bc_permalink = home_url( $wp->request . '/' , 'https');
				?>
				  ,{
				   "@type": "ListItem",
				  "position": 2,
				  "name": "<?php echo $bc_title; ?>",
				  "item": "<?php echo $bc_permalink; ?>"
				   }
				<?php 
			} elseif (is_singular()) { 
				$bc_title = get_the_title();
				$bc_permalink = get_the_permalink();
				?>
				  ,{
				   "@type": "ListItem",
				  "position": 2,
				  "name": "<?php echo $bc_title; ?>",
				  "item": "<?php echo $bc_permalink; ?>"
				   }
				<?php 
			}
		}
		
		// Close Breadcrumbs JSON
		?>
			 ]
			}
			</script>
			<!-- END BREADCRUMBS -->
		<?php
	}
}

add_action('wp_head', 'ocmegames_breadcrumbs');

/*****************************************************
/************ REMOVE REL LINKS ***********************
/*****************************************************/ 

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

/*****************************************************
/******* LOAD CUSTOMIZER & MORE META OPTIONS *********
/*****************************************************/ 

function get_posts_dropdown_array(){
	$dropdown_array = array();
	$myargs = array( 'post_type' => 'post', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'status'=> 'publish' );
	$myposts = get_posts( $myargs );
	foreach ( $myposts as $thepost ) :
		$dropdown_array[$thepost->ID] = get_the_title($thepost->ID);
	endforeach; 
	return $dropdown_array;
}

/*****************************************
/******* SITE URL NO SCHEME **************
/*****************************************/

function ocmegames_template_directory(){
	$dir = get_template_directory_uri();
	$parsed = parse_url($dir);
	$dir = "//" . $parsed['host'] . $parsed [ 'path' ];
	return $dir;
}

function ocmegames_site_url(){
	$dir = site_url();
	$parsed = parse_url($dir);
	$dir = "//" . $parsed['host'] . $parsed [ 'path' ];
	return $dir;
}

function check_chromeOS(){
	$user_agent = getenv("HTTP_USER_AGENT");
	if(strpos($user_agent, "CrOS")) {
		return true; 
	} else {
		return false;
	}
}

/*****************************************
/************* RATING TWEAK **************
/*****************************************/

function ocmegames_get_game_rating($post_id, $post_type){
		if (class_exists('RichReviews')) {
				$rr = new RichReviews();
				$rating_data = $rr->rr_ali_get_post_rating($post_type, $post_id);
				//$average = number_format((float)$rating_data['average'], 1, '.', '');
				//return $average;
				return $rating_data;
		} else {
				return 0;
		}
		
	}

/*****************************************
/******* POST THUMBNAIL SUPPORT *********
/*****************************************/ 

add_theme_support( 'post-thumbnails' );

/*****************************************
/******* WORDPRESS SEARCH TWEAK **********
/*****************************************/ 

//Exclude pages from WordPress Search
if (!is_admin()) {
		
function wpb_search_filter($query) {

	if ($query->is_search) {
		if(check_chromeOS()) {
			$query->set('post_type', array('minigame'));
		} else {
			$query->set('post_type', array('post', 'minigame'));
		}
	}
	
	/* Convert hyphen to space */
	$search_query = $query->get('s');
	$query->set('s', str_replace("-", " ", $search_query));
  
	return $query;
}
		
add_filter('pre_get_posts','wpb_search_filter');
}

/*****************************************
/******** REGISTER CUSTOM MENUS **********
/*****************************************/ 

function register_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' )
    )
  );
  register_nav_menus(
    array(
      'header-menu-chromeos' => __( 'Header Menu for ChromeOS' )
    )
  );
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}

add_action( 'init', 'register_menus' );

/*****************************************
/******** BOOTSTRAP MENUS **********
/*****************************************/ 

class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {
    
    function start_lvl( &$output, $depth = 0, $args = array() ){ // ul
        $indent = str_repeat("\t",$depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu bg-dark $submenu depth_$depth\">\n";
    }
  
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span
        
    $indent = ( $depth ) ? str_repeat("\t",$depth) : '';
    
    $li_attributes = '';
        $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-menu';
        }
        
        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
        
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
        
        $item_output = $args->before;
        $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    
    }
    
}

/*****************************************
/************ POST VIEWS SCRIPT **********
/*****************************************/ 

function add_gameviews($post_id) {
	
	if($post_id > 0) {
		$game_views = get_post_meta($post_id, 'game_views', true);
		if($game_views == "") {
			$game_views = 0;
		}
		update_post_meta( $post_id, 'game_views', $game_views + 1 );
	}
}

function pippin_get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}


/*****************************************
/*********** GET POST BY SLUG ************
/****************************************/
function get_post_by_slug($post_name) {
	
  global $wpdb;
  $post = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s", $post_name));

  return $post ? get_post($post) : NULL;
  
}

/*****************************************
/********** ARCHIVE PAGINATION ***********
/****************************************/

function get_the_archive_pages(\WP_Query $wp_query = null, $echo = true ) {
	if ( null === $wp_query ) {
		global $wp_query;
	}
	
	$pages = paginate_links( array(
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => __( '« Prev' ),
			'next_text'    => __( 'Next »' ),
			'add_args'     => false,
			'add_fragment' => ''
		)
	);
	
	if ( is_array( $pages ) ) {
		//$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
		$pagination = '<div class="pagination"><ul class="pagination">';
		foreach ( $pages as $page ) {
			$pagination .= '<li class="page-item '.(strpos($page, 'current') !== false ? 'active' : '').'"> ' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
		}
		$pagination .= '</ul></div>';
		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
	
	return null;
}

/*****************************************
/******* POST EXCERPT LENGTH *********
/****************************************
function custom_excerpt_length( $length ) {
	return 18;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


?>

/********************************************/
/**** POSTS PER PAGE ON CATEGORY ARCHIVE ****/
/********************************************/

function archive_page_postsnum( $query ) {
		if ( ( is_category() | is_tag() ) &&  $query->is_main_query() ) {
						$query->set( 'posts_per_page', -1 );
		}
}
add_filter( 'pre_get_posts', 'archive_page_postsnum' );


/********************************************/
/******* CHECK FOR QUICKDOWNLOAD ************/
/********************************************/

function check_quickdownload ( $force_quickdownload = false ) {
		if ( ( is_category() | is_tag() )) {
			return true;
		/*  } elseif ( is_page() && is_page_template( array('page-custom_game_archive.php') )   ) {
			return true; */
		} elseif( $force_quickdownload ) {
			return true;
		} elseif( ( is_page() )) {
			global $post;
			if( has_shortcode( $post->post_content, 'gameslol_grid') ){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
}

/********************************************/
/******* CHECK FOR SLIDER SHORTCODE *********/
/********************************************/

function check_slider(){
	if( is_single() && !is_front_page() ) {
		global $post;
		if( has_shortcode( $post->post_content, 'gameslol_slider') ){
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}


/********************************************/
/**************** SVG ICONS *****************/
/********************************************/

function gameslol_svg( $icon, $width = "20px", $height = "20px", $color = "#000" ){
	if( $icon <> "" ){ ?>
		<svg class="svg-icon" viewBox="0 0 20 20" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>;">
			<path fill="none" d="<?php echo get_svg_path( $icon ); ?>" style="fill: <?php echo $color; ?>;"></path>
		</svg>
	<?php
	} else {
		return false;
	}
}

function get_svg_path( $icon ){
	
	switch( $icon ){
		case 'bars':
			return 'M3.314,4.8h13.372c0.41,0,0.743-0.333,0.743-0.743c0-0.41-0.333-0.743-0.743-0.743H3.314c-0.41,0-0.743,0.333-0.743,0.743C2.571,4.467,2.904,4.8,3.314,4.8z M16.686,15.2H3.314c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,15.2,16.686,15.2z M16.686,9.257H3.314c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,9.257,16.686,9.257z';
		break;
		case 'chev-left':
			return 'M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z';
		break;	
		case 'chev-right':
			return 'M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z';
		break;
		case 'search':
			return 'M19.129,18.164l-4.518-4.52c1.152-1.373,1.852-3.143,1.852-5.077c0-4.361-3.535-7.896-7.896-7.896c-4.361,0-7.896,3.535-7.896,7.896s3.535,7.896,7.896,7.896c1.934,0,3.705-0.698,5.078-1.853l4.52,4.519c0.266,0.268,0.699,0.268,0.965,0C19.396,18.863,19.396,18.431,19.129,18.164z M8.567,15.028c-3.568,0-6.461-2.893-6.461-6.461s2.893-6.461,6.461-6.461c3.568,0,6.46,2.893,6.46,6.461S12.135,15.028,8.567,15.028z';
		break;
		case 'arrow-down':
			return 'M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z';
		break;
		default:
			return false;
	}
}

/*** Clean Up Wordpress Header ***/

remove_action ('wp_head', 'rsd_link');
remove_action ('wp_head', 'wlwmanifest_link');
remove_action ('wp_head', 'wp_generator');

/*** Disable Yoast Auto Redirection ***/
add_filter('wpseo_premium_post_redirect_slug_change', '__return_true' );
add_filter('wpseo_premium_term_redirect_slug_change', '__return_true' );

