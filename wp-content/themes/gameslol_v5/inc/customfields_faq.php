<?php 

// Register Custom Post Type

$FAQ_POSTS_PER_PAGE = 5;

function faq_post_type(){

	$labels = array(
		'name'                  => _x( 'FAQ', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'FAQ', 'text_domain' ),
		'name_admin_bar'        => __( 'FAQ', 'text_domain' ),
		'archives'              => __( 'FAQ Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add Item', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Items', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into article', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'text_domain' ),
		'items_list'            => __( 'Article list', 'text_domain' ),
		'items_list_navigation' => __( 'Article list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter articles list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'faq',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'FAQ', 'text_domain' ),
		'description'           => __( 'Frequently Asked Questions', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions', 'page-attributes', 'custom-fields' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-info',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );
	
}

add_action( 'init', 'faq_post_type', 0 );

/* ADD METABOXES */

function ocmegames_addmetaboxes_faq() {
    add_meta_box( 'ocmegames_meta_faq', 'More Info', 'ocmegames_displaymetabox_faq', 'faq' , 'side', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_faq' );

/* DISPLAY NEW BOXES */

function ocmegames_displaymetabox_faq( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	
    ?>
 	<div id="new_meta">
    <p>
    <?php if ( isset ( $ocmegames_stored_meta['faq_relatedgame'] ) ){ 
		$select = $ocmegames_stored_meta['faq_relatedgame'][0]; } 
		$dropdown_array = get_posts_dropdown_array();
	?>
    
    <label for="faq_relatedgame" class="row-title">Related Game</label>
      <select id="faq_relatedgame" name="faq_relatedgame" required>
        <option value="0">NONE - this is a subpage</option>
      	<?php foreach($dropdown_array as $post_id => $title){ ?>
			 <option value="<?php echo $post_id; ?>" <?php if($post_id == $select){ echo 'selected'; } ?>><?php  echo $title; ?></option>
		<?php } ?>
      </select>
		<span style="font-size: 8pt;color:red;">(Required if this is a parent FAQ page.<br>
If this is a subpage, select NONE and assign a Parent instead.)</span>
    </p>
	</div>
    <?php
  }

/* SAVE CUSTOM FIELDS */

function ocmegames_savemeta_faq( $post_id, $post = false) {
 
	if($post->post_type != 'article') {
		// Checks save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'ocmegames_nonce' ] ) && wp_verify_nonce( $_POST[ 'ocmegames_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		// Checks for input and sanitizes/saves if needed
		if( isset( $_POST[ 'faq_relatedgame' ] ) ) {
			update_post_meta( $post_id, 'faq_relatedgame', sanitize_text_field( $_POST[ 'faq_relatedgame' ] ) );
		}
	}
    
}

function ocmegames_saveslug_faq( $post_id ) {

		if( isset( $_POST[ 'parent_id' ] ) && $_POST[ 'parent_id' ] > 0 && $_POST[ 'parent_id' ] <> "" ) {
			
			// is child page
			
		} else {
			
			$game_id = get_post_meta($post_id, 'faq_relatedgame', true);
	
			if($game_id <> ''){

				// unhook this function to prevent infinite looping
				remove_action( 'save_post_faq', 'ocmegames_saveslug_faq' );

				$game_obj = get_post($game_id);
				$slug = $game_obj->post_name;

				wp_update_post( array(
						'ID' => $post_id,
						'post_name' => $slug
						));

				add_action( 'save_post_faq', 'ocmegames_saveslug_faq' );
			}
			
		}
}

add_action( 'save_post_faq', 'ocmegames_savemeta_faq' );
add_action( 'save_post_faq', 'ocmegames_saveslug_faq' );

/* CUSTOM ADMIN COLUMNS */

function set_custom_edit_faq_columns($columns) {
    $columns['relatedgame'] = "Related Game";
    return $columns;
}
function custom_faq_column( $column, $post_id ) {
    switch ( $column ) {
        case 'relatedgame' :
			if( wp_get_post_parent_id( $post_id ) ) {
				echo '<span style="color: lightgray"> --- this is a subpage</span>';
			} else {
				$gameID = get_post_meta($post_id, 'faq_relatedgame', true);
				echo get_the_title($gameID); 
			}
            
    }
}

add_filter( 'manage_faq_posts_columns', 'set_custom_edit_faq_columns' );
add_action( 'manage_faq_posts_custom_column' , 'custom_faq_column', 10, 2 );

/* ARCHIVE QUERY TWEAK */

function faq_archive_tweak( $query ) {  
	if($query->is_main_query() && is_post_type_archive('faq' )  && !is_admin()){  
   
		$relatedgame = get_query_var("relatedgame");
		$gameID = get_post_by_slug($relatedgame)->ID;
				
        // order post_type and remove pagination  
		global $FAQ_POSTS_PER_PAGE;
        $query->set('posts_per_page', $FAQ_POSTS_PER_PAGE); 
        $query->set('order', 'DESC'); 
		$query->set('meta_query', 
					array(
						array(
							'key'     => 'faq_relatedgame',
							'value'   => $gameID,
							'compare' => 'LIKE',
						)));
    }  
}  
add_action( 'pre_get_posts', 'faq_archive_tweak' );

/* SUPER USEFUL GET GAME INFO FUNCTION */

function get_the_faq_info($id){
	
	$info = array();
	
	if( wp_get_post_parent_id( $id ) ) {
		$info['relatedgame'] = get_post_meta(wp_get_post_parent_id( $id ), 'faq_relatedgame', true);
	} else {
		$info['relatedgame'] = get_post_meta($id, 'faq_relatedgame', true);
	}
	
	return $info;
	
	
}

/* CHECK IF GAME HAS FAQ */

function get_the_faq_page($game_id){
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'faq',
		'post_parent' => 0,
		'meta_query' =>	array(
							array(
								'key'     => 'faq_relatedgame',
								'value'   => $game_id,
								'compare' => 'LIKE',
							)));
	$posts = get_posts( $args );
	return $posts[0];
}

/* CHECK IF GAME HAS FAQs */

function get_the_faq_count($game_id){
	if(get_the_faq_page($game_id)){
		$faq_page = get_the_faq_page($game_id);
		$args = array(
			'post_status' => 'publish',
			'post_type' => 'faq',
			'post_parent' => $faq_page->ID
		);
		$check = get_posts( $args );
		return count($check);
	} else {
		return 0;
	}
}

/* GET GAME FAQs */

function get_the_faq_posts($game_id){
	if(get_the_faq_page($game_id)){
		$faq_page = get_the_faq_page($game_id);
		$args = array(
			'post_status' => 'publish',
			'post_type' => 'faq',
			'post_parent' => $faq_page->ID
		);
		$myposts = get_posts( $args );
		return $myposts;
	} else {
		return false;
	}
}

function faq_rel_links(){
	
  if(is_singular('faq')){  
	 $faqpaged = (int) get_query_var( 'faqpaged' );
	 $post_type = get_query_var( 'post_type' );
	 $parent_id = get_the_ID();
	
			if( !wp_get_post_parent_id( $parent_id ) ) {
				
				if( $faqpaged == 0 ) { $faqpaged = 1; }

				if ( (int) $faqpaged > 0 ) {
					global $FAQ_POSTS_PER_PAGE;
					$posts_per_page = $FAQ_POSTS_PER_PAGE;
					$args = array(
								'post_type' => 'faq',
								'post_parent' => $parent_id,
								'posts_per_page' => $posts_per_page,
								'paged' => $faqpaged
							);
					
					$myposts = new WP_Query($args);
					
					$current_page = $faqpaged;
					$permalink = get_the_permalink(get_the_ID());
					$title = get_the_title(get_the_ID());
					$min = 1;
					$max = $myposts->max_num_pages;
					
					//-- PRINT CANONICAL LINK
					if(!empty(get_query_var( 'faqpaged' ))){
					$canon_url = $permalink;
					$canon_title = $title;
					if( $current_page > 1 ){
						$canon_url .= 'page/' . $current_page;
						$canon_title .= '| Page '. $current_page;
						
					}
					?>
					<link rel="canonical" href="<?php echo $canon_url; ?>"
						  name="<?php echo $canon_title; ?>" />
					<?php 
					}
					//-- PRINT PREVIOUS PAGE LINK
					$prev_page = $current_page - 1;
					if( $prev_page >= $min ){
						$prev_url = $permalink;
						$prev_title = $title;
						if($prev_page > 1) { 
							$prev_url .= 'page/' . $prev_page;
							$prev_title .= '| Page '. $prev_page; 
						}
						?>
						<link rel="prev" href="<?php echo $prev_url; ?>"
							  name="<?php echo $prev_title; ?>" />
						<?php
					}
					
					//-- PRINT NEXT PAGE LINK
					$next_page = $current_page + 1;
					if( $next_page <= $max ){
						$next_url = $permalink . 'page/' . $next_page;
						?>
						<link rel="next" href="<?php echo $next_url; ?>" 
							  name="<?php echo $title .'| Page '. $next_page; ?>" />
						<?php
					}
					
				} 

			}
  }
}

add_action( 'wp_head', 'faq_rel_links' );

function remove_canonical_url( $url ){
 return false;
}

function get_the_faq_pages(\WP_Query $wp_query = null, $echo = true) {
	
	if ( $wp_query <> null) {
		$current_page = $wp_query->query_vars['paged'];
		$pages = paginate_links( array(
				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'       => '?paged=%#%',
				'current'      => $current_page,
				'total'        => $wp_query->max_num_pages,
				'type'         => 'array',
				'show_all'     => false,
				'end_size'     => 10,
				'mid_size'     => 1,
				'prev_next'    => true,
				'prev_text'    => __( '« Prev' ),
				'next_text'    => __( 'Next » ' ),
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
	}
		
	return null;
}

function ocmegames_faq_pages_redirect() {
	
	$faqpaged = get_query_var( 'faqpaged' );
	$post_type = get_query_var( 'post_type' );
	$parent_id = get_the_ID();
	
	if( $post_type == 'faq' && $faqpaged <> "" ){
			
			if( !wp_get_post_parent_id( $parent_id ) ) {
				
				if( $faqpaged == "" ) { $faqpaged = 1; }

				if ( (int) $faqpaged > 0 ) {
					global $FAQ_POSTS_PER_PAGE;
					$posts_per_page = $FAQ_POSTS_PER_PAGE;
					$args = array(
								'post_type' => 'faq',
								'post_parent' => $parent_id,
								'posts_per_page' => $posts_per_page,
								'paged' => $faqpaged
							);
					if ( get_posts($args) ){
                      // All in One SEO
					  // add_filter('aioseop_canonical_url','remove_canonical_url', 10, 1);
                      // YOAST SEO
						add_filter( 'wpseo_canonical', '__return_false' );
						remove_action( 'wp_head', 'rel_canonical' );
						
						include(TEMPLATEPATH . '/single-faq.php');
						exit();
					}
					
				} 
					global $wp_query;
					$wp_query->set_404();
					status_header( 404 );
					get_template_part( 404 );
					exit();
				
			}
		} 
		
}

add_action( 'template_redirect', 'ocmegames_faq_pages_redirect' );

?>