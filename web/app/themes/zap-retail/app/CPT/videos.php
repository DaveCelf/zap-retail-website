<?php
/**
 * Register videos
 *
 * @return void
 */
function register_videos_pt()
{
    $labels = [
        'name'                  => 'Videos',
        'singular_name'         => 'Video',
        'menu_name'             => 'Videos',
        'name_admin_bar'        => 'Videos',
        'archives'              => 'Video Archives',
        'attributes'            => 'Video Attributes',
        'parent_item_colon'     => 'Parent Video:',
        'all_items'             => 'All Videos',
        'add_new_item'          => 'Add New Video',
        'add_new'               => 'Add New',
        'new_item'              => 'New Video',
        'edit_item'             => 'Edit Video',
        'update_item'           => 'Update Video',
        'view_item'             => 'View Video',
        'view_items'            => 'View Videos',
        'search_items'          => 'Search Videos',
        'not_found'             => 'video Not found',
        'not_found_in_trash'    => 'video Not found in Trash',
        'featured_image'        => 'Featured video Image',
        'set_featured_image'    => 'Set video featured image',
        'remove_featured_image' => 'Remove Video featured image',
        'use_featured_image'    => 'Use as Video featured image',
        'insert_into_item'      => 'Insert into Video',
        'uploaded_to_this_item' => 'Uploaded to this video',
        'items_list'            => 'Videos list',
        'items_list_navigation' => 'Videos list navigation',
        'filter_items_list'     => 'Filter Videos list',
    ];
    $rewrite = [
        'slug'                  => 'video',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    ];
    $args = [
        'label'                 => 'Video',
        'description'           => 'Product videos',
        'labels'                => $labels,
        'supports'              => [ 'title' ],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-video',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => false,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
    ];
    register_post_type('video', $args);
}
add_action('init', 'register_videos_pt', 0);
