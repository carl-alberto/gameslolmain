<?php 

// Register Custom Post Type

function articles_post_type(){

	$labels = array(
		'name'                  => _x( 'Articles', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Articles', 'text_domain' ),
		'name_admin_bar'        => __( 'Article', 'text_domain' ),
		'archives'              => __( 'Article Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Article:', 'text_domain' ),
		'all_items'             => __( 'All Articles', 'text_domain' ),
		'add_new_item'          => __( 'Add New Article', 'text_domain' ),
		'add_new'               => __( 'Add Article', 'text_domain' ),
		'new_item'              => __( 'New Article', 'text_domain' ),
		'edit_item'             => __( 'Edit Article', 'text_domain' ),
		'update_item'           => __( 'Update Article', 'text_domain' ),
		'view_item'             => __( 'View Article', 'text_domain' ),
		'view_items'            => __( 'View Articles', 'text_domain' ),
		'search_items'          => __( 'Search Articles', 'text_domain' ),
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
		'slug'                  => 'blog',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Article', 'text_domain' ),
		'description'           => __( 'Blog articles', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'topics' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-aside',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'blog',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'article', $args );

}

//create a custom taxonomy name it topics for your posts
function articles_category() {

  $labels = array(
    'name' => _x( 'Topics', 'taxonomy general name' ),
    'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Topics' ),
    'all_items' => __( 'All Topics' ),
    'parent_item' => __( 'Parent Topic' ),
    'parent_item_colon' => __( 'Parent Topic:' ),
    'edit_item' => __( 'Edit Topic' ), 
    'update_item' => __( 'Update Topic' ),
    'add_new_item' => __( 'Add New Topic' ),
    'new_item_name' => __( 'New Topic Name' ),
    'menu_name' => __( 'Topics' ),
  ); 	

// Now register the taxonomy

  register_taxonomy('topics',array('article'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'topic' ),
  ));

}


add_action( 'init', 'articles_post_type', 0 );
add_action( 'init', 'articles_category', 0 );

/* ADD METABOXES */

function ocmegames_addmetaboxes_article() {
    add_meta_box( 'ocmegames_meta_article', 'More Info', 'ocmegames_displaymetabox_article', 'article' , 'side', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_article' );

/* DISPLAY NEW BOXES */

function ocmegames_displaymetabox_article( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	
    ?>
 	<div id="new_meta">
    <p>
    <label for="article_video" class="row-title">Video URL</label>
	  <input class="textinput" type="url" name="article_video" id="article_video" value="<?php if ( isset ( $ocmegames_stored_meta['article_video'] ) ) echo $ocmegames_stored_meta['article_video'][0]; ?>" />
    </p>
    <p>
    <?php if ( isset ( $ocmegames_stored_meta['article_relatedgame'] ) ){ $select = $ocmegames_stored_meta['article_relatedgame'][0]; } 
		$dropdown_array = get_posts_dropdown_array();
	?>
    
    <label for="article_relatedgame" class="row-title">Related Game</label>
      <select id="article_relatedgame" name="article_relatedgame">
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

function ocmegames_savemeta_article( $post_id, $post = false) {
 
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
		if( isset( $_POST[ 'article_relatedgame' ] ) ) {
			update_post_meta( $post_id, 'article_relatedgame', sanitize_text_field( $_POST[ 'article_relatedgame' ] ) );
		}
		if( isset( $_POST[ 'article_video' ] ) ) {
			update_post_meta( $post_id, 'article_video', sanitize_text_field( $_POST[ 'article_video' ] ) );
		}
	}
    
}

add_action( 'save_post_article', 'ocmegames_savemeta_article' );


/* SUPER USEFUL GET GAME INFO FUNCTION */

function get_the_article_info($id){
	
	$info = array();
	
	/* Mandatory Images + Captions */
	$info['gameID'] = get_post_meta($id, 'article_relatedgame', true);
	
	/* More Info */
	$info['video'] = get_post_meta($id, 'article_video', true);
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $info['video'], $matches);
    $info['video_id'] = $matches[1];
	$info['video_embedcode'] = '<iframe src="https://www.youtube.com/embed/'.$info['video_id'].'?rel=0&autoplay=1&feature=youtu.be" frameborder="0" width="853" height="505" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	
	return $info;
}

?>