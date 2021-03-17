<?php

/**
 * Register download meta
 */
acf_add_local_field_group([
    'key' => 'product_videos',
    'title' => 'Videos',
    'fields' => [
        [
            'key' => 'video_url_key',
            'label' => 'Video URL',
            'name' => 'video_url',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
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
                'value' => 'video',
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
    'key' => 'video_information',
    'title' => 'Videos',
    'fields' => [
        [
            'key' => 'video_relation_key',
            'label' => 'Select a video',
            'name' => 'video_relation',
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
                0 => 'video',
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
