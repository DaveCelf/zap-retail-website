<?php 
acf_add_local_field_group([
    'key' => 'product_logos',
    'title' => 'Product Logos',
    'fields' => [
        [
            'key' => 'catas_logo',
            'label' => 'Enable Catas Logo',
            'name' => 'catas_logo',
            'type' => 'radio',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'hide_admin' => 0,
            'choices' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'allow_null' => 1,
            'other_choice' => 0,
            'default_value' => 'yes',
            'layout' => 'horizontal',
            'return_format' => 'value',
            'save_other_choice' => 0,
        ],
        [
            'key' => 'recycle_logo',
            'label' => 'Enable Recycle Logo',
            'name' => 'recycle_logo',
            'type' => 'radio',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'hide_admin' => 0,
            'choices' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'allow_null' => 1,
            'other_choice' => 0,
            'default_value' => 'yes',
            'layout' => 'horizontal',
            'return_format' => 'value',
            'save_other_choice' => 0,
        ],
        [
            'key' => 'siesta_logo',
            'label' => 'Enable Siesta Logo',
            'name' => 'siesta_logo',
            'type' => 'radio',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'hide_admin' => 0,
            'choices' => [
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'allow_null' => 1,
            'other_choice' => 0,
            'default_value' => 'yes',
            'layout' => 'horizontal',
            'return_format' => 'value',
            'save_other_choice' => 0,
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
    'active' => true,
    'description' => '',
]);

acf_add_local_field_group([
    'key' => '360_product_gallery',
    'title' => '360 Product Gallery',
    'fields' => [
        [
            'key' => '360_images',
            'label' => '360 Images',
            'name' => '360_images',
            'type' => 'gallery',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'return_format' => 'id',
            'preview_size' => 'medium',
            'insert' => 'prepend',
            'library' => 'all',
            'min' => '',
            'max' => '',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
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
    'active' => true,
    'description' => '',
]);

acf_add_local_field_group([
    'key' => 'product_banner',
    'title' => 'Product Banner',
    'fields' => [
        [
            'key' => 'product_slider',
            'label' => 'Product Slider Images',
            'name' => 'product_slider',
            'type' => 'gallery',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'return_format' => 'id',
            'preview_size' => 'medium',
            'insert' => 'prepend',
            'library' => 'all',
            'min' => '',
            'max' => '',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
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
    'active' => true,
    'description' => '',
]);

acf_add_local_field_group([
    'key' => 'product_sets',
    'title' => 'Product Sets',
    'fields' => [
        [
            'key' => 'product_set_items',
            'label' => 'Product Set Items',
            'name' => 'product_set_items',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'collapsed' => '',
            'min' => 0,
            'max' => 0,
            'layout' => 'table',
            'button_label' => '',
            'sub_fields' => [
                [
                    'key' => 'product',
                    'label' => 'Product',
                    'name' => 'product',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'post_type' => [
                        0 => 'product',
                    ],
                    'taxonomy' => '',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'id',
                    'ui' => 1,
                ],
                [
                    'key' => 'num_of_items',
                    'label' => '# of Items',
                    'name' => 'num_of_items',
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
                    'key' => 'product_sku',
                    'label' => 'SKU',
                    'name' => 'product_sku',
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
                    'key' => 'product_img',
                    'label' => 'Image',
                    'name' => 'product_img',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'hide_admin' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ],
            ],
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
    'active' => true,
    'description' => '',
]);
