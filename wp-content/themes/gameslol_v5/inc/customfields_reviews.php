<?php 

// Register Custom Post Type

function reviews_post_type(){

	$labels = array(
		'name'                  => _x( 'Reviews', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Review', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Reviews', 'text_domain' ),
		'name_admin_bar'        => __( 'Review', 'text_domain' ),
		'archives'              => __( 'Review Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Review:', 'text_domain' ),
		'all_items'             => __( 'All Reviews', 'text_domain' ),
		'add_new_item'          => __( 'Add New Review', 'text_domain' ),
		'add_new'               => __( 'Add Review', 'text_domain' ),
		'new_item'              => __( 'New Review', 'text_domain' ),
		'edit_item'             => __( 'Edit Review', 'text_domain' ),
		'update_item'           => __( 'Update Review', 'text_domain' ),
		'view_item'             => __( 'View Review', 'text_domain' ),
		'view_items'            => __( 'View Reviews', 'text_domain' ),
		'search_items'          => __( 'Search Reviews', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into review', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this review', 'text_domain' ),
		'items_list'            => __( 'Review list', 'text_domain' ),
		'items_list_navigation' => __( 'Review list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter reviews list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'review',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Review', 'text_domain' ),
		'description'           => __( 'Game reviews', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'reviews',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'review', $args );

}

//create a custom taxonomy name it topics for your posts

add_action( 'init', 'reviews_post_type', 0 );

/* ADD METABOXES */

function ocmegames_addmetaboxes_review() {
    add_meta_box( 'ocmegames_meta_review', 'More Info', 'ocmegames_displaymetabox_review', 'review' , 'side', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_review' );

/* DISPLAY NEW BOXES */

function ocmegames_displaymetabox_review( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	
    ?>
 	<div id="new_meta">
    <p>
    <label for="review_source" class="row-title">Review Source URL</label>
	  <input class="textinput" type="url" name="review_source" id="review_source" value="<?php if ( isset ( $ocmegames_stored_meta['review_source'] ) ) echo $ocmegames_stored_meta['review_source'][0]; ?>" />
    </p>
    <p>
    <?php if ( isset ( $ocmegames_stored_meta['review_relatedgame'] ) ){ $select = $ocmegames_stored_meta['review_relatedgame'][0]; } 
		$dropdown_array = get_posts_dropdown_array();
	?>
    
    <label for="review_relatedgame" class="row-title">Related Game</label>
      <select id="review_relatedgame" name="review_relatedgame">
        <option value=""></option>
      	<?php foreach($dropdown_array as $post_id => $title){ ?>
			 <option value="<?php echo $post_id; ?>" <?php if($post_id == $select){ echo 'selected'; } ?>><?php  echo $title; ?></option>
		<?php } ?>
      </select>
    </p>
	</div>
    <?php
  }

/* SAVE CUSTOM FIELDS */

function ocmegames_savemeta_review( $post_id, $post = false) {
 
	if($post->post_type != 'review') {
		// Checks save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'ocmegames_nonce' ] ) && wp_verify_nonce( $_POST[ 'ocmegames_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		// Checks for input and sanitizes/saves if needed
		if( isset( $_POST[ 'review_relatedgame' ] ) ) {
			update_post_meta( $post_id, 'review_relatedgame', sanitize_text_field( $_POST[ 'review_relatedgame' ] ) );
		}
		if( isset( $_POST[ 'review_source' ] ) ) {
			update_post_meta( $post_id, 'review_source', sanitize_text_field( $_POST[ 'review_source' ] ) );
		}
	}
    
}

function ocmegames_saveslug_review( $post_id ) {

		$game_id = get_post_meta($post_id, 'review_relatedgame', true);
	
		if($game_id <> ''){
			
			// unhook this function to prevent infinite looping
        	remove_action( 'save_post_review', 'ocmegames_saveslug_review' );
			
			$game_obj = get_post($game_id);
			$slug = $game_obj->post_name;
			
			wp_update_post( array(
					'ID' => $post_id,
					'post_name' => $slug
					));
			
			add_action( 'save_post_review', 'ocmegames_saveslug_review' );
		}
}


add_action( 'save_post_review', 'ocmegames_savemeta_review' );
add_action( 'save_post_review', 'ocmegames_saveslug_review' );


/* SUPER USEFUL GET GAME INFO FUNCTION */

function get_the_review_info($id){
	
	$info = array();
	
	/* Mandatory Images + Captions */
	$info['gameID'] = get_post_meta($id, 'review_relatedgame', true);
	$info['source'] = get_post_meta($id, 'review_source', true);
	
	return $info;
}

?>