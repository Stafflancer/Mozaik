<?php
// Add ACF json
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

// Add ACF Page Options
if (function_exists('acf_add_options_page')) {
    // Add parent.
    $parent = acf_add_options_page(array(
        'page_title'  => __('Theme Options'),
        'menu_title'  => __('Theme Options'),
        'redirect'    => true,
    ));

    // Add sub page.
    $child = acf_add_options_page(array(
        'page_title'  => __('General Settings'),
        'menu_title'  => __('General Settings'),
        'parent_slug' => $parent['menu_slug'],
    ));

    // Add sub page.
    $child = acf_add_options_page(array(
        'page_title'  => __('Header Settings'),
        'menu_title'  => __('Header Settings'),
        'parent_slug' => $parent['menu_slug'],
    ));

    // Add sub page.
    $child = acf_add_options_page(array(
        'page_title'  => __('Footer Settings'),
        'menu_title'  => __('Footer Settings'),
        'parent_slug' => $parent['menu_slug'],
    ));

    // Add sub page.
    $child = acf_add_options_page(array(
        'page_title'  => __('Single Customer Story page'),
        'menu_title'  => __('Single Customer Story page'),
        'parent_slug' => $parent['menu_slug'],
    ));
}