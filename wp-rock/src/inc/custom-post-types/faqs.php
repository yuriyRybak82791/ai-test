<?php
/**
 * Custom post type faqs
 *
 * @package WP-rock
 * @since 4.4.0
 */

$labels = array(
    'name' => _x( 'FAQs', 'Post type general name', 'wp-rock' ),
    'singular_name' => _x( 'Question', 'Post type singular name', 'wp-rock' ),
    'menu_name' => _x( 'FAQs', 'Admin Menu text', 'wp-rock' ),
    'name_admin_bar' => _x( 'FAQs', 'Add New on Toolbar', 'wp-rock' ),
    'add_new' => __( 'Add New', 'wp-rock' ),
    'add_new_item' => __( 'Add New Question', 'wp-rock' ),
    'new_item' => __( 'New Question', 'wp-rock' ),
    'edit_item' => __( 'Edit Question', 'wp-rock' ),
    'view_item' => __( 'View Question', 'wp-rock' ),
    'all_items' => __( 'All Questions', 'wp-rock' ),
    'search_items' => __( 'Search Questions', 'wp-rock' ),
    'parent_item_colon' => __( 'Parent Question:', 'wp-rock' ),
    'not_found' => __( 'No books found.', 'wp-rock' ),
    'not_found_in_trash' => __( 'No books found in Trash.', 'wp-rock' ),
    'featured_image' => _x( 'Question Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'set_featured_image' => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'use_featured_image' => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'wp-rock' ),
    'archives' => _x( 'FAQs archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'wp-rock' ),
    'insert_into_item' => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'wp-rock' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'wp-rock' ),
    'filter_items_list' => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'wp-rock' ),
    'items_list_navigation' => _x( 'FAQs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'wp-rock' ),
    'items_list' => _x( 'FAQs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'wp-rock' ),
);
$args   = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'menu_icon' => 'dashicons-editor-ul',
    'menu_position' => 6,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'faqs' ),
    'capability_type' => 'post',
    'show_in_rest' => true,
    'has_archive' => false,
    'hierarchical' => false,
    'supports' => array( 'title', 'editor', 'author' ),
);

register_post_type( 'faqs', $args );

