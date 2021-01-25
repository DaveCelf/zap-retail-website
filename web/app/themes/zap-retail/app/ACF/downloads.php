<?php
/**
 * Register download meta
 */
acf_add_local_field_group([
    'key' => 'product_downloads',
    'title' => 'Downloads',
    'fields' => [
        [
            'key' => 'download_title',
            'label' => 'Display Title',
            'name' => 'download_title',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ],
        [
            'key' => 'download_file',
            'label' => 'Download File',
            'name' => 'download_file',
            'type' => 'file',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'return_format' => 'array',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => '',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'downloads',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
]);

/**
 * Resgister download for products
*/
acf_add_local_field_group([
    'key' => 'downloads_information',
    'title' => 'Downloads',
    'fields' => [
        [
            'key' => 'download_relation',
            'label' => 'Select a download',
            'name' => 'download_relation',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'post_type' => [
                0 => 'downloads',
            ],
            'taxonomy' => [
            ],
            'filters' => [
                0 => 'search'
            ],
            'elements' => '',
            'min' => '',
            'max' => '',
            'return_format' => 'id',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'product',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
]);


