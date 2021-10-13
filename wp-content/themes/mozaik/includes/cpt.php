<?php
function register_custom_post_types() {
    $labels = array(
        'name' => 'Subpage',
        'singular_name' => 'Subpage',
        'add_new' => 'Add subpage',
        'add_new_item' => 'Add subpage',
        'edit_item' => 'Edit subpage',
        'new_item' => 'New subpage',
        'all_items' => 'All subpages',
        'menu_name' => 'Subpage'
    );
    $args = array(
        'labels' => $labels,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'menu_icon' => 'dashicons-networking',
        'menu_position' => 20,
        'has_archive' => true,
        'supports' => array( 'title', 'thumbnail', 'excerpt' )
    );
    register_post_type('subpage', $args);
}
add_action( 'init', 'register_custom_post_types' );