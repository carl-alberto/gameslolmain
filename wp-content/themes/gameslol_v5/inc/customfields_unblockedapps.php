<?php 

// Register Custom Post Type

function unblockedapps_post_type(){

	$labels = array(
		'name'                  => _x( 'Unblocked Apps', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Unblocked App', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Unblocked Apps', 'text_domain' ),
		'name_admin_bar'        => __( 'Unblocked App', 'text_domain' ),
		'archives'              => __( 'Unblocked App Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent:', 'text_domain' ),
		'all_items'             => __( 'All Unblocked Apps', 'text_domain' ),
		'add_new_item'          => __( 'Add New Unblocked App', 'text_domain' ),
		'add_new'               => __( 'Add Unblocked App', 'text_domain' ),
		'new_item'              => __( 'New Unblocked App', 'text_domain' ),
		'edit_item'             => __( 'Edit Unblocked App', 'text_domain' ),
		'update_item'           => __( 'Update Unblocked App', 'text_domain' ),
		'view_item'             => __( 'View Unblocked App', 'text_domain' ),
		'view_items'            => __( 'View Unblocked Apps', 'text_domain' ),
		'search_items'          => __( 'Search Unblocked Apps', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Unblocked App Icon', 'text_domain' ),
		'set_featured_image'    => __( 'Set Unblocked App icon', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Unblocked App icon', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Unblocked App icon', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Unblocked App', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Unblocked App', 'text_domain' ),
		'items_list'            => __( 'Unblocked App list', 'text_domain' ),
		'items_list_navigation' => __( 'Unblocked App list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Unblocked Apps list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'app',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Unblocked App', 'text_domain' ),
		'description'           => __( 'Unblocked Apps', 'text_domain' ),
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
	//	'taxonomies'  			=> array( 'category', 'post_tag' ),
	);
	register_post_type( 'unblockedapp', $args );

}

// Register Custom Taxonomy
function unblockedapps_taxonomy() {

	$labels = array(
		'name'                       => _x( 'App Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'App Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'App Categories', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New App Category', 'text_domain' ),
		'add_new_item'               => __( 'Add New App Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit App Category', 'text_domain' ),
		'update_item'                => __( 'Update App Category', 'text_domain' ),
		'view_item'                  => __( 'View App Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Categories', 'text_domain' ),
		'search_items'               => __( 'Search Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No categries', 'text_domain' ),
		'items_list'                 => __( 'Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'apps',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'app_category', array( 'unblockedapp' ), $args );

}

add_action( 'init', 'unblockedapps_post_type', 0 );
add_action( 'init', 'unblockedapps_taxonomy', 0 );

/* ADD METABOXES */

function ocmegames_addmetaboxes_unblockedapp() {
	add_meta_box( 'ocmegames_meta_unblockedapps', 'More App Info', 'ocmegames_displaymetabox', 'unblockedapp' , 'side', 'high' );
    add_meta_box( 'ocmegames_images_unblockedapps', 'App Images', 'ocmegames_displayimagesbox', 'unblockedapp' , 'advanced', 'high' );
}

add_action( 'add_meta_boxes', 'ocmegames_addmetaboxes_unblockedapp' );

/* SAVE CUSTOM FIELDS */

add_action( 'save_post_unblockedapp', 'ocmegames_savemeta' );

?>