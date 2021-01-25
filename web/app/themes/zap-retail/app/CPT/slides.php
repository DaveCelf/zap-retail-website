<?php
/**
 * Register slides
 *
 * @return void
 */
function register_slides_pt()
{
    $labels = [
        'name'                  => 'slides',
        'singular_name'         => 'slide',
        'menu_name'             => 'slides',
        'name_admin_bar'        => 'slides',
        'archives'              => 'slide Archives',
        'attributes'            => 'slide Attributes',
        'parent_item_colon'     => 'Parent slide:',
        'all_items'             => 'All slides',
        'add_new_item'          => 'Add New slide',
        'add_new'               => 'Add New',
        'new_item'              => 'New slide',
        'edit_item'             => 'Edit slide',
        'update_item'           => 'Update slide',
        'view_item'             => 'View slide',
        'view_items'            => 'View slides',
        'search_items'          => 'Search slides',
        'not_found'             => 'slide Not found',
        'not_found_in_trash'    => 'slide Not found in Trash',
        'featured_image'        => 'Featured slide Image',
        'set_featured_image'    => 'Set slide featured image',
        'remove_featured_image' => 'Remove slide featured image',
        'use_featured_image'    => 'Use as slide featured image',
        'insert_into_item'      => 'Insert into slide',
        'uploaded_to_this_item' => 'Uploaded to this slide',
        'items_list'            => 'slides list',
        'items_list_navigation' => 'slides list navigation',
        'filter_items_list'     => 'Filter slides list',
    ];
    $rewrite = [
        'slug'                  => 'slides',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    ];
    $args = [
        'label'                 => 'slide',
        'description'           => 'Slides',
        'labels'                => $labels,
        'supports'              => [ 'title', 'thumbnail' ],
        'taxonomies'            => [ 'slide-type' ],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-slide',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'slides',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
    ];
    register_post_type('slides', $args);
}
add_action('init', 'register_slides_pt', 0);