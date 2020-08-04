<?php 

// Register Custom Post Type

function unblockedgames_post_type(){

	$labels = array(
		'name'                  => _x( 'Unblocked Games', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Unblocked Game', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Unblocked Games', 'text_domain' ),
		'name_admin_bar'        => __( 'Unblocked Game', 'text_domain' ),
		'archives'              => __( 'Unblocked Game Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent:', 'text_domain' ),
		'all_items'             => __( 'All Unblocked Games', 'text_domain' ),
		'add_new_item'          => __( 'Add New Unblocked Game', 'text_domain' ),
		'add_new'               => __( 'Add Unblocked Game', 'text_domain' ),
		'new_item'              => __( 'New Unblocked Game', 'text_domain' ),
		'edit_item'             => __( 'Edit Unblocked Game', 'text_domain' ),
		'update_item'           => __( 'Update Unblocked Game', 'text_domain' ),
		'view_item'             => __( 'View Unblocked Game', 'text_domain' ),
		'view_items'            => __( 'View Unblocked Games', 'text_domain' ),
		'search_items'          => __( 'Search Unblocked Games', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Unblocked Game Icon', 'text_domain' ),
		'set_featured_image'    => __( 'Set Unblocked Game icon', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Unblocked Game icon', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Unblocked Game icon', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Unblocked Game', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Unblocked Game', 'text_domain' ),
		'items_list'            => __( 'Unblocked Game list', 'text_domain' ),
		'items_list_navigation' => __( 'Unblocked Game list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Unblocked Games list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'android',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Unblocked Game', 'text_domain' ),
		'description'           => __( 'Unblocked Games', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-universal-access-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'taxonomies'  			=> array( 'category', 'post_tag' ),
	);
	register_post_type( 'unblockedgame', $args );

}

add_action( 'init', 'unblockedgames_post_type', 0 );

/* ADD METABOXES */

function ocmegames_addmetaboxes_unblockedgame() {
	add_meta_box( 'ocmegames_meta_unblockedgames', 'More Game Info', 'ocmegames_displaymetabox', 'unblockedgame' , 'side', 'high' );
    add_meta_box( 'ocmegames_images_unblockedgames', 'Game Images', 'ocmegames_displayimagesbox', 'unblockedgame' , 'advanced', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_unblockedgame' );

/* SAVE CUSTOM FIELDS */

add_action( 'save_post_unblockedgame', 'ocmegames_savemeta' );

?>