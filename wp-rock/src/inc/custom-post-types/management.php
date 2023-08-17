<?php
/**
 * Custom post type management
 *
 * @package WP-rock
 * @since 4.4.0
 */

$labels = array(
    'name' => _x( 'Owners and management', 'Post type general name', 'wp-rock' ),
    'singular_name' => _x( 'Person', 'Post type singular name', 'wp-rock' ),
    'menu_name' => _x( 'Owners and management', 'Admin Menu text', 'wp-rock' ),
    'name_admin_bar' => _x( 'Owners and management', 'Add New on Toolbar', 'wp-rock' ),
    'add_new' => __( 'Add New', 'wp-rock' ),
    'add_new_item' => __( 'Add New Person', 'wp-rock' ),
    'new_item' => __( 'New Person', 'wp-rock' ),
    'edit_item' => __( 'Edit Person', 'wp-rock' ),
    'view_item' => __( 'View Person', 'wp-rock' ),
    'all_items' => __( 'All Persons', 'wp-rock' ),
    'search_items' => __( 'Search Persons', 'wp-rock' ),
    'parent_item_colon' => __( 'Parent Person:', 'wp-rock' ),
    'not_found' => __( 'No books found.', 'wp-rock' ),
    'not_found_in_trash' => __( 'No books found in Trash.', 'wp-rock' ),
    'featured_image' => _x( 'Person Cover Image(recommended image size 335x506px)', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'set_featured_image' => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'use_featured_image' => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'archives' => _x( 'Owners and management archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'wp-rock' ),
    'insert_into_item' => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'wp-rock' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'wp-rock' ),
    'filter_items_list' => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'wp-rock' ),
    'items_list_navigation' => _x( 'Owners and management list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'wp-rock' ),
    'items_list' => _x( 'Owners and management list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'wp-rock' ),
);
$args   = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'menu_icon' => 'dashicons-businessperson',
    'menu_position' => 8,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'management' ),
    'capability_type' => 'post',
    'show_in_rest' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'supports' => array( 'title', 'thumbnail', 'author' ),
);

register_post_type( 'management', $args );

