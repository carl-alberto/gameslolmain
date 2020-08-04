<?php 

// Register Custom Post Type

function walkthroughs_post_type(){

	$labels = array(
		'name'                  => _x( 'Walkthroughs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Walkthrough', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Walkthroughs', 'text_domain' ),
		'name_admin_bar'        => __( 'Walkthrough', 'text_domain' ),
		'archives'              => __( 'Walkthrough Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Walkthrough:', 'text_domain' ),
		'all_items'             => __( 'All Walkthroughs', 'text_domain' ),
		'add_new_item'          => __( 'Add New Walkthrough', 'text_domain' ),
		'add_new'               => __( 'Add Walkthrough', 'text_domain' ),
		'new_item'              => __( 'New Walkthrough', 'text_domain' ),
		'edit_item'             => __( 'Edit Walkthrough', 'text_domain' ),
		'update_item'           => __( 'Update Walkthrough', 'text_domain' ),
		'view_item'             => __( 'View Walkthrough', 'text_domain' ),
		'view_items'            => __( 'View Walkthroughs', 'text_domain' ),
		'search_items'          => __( 'Search Walkthroughs', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into walkthrough', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this walkthrough', 'text_domain' ),
		'items_list'            => __( 'Walkthrough list', 'text_domain' ),
		'items_list_navigation' => __( 'Walkthrough list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter walkthroughs list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'walkthroughs',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Walkthrough', 'text_domain' ),
		'description'           => __( 'Game Level-by-Level Walkthrough', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'custom-fields' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-forms',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'walkthrough', $args );

}

//create a custom taxonomy name it topics for your posts

add_action( 'init', 'walkthroughs_post_type', 0 );

/* ADD METABOXES */

function ocmegames_displaymetabox_walkthrough( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	
    ?>
 	<div id="new_meta">
    <p>
    <?php if ( isset ( $ocmegames_stored_meta['walkthrough_relatedgame'] ) ){ $select = $ocmegames_stored_meta['walkthrough_relatedgame'][0]; } 
		$dropdown_array = get_posts_dropdown_array();
	?>
    
    <label for="walkthrough_relatedgame" class="row-title">Related Game</label>
      <select id="walkthrough_relatedgame" name="walkthrough_relatedgame" required>
        <option value="0">NONE - this is a LEVEL page</option>
      	<?php foreach($dropdown_array as $post_id => $title){ ?>
			 <option value="<?php echo $post_id; ?>" <?php if($post_id == $select){ echo 'selected'; } ?>><?php  echo $title; ?></option>
		<?php } ?>
      </select><br>
		<span style="font-size: 8pt;color:red;">(Required if this is a parent walkthrough page.<br>
If this is a level page, select NONE and assign a Parent page instead.)</span>
    </p>
	<p>
	<?php $levelcount = get_post_meta($ocmegames_stored_meta['walkthrough_relatedgame'][0], 'game_levelcount', 'single');
			if($levelcount == ""){
				$levelcount = 0;
			}
	?>
    <label for="walkthrough_level" class="row-title">Level #</label>
	  <input required class="textinput" type="number" min="1" name="walkthrough_level" id="walkthrough_level" value="<?php if ( isset ( $ocmegames_stored_meta['walkthrough_level'] ) ) echo $ocmegames_stored_meta['walkthrough_level'][0]; ?>" />
		<br>
		<span style="font-size: 8pt;color:red;">(If this is a parent page, enter the level count.<br>
				If this is a level page, enter the level number.)</span>
    </p>
	<?php if ( isset ( $ocmegames_stored_meta['walkthrough_relatedgame'] ) ){ ?>
	<p style="font-size: 8pt;">IMPORTANT:<br/><strong>
<i>Visit the your parent page and check that the correct "Level #" is set to make sure that all walkthrough levels will be displayed. If this is a level page, don't forget to set a parent!</i></p>
	<?php } ?>
	<!--
	<p>
    <label for="walkthrough_prevlink" class="row-title">Previous Link</label>
	  <input class="textinput" type="url" name="walkthrough_prevlink" id="walkthrough_prevlink" value="<?php if ( isset ( $ocmegames_stored_meta['walkthrough_prevlink'] ) ) echo $ocmegames_stored_meta['walkthrough_prevlink'][0]; ?>" />
    </p>
	<p>
    <label for="walkthrough_nextlink" class="row-title">Next Link</label>
	  <input class="textinput" type="url" name="walkthrough_nextlink" id="walkthrough_nextlink" value="<?php if ( isset ( $ocmegames_stored_meta['walkthrough_nextlink'] ) ) echo $ocmegames_stored_meta['walkthrough_nextlink'][0]; ?>" />
    </p>
	-->
	</div>
    <?php
  }


function ocmegames_addmetaboxes_walkthrough() {
    add_meta_box( 'ocmegames_meta_walkthrough', 'More Info', 'ocmegames_displaymetabox_walkthrough', 'walkthrough' , 'side', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_walkthrough' );

/* SAVE CUSTOM FIELDS */

function ocmegames_savemeta_walkthrough( $post_id, $post = false) {
 
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
		if( isset( $_POST[ 'walkthrough_relatedgame' ] ) ) {
			update_post_meta( $post_id, 'walkthrough_relatedgame', sanitize_text_field( $_POST[ 'walkthrough_relatedgame' ] ) );
		}
		
		if( isset( $_POST[ 'walkthrough_level' ] ) ) {
			
			if( isset ( $_POST[ 'parent_id' ] ) ) {
				
				$game_level = $_POST[ 'walkthrough_level' ];
				$args = array(
					'post_status' => 'publish',
					'post_type' => 'walkthrough',
					'post__not_in' => array($post_id),
					'post_parent' => $_POST[ 'parent_id' ],
					'meta_query' =>	array(
										array(
											'key'     => 'walkthrough_level',
											'value'   => $game_level,
											'compare' => 'LIKE',
										)));
				$myposts = get_posts( $args );
				$error = false;
				if(count($myposts) == 0){
					update_post_meta( $post_id, 'walkthrough_level', sanitize_text_field( $_POST[ 'walkthrough_level' ] ) );
				} else {
					add_option( 'ocmegames_errortext', '<b>ERROR</b>: Duplicate level - Level '.$game_level.' already exists. Please enter valid value. Previous value has been restored.' );
				}
				
			} else {
				update_post_meta( $post_id, 'walkthrough_level', sanitize_text_field( $_POST[ 'walkthrough_level' ] ) );
			}
		}
		
	}
    
}

function ocmegames_saveslug_walkthrough( $post_id ) {

		if( isset( $_POST[ 'parent_id' ] ) && $_POST[ 'parent_id' ] > 0 && $_POST[ 'parent_id' ] <> "" ) {
			
			$levelnum = get_post_meta($post_id, 'walkthrough_level', true);

			if($levelnum <> ''){

				// unhook this function to prevent infinite looping
				remove_action( 'save_post_walkthrough', 'ocmegames_saveslug_walkthrough' );

				$slug = "level-".$levelnum;

				wp_update_post( array(
						'ID' => $post_id,
						'post_name' => $slug
						));

				add_action( 'save_post_walkthrough', 'ocmegames_saveslug_walkthrough' );
			}
			
		} else {
			
			$game_id = get_post_meta($post_id, 'walkthrough_relatedgame', true);
	
			if($game_id <> ''){

				// unhook this function to prevent infinite looping
				remove_action( 'save_post_walkthrough', 'ocmegames_saveslug_walkthrough' );

				$game_obj = get_post($game_id);
				$slug = $game_obj->post_name;

				wp_update_post( array(
						'ID' => $post_id,
						'post_name' => $slug
						));

				add_action( 'save_post_walkthrough', 'ocmegames_saveslug_walkthrough' );
			}
			
		}
}

function ocmegames_savemeta_admin_notice() {
	if ( get_option('ocmegames_errortext') ) {
    ?>
    <div class="error">
        <p>
			<?php echo get_option('ocmegames_errortext'); ?>
		</p>
    </div>
    <?php
		 delete_option('ocmegames_errortext');
	}
}

add_action( 'save_post_walkthrough', 'ocmegames_savemeta_walkthrough' );
add_action( 'save_post_walkthrough', 'ocmegames_saveslug_walkthrough' );
add_action( 'admin_notices', 'ocmegames_savemeta_admin_notice' );

/* CUSTOM ADMIN COLUMNS */

function set_custom_edit_walkthrough_columns($columns) {
    $columns['relatedgame'] = "Related Game";
    $columns['level'] = "Level Number";
    return $columns;
}
function custom_walkthrough_column( $column, $post_id ) {
    switch ( $column ) {
        case 'relatedgame' :
			if( wp_get_post_parent_id( $post_id ) ) {
				echo '<span style="color: lightgray"> --- this is a level page</span>';
			} else {
				$gameID = get_post_meta($post_id, 'walkthrough_relatedgame', true);
				echo get_the_title($gameID); 
			}
            
            break;
        case 'level' :
			$level = get_post_meta( $post_id , 'walkthrough_level' , true );
			if( wp_get_post_parent_id( $post_id ) ) {
				echo '<span style="color: gray"> --- Level '.$level.'</span>';
			} else {
				echo 'Display: '.$level;
			}
            break;
    }
}

add_filter( 'manage_walkthrough_posts_columns', 'set_custom_edit_walkthrough_columns' );
add_action( 'manage_walkthrough_posts_custom_column' , 'custom_walkthrough_column', 10, 2 );

/* ARCHIVE QUERY TWEAK */

function walkthrough_archive_tweak( $query ) {  
	if($query->is_main_query() && is_post_type_archive('walkthrough' ) && !is_admin() ){  
   
		$relatedgame = get_query_var("relatedgame");
		$gameID = get_post_by_slug($relatedgame)->ID;
				
        // order post_type and remove pagination  
        $query->set('posts_per_page', -1); 
        $query->set('order', 'DESC'); 
		$query->set('meta_query', 
					array(
						array(
							'key'     => 'walkthrough_relatedgame',
							'value'   => $gameID,
							'compare' => 'LIKE',
						)));
    }  
}  
add_action( 'pre_get_posts', 'walkthrough_archive_tweak' );

/* SUPER USEFUL GET GAME INFO FUNCTION */

function get_the_walkthrough_info($id){
	
	$info = array();
	
	if( wp_get_post_parent_id( $id ) ) {
		$info['relatedgame'] = get_post_meta(wp_get_post_parent_id( $id ), 'walkthrough_relatedgame', true);
	} else {
		$info['relatedgame'] = get_post_meta($id, 'walkthrough_relatedgame', true);
	}
	
	$info['level'] = get_post_meta($id, 'walkthrough_level', true);
	
	$walkthroughs = get_the_walkthrough_levels($info['relatedgame']);
	while(key($walkthroughs) <> null && key($walkthroughs) <> $info['level']) {
		$prev_level = key($walkthroughs);
		next($walkthroughs);
	}
	next($walkthroughs); //advance to get next
	$next_level = key($walkthroughs);
	
	if($prev_level <> null){
		$info['prevlink'] = get_the_permalink($walkthroughs[$prev_level]);
	} else {
		$info['prevlink'] = "";
	}
	if($next_level <> null){
		$info['nextlink'] = get_the_permalink($walkthroughs[$next_level]);
	} else {
		$info['nextlink'] = "";
	}
		
	return $info;
}

/* CHECK THE GAME WALKTHROUGH PAGE */

function get_the_walkthrough_page($game_id){
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'walkthrough',
		'post_parent' => 0,
		'meta_key' =>	'walkthrough_relatedgame',
		'meta_value' => $game_id 
	);

	$posts = get_posts( $args );
	return $posts[0];
}

/* CHECK IF GAME HAS WALKTHROUGH */

function get_the_walkthrough_count($game_id){
	if(get_the_walkthrough_page($game_id)){
		$walkthrough_page = get_the_walkthrough_page($game_id);
		$args = array(
			'post_status' => 'publish',
			'post_type' => 'walkthrough',
			'post_parent' => $walkthrough_page->ID
		);
		$check = get_posts( $args );
		return count($check);
	} else {
		return 0;
	}
	
}


/* GET GAME WALKTHROUGHS */

function get_the_walkthrough_levels($game_id){
	if(get_the_walkthrough_page($game_id)){
		$walkthrough_page = get_the_walkthrough_page($game_id);
			
		$args = array(
			'post_status' => 'publish',
			'post_type' => 'walkthrough',
			'post_parent' => $walkthrough_page->ID,
			'posts_per_page' => -1
		);
			
		$myposts = get_posts( $args );
		foreach ( $myposts as $thepost ) :
			$levelnum = get_post_meta($thepost->ID, 'walkthrough_level', true);
			$walkthroughs[$levelnum] = $thepost->ID;
		endforeach; 
		ksort($walkthroughs);
		return $walkthroughs;
	} else {
		return false;
	}
}

?>