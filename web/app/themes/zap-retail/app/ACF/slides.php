<?php

acf_add_local_field_group([
    'key' => 'sliders',
    'title' => 'sliders',
    'fields' => [
        [
            'key' => 'select_slide',
            'label' => 'Select Slide',
            'name' => 'select_slide',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'hide_admin' => 0,
            'post_type' => [
                0 => 'slide',
            ],
            'taxonomy' => '',
            'filters' => [
                0 => 'search',
            ],
            'elements' => '',
            'min' => '1',
            'max' => '',
            'return_format' => 'ID',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/slider',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
]);


/**
 * Register download meta
 */
acf_add_local_field_group([
    'key' => 'slide_meta',
    'title' => 'Slide Meta',
    'fields' => [
        [
            'key' => 'sub_header',
            'label' => 'Sub Header',
            'name' => 'sub_header',
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
            'key' => 'button_lbl',
            'label' => 'Button Label',
            'name' => 'button_lbl',
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
            'key' => 'button_url',
            'label' => 'Button URL',
            'name' => 'button_url',
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
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'slides',
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