<?php
/**
 * Register a custom post type called "Task".
 *
 * @see get_post_type_labels() for label keys.
 */
function taskbook_cpt_init() {
    $labels = array(
        'name'                  => _x( 'Tasks', 'Post type general name', 'taskbook' ),
        'singular_name'         => _x( 'Task', 'Post type singular name', 'taskbook' ),
        'menu_name'             => _x( 'Tasks', 'Admin Menu text', 'taskbook' ),
        'name_admin_bar'        => _x( 'Task', 'Add New on Toolbar', 'taskbook' ),
        'add_new'               => __( 'Add New', 'taskbook' ),
        'add_new_item'          => __( 'Add New Task', 'taskbook' ),
        'new_item'              => __( 'New Task', 'taskbook' ),
        'edit_item'             => __( 'Edit Task', 'taskbook' ),
        'view_item'             => __( 'View Task', 'taskbook' ),
        'all_items'             => __( 'All Tasks', 'taskbook' ),
        'search_items'          => __( 'Search Tasks', 'taskbook' ),
        'parent_item_colon'     => __( 'Parent Tasks:', 'taskbook' ),
        'not_found'             => __( 'No Tasks found.', 'taskbook' ),
        'not_found_in_trash'    => __( 'No Tasks found in Trash.', 'taskbook' ),
        'featured_image'        => _x( 'Task Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'taskbook' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'taskbook' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'taskbook' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'taskbook' ),
        'archives'              => _x( 'Task archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'taskbook' ),
        'insert_into_item'      => _x( 'Insert into Task', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'taskbook' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Task', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'taskbook' ),
        'filter_items_list'     => _x( 'Filter Tasks list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'taskbook' ),
        'items_list_navigation' => _x( 'Tasks list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'taskbook' ),
        'items_list'            => _x( 'Tasks list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'taskbook' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'tasks' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
		'show_in_rest'       => true,
		'rest_base'          => 'tasks',
        'menu_position'      => null,
		'menu_icon'          => 'dashicons-exerpt-view',
        'supports'           => array( 'title', 'editor', 'author' ),
        'map_meta_cap'       => true,
    );

    register_post_type( 'task', $args );
}

add_action( 'init', 'taskbook_cpt_init' );


function taskbook_rewite_flush(){
    taskbook_cpt_init();
    flush_rewrite_rules();
}