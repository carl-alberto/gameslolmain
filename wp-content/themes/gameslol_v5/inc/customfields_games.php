<?php 

/* CHANGE MENU LABELS */
/* POST ---> GAMES */

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Games';
    $submenu['edit.php'][5][0] = 'Games';
    $submenu['edit.php'][10][0] = 'Add Games';
    $submenu['edit.php'][15][0] = 'Game Categories'; // Change name for categories
    $submenu['edit.php'][16][0] = 'Game Tags'; // Change name for tags
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'All Games';
        $labels->singular_name = 'Game';
        $labels->add_new = 'Add Game';
        $labels->add_new_item = 'Add Game';
        $labels->edit_item = 'Edit Game';
        $labels->new_item = 'Game';
        $labels->view_item = 'View Game';
        $labels->search_items = 'Search Games';
        $labels->not_found = 'No Games found';
        $labels->not_found_in_trash = 'No Games found in Trash';
		$labels->featured_image = 'Game Icon';
		$labels->set_featured_image = 'Set Game Icon';
		$labels->remove_featured_image = 'Remove Game Icon';
		$labels->use_featured_image = 'Use as Game Icon';
    }

function replace_admin_menu_icons_css() {
    ?>
    <style>
        .dashicons-admin-post:before {
			content: "\f507";
		}
    </style>
    <?php
}

add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
add_action( 'admin_head', 'replace_admin_menu_icons_css' );

/* ADD METABOXES */

function ocmegames_addmetaboxes() {
    add_meta_box( 'ocmegames_meta', 'More Game Info', 'ocmegames_displaymetabox', 'post' , 'side', 'high' );
    add_meta_box( 'ocmegames_images', 'Game Images', 'ocmegames_displayimagesbox', 'post' , 'advanced', 'high' );
    add_meta_box( 'ocmegames_screenshots', 'Game Screenshots', 'ocmegames_displayscreenshotbox', 'post' , 'advanced', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes' );

/* DISPLAY NEW BOXES */

function ocmegames_displaymetabox( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	$show_all = ( get_post_type($post) == 'post' ) ;
    ?>
 	<div id="new_meta">
    <p>
    <label for="game_customh1" class="row-title">Custom H1 Title</label>
	  <input class="textinput" type="text" name="game_customh1" id="game_customh1" value="<?php if ( isset ( $ocmegames_stored_meta['game_customh1'] ) ) echo $ocmegames_stored_meta['game_customh1'][0]; ?>" />
    </p>
    <p>
    <label for="game_developer" class="row-title">Developer</label>
	  <input class="textinput" type="text" name="game_developer" id="game_developer" value="<?php if ( isset ( $ocmegames_stored_meta['game_developer'] ) ) echo $ocmegames_stored_meta['game_developer'][0]; ?>" />
    </p>
    <p>
    <label for="game_rating" class="row-title">Rating (Stars)</label>
	  <input class="textinput" type="number" min="1" max="5" step="0.1" name="game_rating" id="game_rating" value="<?php if ( isset ( $ocmegames_stored_meta['game_rating'] ) ) echo $ocmegames_stored_meta['game_rating'][0]; ?>" />
    </p>
    <p>
    <label for="game_ratingcount" class="row-title">Custom Review Count</label>
	  <input class="textinput" type="number" min="1" step="1" name="game_ratingcount" id="game_ratingcount" value="<?php if ( isset ( $ocmegames_stored_meta['game_ratingcount'] ) ) echo $ocmegames_stored_meta['game_ratingcount'][0]; ?>" />
    </p>
    <p>
    <label for="game_link" class="row-title">Download Link (Windows)</label>
	  <input class="textinput" type="url" name="game_link" id="game_link" value="<?php if ( isset ( $ocmegames_stored_meta['game_link'] ) ) echo $ocmegames_stored_meta['game_link'][0]; ?>" />
    </p>
    <p>
    <label for="game_link_mac" class="row-title">Download Link (Mac)</label>
	  <input class="textinput" type="url" name="game_link_mac" id="game_link_mac" value="<?php if ( isset ( $ocmegames_stored_meta['game_link_mac'] ) ) echo $ocmegames_stored_meta['game_link_mac'][0]; ?>" />
    </p>
    <p>
    <label for="game_link_apk" class="row-title">Download Link (Android)</label>
	  <input class="textinput" type="url" name="game_link_apk" id="game_link_apk" value="<?php if ( isset ( $ocmegames_stored_meta['game_link_apk'] ) ) echo $ocmegames_stored_meta['game_link_apk'][0]; ?>" />
    </p>
    <p>
    <label for="game_app_id" class="row-title">App ID</label>
      <input required class="textinput" type="text" name="game_app_id" id="game_app_id" value="<?php if ( isset ( $ocmegames_stored_meta['game_app_id'] ) ) echo $ocmegames_stored_meta['game_app_id'][0]; ?>" />
    </p>
    <p>
    <label for="game_video" class="row-title">Video URL</label>
	  <input class="textinput" type="url" name="game_video" id="game_video" value="<?php if ( isset ( $ocmegames_stored_meta['game_video'] ) ) echo $ocmegames_stored_meta['game_video'][0]; ?>" />
		</p>
	<?php if($show_all) { ?>
    <p><b>Use Custom Page Template?</b></p>
    <p>
    <?php if ( isset ( $ocmegames_stored_meta['game_template'] ) ){ $select = $ocmegames_stored_meta['game_template'][0]; }  ?>
    <label for="game_template" class="row-title">Page Template</label>
      <select id="game_template" name="game_template">
      	<option value="Default" <?php if($select == '' | $select == 'Default') echo 'selected'; ?>>Use Default</option>
      	<option value="Template 1"  <?php if($select == 'Template 1') echo 'selected'; ?>>Template 1</option>
      	<option value="Template 2"  <?php if($select == 'Template 2') echo 'selected'; ?>>Template 2</option>
      </select>
    </p>
    <p>
	  <input type="checkbox" name="game_flip" id="game_flip" value="true" <?php if ( isset($ocmegames_stored_meta['game_flip']) && $ocmegames_stored_meta['game_flip'][0] == "true" ) echo "checked"; ?> /> <label for="game_flip"><strong>Flip images?</strong></label>
	</p>
    <p>
    <label for="game_videoheader" class="row-title">Video Header URL</label>
	  <input class="textinput" type="url" name="game_videoheader" id="game_videoheader" value="<?php if ( isset ( $ocmegames_stored_meta['game_videoheader'] ) ) echo $ocmegames_stored_meta['game_videoheader'][0]; ?>" />
    </p>
	<?php } ?>
	</div>
    <?php
  }

function ocmegames_displayimagesbox( $post ) {
	
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
	
    $ocmegames_stored_meta = get_post_meta( $post->ID );
	$show_all = ( get_post_type($post) == 'post' ) ;
	
    ?>
 	<div id="new_images">
	<?php if($show_all) { ?>
   <div>
        <label for="game_thumbnail"  class="row-title" >Logo Thumbnail</label>
        <img class="gameinfo-preview game_thumbnail" src="<?php if ( isset ( $ocmegames_stored_meta['game_thumbnail'] ) ){ echo $ocmegames_stored_meta['game_thumbnail'][0]; } ?>" />
        <input type="hidden" name="game_thumbnail" id="game_thumbnail" class="game_thumbnail" value="<?php if ( isset ( $ocmegames_stored_meta['game_thumbnail'] ) ){ echo $ocmegames_stored_meta['game_thumbnail'][0]; } ?>" />
        <input type="button" id="game_thumbnail_button" data-metaname="game_thumbnail" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_thumbnail">Remove Image</a>
    </div>
	<?php } ?>
    <div>
        <label for="game_banner" class="row-title" >Banner/Wallpaper (Page Header)</label>
        <img class="gameinfo-preview game_banner" src="<?php if ( isset ( $ocmegames_stored_meta['game_banner'] ) ){ echo $ocmegames_stored_meta['game_banner'][0]; } ?>" />
        <input type="hidden" name="game_banner" id="game_banner" class="game_banner" value="<?php if ( isset ( $ocmegames_stored_meta['game_banner'] ) ){ echo $ocmegames_stored_meta['game_banner'][0]; } ?>" />
        <input type="button" id="game_banner_button" data-metaname="game_banner" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_banner">Remove Image</a>
    </div>
    <div>
        <label for="game_floatingbutton" class="row-title" >Floating Button</label>
        <img class="gameinfo-preview game_floatingbutton" src="<?php if ( isset ( $ocmegames_stored_meta['game_floatingbutton'] ) ){ echo $ocmegames_stored_meta['game_floatingbutton'][0]; } ?>" />
        <input type="hidden" name="game_floatingbutton" id="game_floatingbutton" class="game_floatingbutton" value="<?php if ( isset ( $ocmegames_stored_meta['game_floatingbutton'] ) ){ echo $ocmegames_stored_meta['game_floatingbutton'][0]; } ?>" />
        <input type="button" id="game_floatingbutton_button" data-metaname="game_floatingbutton" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_floatingbutton">Remove Image</a>
    </div>
	<?php if($show_all) { ?>
    <div>
        <label for="game_smallicon" class="row-title" >Small Icon</label>
        <img class="gameinfo-preview game_smallicon" src="<?php if ( isset ( $ocmegames_stored_meta['game_smallicon'] ) ){ echo $ocmegames_stored_meta['game_smallicon'][0]; } ?>" />
        <input type="hidden" name="game_smallicon" id="game_smallicon" class="game_smallicon" value="<?php if ( isset ( $ocmegames_stored_meta['game_smallicon'] ) ){ echo $ocmegames_stored_meta['game_smallicon'][0]; } ?>" />
        <input type="button" id="game_smallicon_button" data-metaname="game_smallicon" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="game_smallicon">Remove Image</a>
    </div>
	<?php } ?>
	</div>
    <?php
}

// SLIDER
function ocmegames_displayscreenshotbox( $post ) {
    
    wp_nonce_field( basename( __FILE__ ), 'ocmegames_nonce' );
    
    $ocmegames_stored_meta = get_post_meta( $post->ID );
    $show_all = ( get_post_type($post) == 'post' ) ;
    
    ?>
    <div id="new_slider_images">
    <?php if($show_all) { ?>
   <div>
        <label for="screenshot_1"  class="row-title" >Screenshot 1</label>
        <img class="gameinfo-preview screenshot_1" src="<?php if ( isset ( $ocmegames_stored_meta['screenshot_1'] ) ){ echo $ocmegames_stored_meta['screenshot_1'][0]; } ?>" />
        <input type="hidden" name="screenshot_1" id="screenshot_1" class="screenshot_1" value="<?php if ( isset ( $ocmegames_stored_meta['screenshot_1'] ) ){ echo $ocmegames_stored_meta['screenshot_1'][0]; } ?>" />
        <input type="button" id="screenshot_1_button" data-metaname="screenshot_1" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="screenshot_1">Remove Image</a>
    </div>
   <div>
        <label for="screenshot_2"  class="row-title" >Screenshot 2</label>
        <img class="gameinfo-preview screenshot_2" src="<?php if ( isset ( $ocmegames_stored_meta['screenshot_2'] ) ){ echo $ocmegames_stored_meta['screenshot_2'][0]; } ?>" />
        <input type="hidden" name="screenshot_2" id="screenshot_2" class="screenshot_2" value="<?php if ( isset ( $ocmegames_stored_meta['screenshot_2'] ) ){ echo $ocmegames_stored_meta['screenshot_2'][0]; } ?>" />
        <input type="button" id="screenshot_2_button" data-metaname="screenshot_2" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="screenshot_2">Remove Image</a>
    </div>
   <div>
        <label for="screenshot_3"  class="row-title" >Screenshot 3</label>
        <img class="gameinfo-preview screenshot_3" src="<?php if ( isset ( $ocmegames_stored_meta['screenshot_3'] ) ){ echo $ocmegames_stored_meta['screenshot_3'][0]; } ?>" />
        <input type="hidden" name="screenshot_3" id="screenshot_3" class="screenshot_3" value="<?php if ( isset ( $ocmegames_stored_meta['screenshot_3'] ) ){ echo $ocmegames_stored_meta['screenshot_3'][0]; } ?>" />
        <input type="button" id="screenshot_3_button" data-metaname="screenshot_3" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="screenshot_3">Remove Image</a>
    </div>
   <div>
        <label for="screenshot_4"  class="row-title" >Screenshot 4</label>
        <img class="gameinfo-preview screenshot_4" src="<?php if ( isset ( $ocmegames_stored_meta['screenshot_4'] ) ){ echo $ocmegames_stored_meta['screenshot_4'][0]; } ?>" />
        <input type="hidden" name="screenshot_4" id="screenshot_4" class="screenshot_4" value="<?php if ( isset ( $ocmegames_stored_meta['screenshot_4'] ) ){ echo $ocmegames_stored_meta['screenshot_4'][0]; } ?>" />
        <input type="button" id="screenshot_4_button" data-metaname="screenshot_4" class="gameinfo_button button" value="Choose or Upload an Image" /><br/>
        <a class="gameinfo_remove" style="margin: 5px;" data-metaname="screenshot_4">Remove Image</a>
    </div>
    <?php } ?>
    </div>


    <?php
}

/* SAVE CUSTOM FIELDS */

function ocmegames_savemeta( $post_id ) {
 
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
    if( isset( $_POST[ 'game_rating' ] ) ) {
        update_post_meta( $post_id, 'game_rating', sanitize_text_field( $_POST[ 'game_rating' ] ) );
	}
    if( isset( $_POST[ 'game_ratingcount' ] ) ) {
        update_post_meta( $post_id, 'game_ratingcount', sanitize_text_field( $_POST[ 'game_ratingcount' ] ) );
	}
    if( isset( $_POST[ 'game_link' ] ) ) {
        update_post_meta( $post_id, 'game_link', sanitize_text_field( $_POST[ 'game_link' ] ) );
	}
    if( isset( $_POST[ 'game_link_mac' ] ) ) {
        update_post_meta( $post_id, 'game_link_mac', sanitize_text_field( $_POST[ 'game_link_mac' ] ) );
	}
    if( isset( $_POST[ 'game_link_apk' ] ) ) {
        update_post_meta( $post_id, 'game_link_apk', sanitize_text_field( $_POST[ 'game_link_apk' ] ) );
	}
    if( isset( $_POST[ 'game_app_id' ] ) ) {
        update_post_meta( $post_id, 'game_app_id', sanitize_text_field( $_POST[ 'game_app_id' ] ) );
    }
    if( isset( $_POST[ 'game_video' ] ) ) {
        update_post_meta( $post_id, 'game_video', sanitize_text_field( $_POST[ 'game_video' ] ) );
	}
    if( isset( $_POST[ 'game_developer' ] ) ) {
        update_post_meta( $post_id, 'game_developer', sanitize_text_field( $_POST[ 'game_developer' ] ) );
	}
    if( isset( $_POST[ 'game_template' ] ) ) {
        update_post_meta( $post_id, 'game_template', sanitize_text_field( $_POST[ 'game_template' ] ) );
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
 	if( isset( $_POST[ 'game_smallicon' ] ) ) {
        update_post_meta( $post_id, 'game_smallicon', $_POST[ 'game_smallicon' ] );
    }
 	if( isset( $_POST[ 'screenshot_1' ] ) ) {
        update_post_meta( $post_id, 'screenshot_1', $_POST[ 'screenshot_1' ] );
    }
 	if( isset( $_POST[ 'screenshot_2' ] ) ) {
        update_post_meta( $post_id, 'screenshot_2', $_POST[ 'screenshot_2' ] );
    }
    if( isset( $_POST[ 'screenshot_3' ] ) ) {
        update_post_meta( $post_id, 'screenshot_3', $_POST[ 'screenshot_3' ] );
    }
    if( isset( $_POST[ 'screenshot_4' ] ) ) {
        update_post_meta( $post_id, 'screenshot_4', $_POST[ 'screenshot_4' ] );
    }
 	if( isset( $_POST[ 'game_review_title' ] ) ) {
        update_post_meta( $post_id, 'game_review_title', $_POST[ 'game_review_title' ] );
    }
 	if( isset( $_POST[ 'game_review_content' ] ) ) {
        update_post_meta( $post_id, 'game_review_content', $_POST[ 'game_review_content' ] );
    }
 	if( isset( $_POST[ 'game_review_source' ] ) ) {
        update_post_meta( $post_id, 'game_review_source', $_POST[ 'game_review_source' ] );
    }
  	if( isset( $_POST[ 'game_flip' ] ) && $_POST[ 'game_flip' ] == "true" ) {
        update_post_meta( $post_id, 'game_flip', 'true' );
    } else {
        update_post_meta( $post_id, 'game_flip', 'false' );
	}
}

add_action( 'save_post', 'ocmegames_savemeta' );

/* SUPER USEFUL GET GAME INFO FUNCTION */

function get_the_game_info($id){
	
	$game_info = array();
	
	/* Mandatory Images + Captions */
	$game_info['banner'] = get_post_meta($id, 'game_banner', true);
	if($game_info['banner'] == ""){
		if( get_post_type($id) == "unblockedapp" ){
			$game_info['banner'] = get_theme_mod('default_banner_app');
		} else {
			$game_info['banner'] = get_theme_mod('default_banner');
		}
	}
	$game_info['banner_alt'] = get_the_title($id)." Free PC Download";
	 
	$game_info['icon'] = get_the_post_thumbnail_url($id);
	$game_info['icon_sm'] = get_post_meta($id, 'game_smallicon', true);
	$game_info['icon_alt'] = get_the_title($id)." Best PC Games";
	
	$game_info['thumbnail'] = get_post_meta($id, 'game_thumbnail', true);
	$game_info['thumbnail_alt'] = get_the_title($id)." Free Full Version";
	
	$game_info['floatingbutton'] = get_post_meta($id, 'game_floatingbutton', true);
	$game_info['floatingbutton_alt'] = get_the_title($id)." Download Free PC Games on Gameslol";
	
	/* Stats */
	$game_info['views'] = get_post_meta($id, 'game_views', true);
	$game_info['downloads'] = get_post_meta($id, 'game_downloads', true);
		
	$game_rating = ocmegames_get_game_rating($id, 'post');
	$rating = get_post_meta($id, 'game_rating', true);
	$game_info['rating'] = number_format((float)$rating, 1, '.', '');
		if($game_info['rating'] == 0){
				$game_info['rating'] = number_format((float)$game_rating['average'], 1, '.', '');
		}
	$game_info['ratingCount'] = get_post_meta($id, 'game_ratingcount', true);
		if($game_info['ratingCount'] == 0){
				$game_info['ratingCount'] = $game_rating['reviewsCount'];
		}
	
	/* More Info */
	$game_info['customh1'] = get_post_meta($id, 'game_customh1', true);
	$game_info['levels'] = get_post_meta($id, 'game_levelcount', true);
    $game_info['app_id'] = get_post_meta($id, 'game_app_id', true);
	
	$game_info['link'] = get_post_meta($id, 'game_link', true);
	
	if($game_info['link'] == ""){
		if ($game_info['app_id'] <> ""){
			$new_windows_link = "https://setup.games.lol/api/renexe?filename=".get_the_title($id)."_".$game_info['app_id']."_gameslolc.exe&url=https%3A%2F%2Fmbdl219.com%2FEmulatorInstaller%2FGameslolinstaller.exe";
			$game_info['link'] = $new_windows_link;
		}
	}
	
	$game_info['link_mac'] = get_post_meta($id, 'game_link_mac', true);
	$game_info['link_apk'] = get_post_meta($id, 'game_link_apk', true);
	
    /*
	if($game_info['link_apk'] <> "") { 
		$explodelink =  explode ( '/', $game_info['link']);
		$appid = $explodelink[4];
		$mobile_link = 'https://d1x9snl812q4nd.cloudfront.net/PlayStore/apk/'.$appid.'.apk';
		$game_info['link_apk'] = $mobile_link;
	}
    */
		
	$game_info['video'] = get_post_meta($id, 'game_video', true);
	$game_info['developer'] = get_post_meta($id, 'game_developer', true);
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $game_info['video'], $matches);
    $game_info['video_id'] = $matches[1];
	$game_info['video_embedcode'] = '<iframe src="https://www.youtube.com/embed/'.$game_info['video_id'].'?rel=0&autoplay=1&feature=youtu.be" width="853" height="505" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	
	
	$game_info['template'] = get_post_meta($id, 'game_template', true);
	$game_info['header_video'] = get_post_meta($id, 'game_videoheader', true);
	
	/* Reviews */
	$game_info['review_title'] = get_post_meta($id, 'game_review_title', true);
		if($game_info['review_title'] == ''){
			$game_info['review_title'] = get_the_title($id)." Review";
		}
	$game_info['review_content'] = htmlspecialchars_decode(get_post_meta($id, 'game_review_content', true));
		$game_info['review_excerpt'] = strip_tags($game_info['review_content']);
	$game_info['review_excerpt'] = substr($game_info['review_excerpt'], 0 , 200) . '...';
	$game_info['review_source'] = get_post_meta($id, 'game_review_source', true);
	
	/* Screenshots */
	$game_info['screenshot'] = array(get_post_meta($id, 'screenshot_1', true),
									get_post_meta($id, 'screenshot_2', true),
                                    get_post_meta($id, 'screenshot_3', true),
									get_post_meta($id, 'screenshot_4', true));
	
	/* Is New */
	$game_info['is_new'] = has_tag('new-releases', $id);
	
   /* Is Flipped */
	$game_info['flipped'] = (get_post_meta($id, 'game_flip', true) == "true") ? "flipped" : "";
  
	return $game_info;
}

/* CUSTOM IMAGE SIZE HELLO */

add_image_size( 'mini-gameicon', 80, 80, true ); // width, height, crop
add_filter( 'image_size_names_choose', 'game_customthumbnail' );
function game_customthumbnail( $sizes ) {
    return array_merge( $sizes, array(
        'mini-gameicon' => __( 'Game Sidebar Icon' ),
    ) );
}


/********************************************
/************ CHECK IF GAME IS NEW **********
/********************************************/ 

function ocmegame_isNew( $postID , $by ) {
		
	if( $by == 'tag' ){
		
		return has_tag('new-releases', $postID);
		
	} elseif ( $by == 'date' ) {
		$postDate = get_the_date('U', $postID);
		$today = date('U');
	
		$diff = ($today - $postDate);
		$days = floor( $diff / (60*60*24) );
		
		if ( $days <= 7 ) { return true; }
		else { return false; }
		
	} else {
		return false;
	}
	
}


?>