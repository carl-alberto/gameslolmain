<?php 

// Register Custom Post Type

function minigames_post_type(){

	$labels = array(
		'name'                  => _x( 'Mini Games', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Mini Game', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Mini Games', 'text_domain' ),
		'name_admin_bar'        => __( 'Mini Game', 'text_domain' ),
		'archives'              => __( 'Mini Game Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent:', 'text_domain' ),
		'all_items'             => __( 'All Mini Games', 'text_domain' ),
		'add_new_item'          => __( 'Add New Mini Game', 'text_domain' ),
		'add_new'               => __( 'Add Mini Game', 'text_domain' ),
		'new_item'              => __( 'New Mini Game', 'text_domain' ),
		'edit_item'             => __( 'Edit Mini Game', 'text_domain' ),
		'update_item'           => __( 'Update Mini Game', 'text_domain' ),
		'view_item'             => __( 'View Mini Game', 'text_domain' ),
		'view_items'            => __( 'View Mini Games', 'text_domain' ),
		'search_items'          => __( 'Search Mini Games', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Mini Game Icon', 'text_domain' ),
		'set_featured_image'    => __( 'Set mini game icon', 'text_domain' ),
		'remove_featured_image' => __( 'Remove mini game icon', 'text_domain' ),
		'use_featured_image'    => __( 'Use as mini game icon', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Mini Game', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Mini Game', 'text_domain' ),
		'items_list'            => __( 'Mini Game list', 'text_domain' ),
		'items_list_navigation' => __( 'Mini Game list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter mini games list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'mini-game',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Mini Game', 'text_domain' ),
		'description'           => __( 'Mini games', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-universal-access',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'mini-games',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'minigame', $args );

}

// Register Custom Taxonomy
function minigames_tag() {

	$labels = array(
		'name'                       => _x( 'Mini Game Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Mini Game Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Mini Game Tags', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Mini Game Tag', 'text_domain' ),
		'add_new_item'               => __( 'Add New Mini Game Tag', 'text_domain' ),
		'edit_item'                  => __( 'Edit Mini Game Tag', 'text_domain' ),
		'update_item'                => __( 'Update Mini Game Tag', 'text_domain' ),
		'view_item'                  => __( 'View Mini Game Tag', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Tags', 'text_domain' ),
		'search_items'               => __( 'Search Tags', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No tags', 'text_domain' ),
		'items_list'                 => __( 'Tags list', 'text_domain' ),
		'items_list_navigation'      => __( 'Tags list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'mini-games',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'minigame_tag', array( 'minigame' ), $args );

}

add_action( 'init', 'minigames_post_type', 0 );
add_action( 'init', 'minigames_tag', 0 );

/* ADD METABOXES */

function ocmegames_addmetaboxes_minigame() {
    add_meta_box( 'ocmegames_meta_minigame', 'More Game Info', 'ocmegames_displaymetabox_minigame', 'minigame' , 'side', 'high' );
    add_meta_box( 'ocmegames_images_minigame', 'Mini Game Images', 'ocmegames_displayimagesbox_minigame', 'minigame' , 'advanced', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_minigame' );

/* DISPLAY NEW BOXES */

function ocmegames_displaymetabox_minigame( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	
    ?>
 	<div id="new_meta">
    <p>
    <label for="game_customh1" class="row-title">Custom H1 Title</label>
	  <input class="textinput" type="text" name="game_customh1" id="game_customh1" value="<?php if ( isset ( $ocmegames_stored_meta['game_customh1'] ) ) echo $ocmegames_stored_meta['game_customh1'][0]; ?>" />
    </p>
    <p>
    <label for="game_developer" class="row-title">Game Developer</label>
	  <input class="textinput" type="text" name="game_developer" id="game_developer" value="<?php if ( isset ( $ocmegames_stored_meta['game_developer'] ) ) echo $ocmegames_stored_meta['game_developer'][0]; ?>" />
    </p>
    <p>
    <label for="game_link" class="row-title">Game Embed Code Info</label>
		<select name="game_embed_src" id="game_embed_src" style="width: 100%;" required>
			<option value="">Game Source</option>
			<option value="softgames" <?php if( $ocmegames_stored_meta['game_embed_src'][0] == "softgames"){ echo 'selected'; } ?> > Softgames (Game Name &amp; ID required)</option>
			<option value="gamepix" <?php if( $ocmegames_stored_meta['game_embed_src'][0] == "gamepix"){ echo 'selected'; } ?> > Gamepix (Game ID required)</option>
			<option value="gamedistribution" <?php if( $ocmegames_stored_meta['game_embed_src'][0] == "gamedistribution"){ echo 'selected'; } ?> > Game Distribution (Game ID required)</option>
		</select>
	  <input class="textinput" type="text" name="game_embed_name" id="game_embed_name" placeholder="Game Name (e.g. flappy-bird)" value="<?php if ( isset ( $ocmegames_stored_meta['game_embed_name'] ) ) echo $ocmegames_stored_meta['game_embed_name'][0]; ?>" />
	  <input class="textinput" type="text" name="game_embed_id" id="game_embed_id" placeholder="Game ID (e.g. 569347)" value="<?php if ( isset ( $ocmegames_stored_meta['game_embed_id'] ) ) echo $ocmegames_stored_meta['game_embed_id'][0]; ?>" /><br>
		
    </p>
    <p>
    <label for="game_videoheader" class="row-title">Video Header URL</label><br/>
    	(Leave blank to use image-only header)
	  <input class="textinput" type="url" name="game_videoheader" id="game_videoheader" value="<?php if ( isset ( $ocmegames_stored_meta['game_videoheader'] ) ) echo $ocmegames_stored_meta['game_videoheader'][0]; ?>" />
    </p>
	</div>
    <?php
  }

function ocmegames_displayimagesbox_minigame( $post ) {
	
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	
    ?>
 	<div id="new_images">
   <div>
        <label for="game_thumbnail"  class="row-title" >Logo Thumbnail</label>
        <img class="gameinfo-preview game_thumbnail" src="<?php if ( isset ( $ocmegames_stored_meta['game_thumbnail'] ) ){ echo $ocmegames_stored_meta['game_thumbnail'][0]; } ?>" />
        <input type="hidden" name="game_thumbnail" id="game_thumbnail" class="game_thumbnail" value="<?php if ( isset ( $ocmegames_stored_meta['game_thumbnail'] ) ){ echo $ocmegames_stored_meta['game_thumbnail'][0]; } ?>" />
        <input type="button" id="game_thumbnail_button" data-metaname="game_thumbnail" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_thumbnail">Remove Image</a>
    </div>
    <div>
        <label for="game_banner" class="row-title" >Banner/Wallpaper (Page Header)</label>
        <img class="gameinfo-preview game_banner" src="<?php if ( isset ( $ocmegames_stored_meta['game_banner'] ) ){ echo $ocmegames_stored_meta['game_banner'][0]; } ?>" />
        <input type="hidden" name="game_banner" id="game_banner" class="game_banner" value="<?php if ( isset ( $ocmegames_stored_meta['game_banner'] ) ){ echo $ocmegames_stored_meta['game_banner'][0]; } ?>" />
        <input type="button" id="game_banner_button" data-metaname="game_banner" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_banner">Remove Image</a>
    </div>
    <div>
        <label for="game_floatingbutton" class="row-title" >Logo / Floating Button</label>
        <img class="gameinfo-preview game_floatingbutton" src="<?php if ( isset ( $ocmegames_stored_meta['game_floatingbutton'] ) ){ echo $ocmegames_stored_meta['game_floatingbutton'][0]; } ?>" />
        <input type="hidden" name="game_floatingbutton" id="game_floatingbutton" class="game_floatingbutton" value="<?php if ( isset ( $ocmegames_stored_meta['game_floatingbutton'] ) ){ echo $ocmegames_stored_meta['game_floatingbutton'][0]; } ?>" />
        <input type="button" id="game_floatingbutton_button" data-metaname="game_floatingbutton" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_floatingbutton">Remove Image</a>
    </div>
     <script>
		 jQuery('.gameinfo_remove').click(function() {
			 
			metaname = jQuery(this).data("metaname");
				
			jQuery('input#'+metaname).val('');
			jQuery('img.gameinfo-preview.'+metaname).attr('src','');
			 return false;
			 
		});
		  
		jQuery('.gameinfo_button').click(function() {
			
			metaname = jQuery(this).data("metaname");
			var send_attachment_bkp = wp.media.editor.send.attachment;

			wp.media.editor.send.attachment = function(props, attachment) {

			jQuery('input#'+metaname).val(attachment.url);
			jQuery('img.gameinfo-preview.'+metaname).attr('src',attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
				
			}

			wp.media.editor.open();

			return false;
		});
	 </script>
	</div>
    <?php
}

/* SAVE CUSTOM FIELDS */

function ocmegames_savemeta_minigame( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ocmegames_nonce' ] ) && wp_verify_nonce( $_POST[ 'ocmegames_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'game_customh1' ] ) ) {
        update_post_meta( $post_id, 'game_customh1', sanitize_text_field( $_POST[ 'game_customh1' ] ) );
	}
    if( isset( $_POST[ 'game_embed_src' ] ) ) {
        update_post_meta( $post_id, 'game_embed_src', sanitize_text_field( $_POST[ 'game_embed_src' ] ) );
	}
    if( isset( $_POST[ 'game_embed_name' ] ) ) {
        update_post_meta( $post_id, 'game_embed_name', sanitize_text_field( $_POST[ 'game_embed_name' ] ) );
	}
    if( isset( $_POST[ 'game_embed_id' ] ) ) {
        update_post_meta( $post_id, 'game_embed_id', sanitize_text_field( $_POST[ 'game_embed_id' ] ) );
	}
    if( isset( $_POST[ 'game_developer' ] ) ) {
        update_post_meta( $post_id, 'game_developer', sanitize_text_field( $_POST[ 'game_developer' ] ) );
	}
    if( isset( $_POST[ 'game_videoheader' ] ) ) {
        update_post_meta( $post_id, 'game_videoheader', sanitize_text_field( $_POST[ 'game_videoheader' ] ) );
	}
 	if( isset( $_POST[ 'game_banner' ] ) ) {
        update_post_meta( $post_id, 'game_banner', $_POST[ 'game_banner' ] );
    }
 	if( isset( $_POST[ 'game_floatingbutton' ] ) ) {
        update_post_meta( $post_id, 'game_floatingbutton', $_POST[ 'game_floatingbutton' ] );
    }
 	if( isset( $_POST[ 'game_thumbnail' ] ) ) {
        update_post_meta( $post_id, 'game_thumbnail', $_POST[ 'game_thumbnail' ] );
    }
}

add_action( 'save_post_minigame', 'ocmegames_savemeta_minigame' );

/* SUPER USEFUL GET GAME INFO FUNCTION */

function get_the_minigame_info($id){
	
	$game_info = array();
	
	/* Mandatory Images + Captions */
	$game_info['banner'] = get_post_meta($id, 'game_banner', true);
	$game_info['banner_alt'] = get_the_title($id)." Free to Play";
	 
	$game_info['icon'] = get_the_post_thumbnail_url($id);
	$game_info['icon_alt'] = get_the_title($id)." Best PC Games";
	
	$game_info['thumbnail'] = get_post_meta($id, 'game_thumbnail', true);
	$game_info['thumbnail_alt'] = get_the_title($id)." Play for Free";
	
	$game_info['floatingbutton'] = get_post_meta($id, 'game_floatingbutton', true);
	$game_info['floatingbutton_alt'] = get_the_title($id)." Play Free Games on Gameslol";
	
	/* Stats */
	$game_info['views'] = get_post_meta($id, 'game_views', true);
	$game_info['downloads'] = get_post_meta($id, 'game_downloads', true);
	$game_rating = ocmegames_get_game_rating($id, 'post');
	$game_info['rating'] = number_format((float)$game_rating['average'], 1, '.', '');
	$game_info['ratingCount'] = $game_rating['reviewsCount'];
	
	/* More Info */
	$game_info['customh1'] = get_post_meta($id, 'game_customh1', true);
	$game_info['link'] = get_post_meta($id, 'game_link', true);
	$game_info['embed_src'] = get_post_meta($id, 'game_embed_src', true);
	$game_info['embed_name'] = get_post_meta($id, 'game_embed_name', true);
	$game_info['embed_id'] = get_post_meta($id, 'game_embed_id', true);
	$game_info['developer'] = get_post_meta($id, 'game_developer', true);
	$game_info['header_video'] = get_post_meta($id, 'game_videoheader', true);
	
	/* Player Link */
	
	$game_info['player'] = get_the_minigame_player_url($id);
	
	/* Is New */
	$game_info['is_new'] = has_term('new-mini-games', 'minigame_tag', $id );
	
	return $game_info;
}

function get_the_minigame_player_url($post_id){
	
	$my_post = get_post($post_id);
	$slug = $my_post->post_name;
	$url = site_url().'/mini-game/play/'.$slug;
	return $url;
}

?>