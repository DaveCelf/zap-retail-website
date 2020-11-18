<?php
/**
 * Register downloads
 *
 * @return void
 */
function register_downloads_pt()
{
    $labels = [
        'name'                  => 'Downloads',
        'singular_name'         => 'Download',
        'menu_name'             => 'Downloads',
        'name_admin_bar'        => 'Downloads',
        'archives'              => 'Download Archives',
        'attributes'            => 'Download Attributes',
        'parent_item_colon'     => 'Parent Download:',
        'all_items'             => 'All Downloads',
        'add_new_item'          => 'Add New Download',
        'add_new'               => 'Add New',
        'new_item'              => 'New Download',
        'edit_item'             => 'Edit Download',
        'update_item'           => 'Update Download',
        'view_item'             => 'View Download',
        'view_items'            => 'View Downloads',
        'search_items'          => 'Search Downloads',
        'not_found'             => 'Download Not found',
        'not_found_in_trash'    => 'Download Not found in Trash',
        'featured_image'        => 'Featured Download Image',
        'set_featured_image'    => 'Set Download featured image',
        'remove_featured_image' => 'Remove Download featured image',
        'use_featured_image'    => 'Use as Download featured image',
        'insert_into_item'      => 'Insert into Download',
        'uploaded_to_this_item' => 'Uploaded to this Download',
        'items_list'            => 'Downloads list',
        'items_list_navigation' => 'Downloads list navigation',
        'filter_items_list'     => 'Filter Downloads list',
    ];
    $rewrite = [
        'slug'                  => 'downloads',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    ];
    $args = [
        'label'                 => 'Download',
        'description'           => 'Product Downloads',
        'labels'                => $labels,
        'supports'              => [ 'title' ],
        'taxonomies'            => [ 'download-type' ],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-download',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'downloads',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
    ];
    register_post_type('downloads', $args);
}
add_action('init', 'register_downloads_pt', 0);