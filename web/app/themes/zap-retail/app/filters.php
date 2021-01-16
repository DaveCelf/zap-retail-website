<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

/*
 * Display simple UPC Field
 */
function add_upc_code() {

    global $woocommerce, $post;
    echo '<div class="form-field form-row form-row-full">';
        woocommerce_wp_text_input([
            'id'            => '_upc_code',
            'label'         => __( 'UPC', 'zap' ), 
            'placeholder'   => 'ZP8374560',
            'desc_tip'      => true,
            'description'   => __( 'Enter the UPC value here.', 'zap' ),
        ]);
    echo '</div>';

}
add_action( 'woocommerce_product_options_general_product_data', __NAMESPACE__.'\\add_upc_code');

/*
 * Save simple UPC Field
 */
function save_upc_code( $post_id ){
    $upcCode = $_POST['_upc_code'];
    if( !empty( $upcCode ) ) {
        update_post_meta( $post_id, '_upc_code', esc_html( $upcCode ) );
    }
}
add_action( 'woocommerce_process_product_meta', __NAMESPACE__.'\\save_upc_code' );

/*
 * Display variable UPC Field
 */
function add_upc_code_variation_custom_field( $loop, $variation_data, $variation ){

    $variation_upc_code = get_post_meta($variation->ID,'_upc_code', true );
    if( ! $variation_upc_code ) $variation_upc_code = '';

    echo '<div class="options_group form-row form-row-full">';
    woocommerce_wp_text_input([
        'id'          => '_upc_code['.$loop.']',
        'label'       => __('Variation UPC Code','woocommerce'),
        'placeholder' => 'ZP8374560',
        'desc_tip'    => true,
        'description' => __( 'Enter the UPC code here.', 'zap' ),
        'value'       => get_post_meta($variation->ID, '_upc_code', true ),
    ]);
    echo '</div>';
}
add_action( 'woocommerce_variation_options_pricing', __NAMESPACE__.'\\add_upc_code_variation_custom_field', 10, 3 );

/*
 * Save variable UPC Field
 */
function save_upc_code_variation_custom_field( $variation_id, $i ){
    if( isset($_POST['_upc_code'][$i]) )
        update_post_meta( $variation_id, '_upc_code', sanitize_text_field($_POST['_upc_code'][$i]) );
}
add_action( 'woocommerce_save_product_variation', __NAMESPACE__.'\\save_upc_code_variation_custom_field', 10, 2 );

/**
 * Add custom fields for variations
 *
*/
add_filter( 'woocommerce_available_variation', function($variations){
    $variations['upc_code'] = get_post_meta( $variations[ 'variation_id' ], '_upc_code', true );
    return $variations;
});

/*
 * Display Lead time
 */
function add_lead_time() {

    global $woocommerce, $post;
    echo '<div class="form-field form-row form-row-full">';
        woocommerce_wp_text_input([
            'id'            => '_lead_time',
            'label'         => __( 'Lead Time', 'zap' ), 
            'placeholder'   => '5 days',
            'desc_tip'      => true,
            'description'   => __( 'Enter the lead time here', 'zap' ),
        ]);
    echo '</div>';

}
add_action( 'woocommerce_product_options_inventory_product_data', __NAMESPACE__.'\\add_lead_time');

/*
 * Save Lead time
 */
function save_lead_code( $post_id ){
    $leadTime = $_POST['_lead_time'];
    if( !empty( $leadTime ) ) {
        update_post_meta( $post_id, '_lead_time', esc_html( $leadTime ) );
    }
}
add_action( 'woocommerce_process_product_meta', __NAMESPACE__.'\\save_lead_code' );

/*
 * Display min order
 */
function add_min_order_no() {

    global $woocommerce, $post;
    echo '<div class="form-field form-row form-row-full">';
        woocommerce_wp_text_input([
            'id'            => '_min_order_no',
            'label'         => __( 'Min. Order Number', 'zap' ), 
            'placeholder'   => 0,
            'desc_tip'      => true,
            'description'   => __( 'Enter the minimum quantity to order', 'zap' ),
            'type'          => 'number',
            'custom_attributes' => [
                'step'  => 'any',
                'min'   => '0'
            ]
        ]);
    echo '</div>';

}
add_action( 'woocommerce_product_options_inventory_product_data', __NAMESPACE__.'\\add_min_order_no');

/*
 * Save Min Order Number
 */
function save_min_order_no( $post_id ){
    $minOrderNo = $_POST['_min_order_no'];
    if( !empty( $minOrderNo ) ) {
        update_post_meta( $post_id, '_min_order_no', esc_html( $minOrderNo ) );
    }
}
add_action( 'woocommerce_process_product_meta', __NAMESPACE__.'\\save_min_order_no' );

/** 
 * Move SKU to underneath UPC
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 80 );

/**
 * Add Imagery underneath descritpion
 */
add_action('woocommerce_single_product_summary', function(){
    $html = '<div class="affiliate-logos">
        <img width="60" height="60" class="siesta-logo" src="'.asset_path('images/siesta.png').'" />
        <img width="120" height="60" class="catas-logo" src="'.asset_path('images/catas.png').'" />
        </div>';
    print $html;
}, 20);

/** 
 * Change single product page order
 * ADD TO CART / VARIATIONS
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 70 );

/**
 * Remove woo breadcrumbs on all pages
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/** 
 * Change single product page order
 * TABS
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );

/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', function($tabs) {

    unset( $tabs['description'] ); // Remove the description tab
    unset( $tabs['reviews'] ); // Remove the reviews tab
    return $tabs;

}, 98 );


/**
 * Add a Resources data tab
 */
add_filter( 'woocommerce_product_tabs', function ($tabs) {

    // Adds the new resource tab
    $tabs['resources'] = array(
        'title'     => __( 'Resources', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => function() {
            $resources = get_field('download_relation');
            if($resources) {
                echo '<div class="list-group">';
                foreach($resources as $resource) {
                    echo '<a target="_blank" class="px-0 d-flex justify-content-between list-group-item list-group-item-action" href="'.get_field('download_file', $resource)['url'].'">';
                        echo '<span class="resource-title-wrap">';
                            echo '<img class="mr-2" width="20px" height="auto" src="'.asset_path('images/document.svg').'" />';
                            echo get_field('download_title', $resource);
                        echo '</span>';
                        echo '<img width="20px" height="auto" src="'.asset_path('images/download-orange.svg').'" />';
                    echo '</a>';
                }
                echo '</div>';
            }
        }
    );

    return $tabs;
});

/**
 * Add swtaches to products archives
 */
add_action( 'woocommerce_product_meta_end', function() {
    if(get_field('product_set_items', get_the_ID())) {
        echo '<h4 class="h3 font-weight-bold pt-4 mb-3">Set Items</div>';
        foreach(get_field('product_set_items') as $productItem) { ?>
        <div class="row align-items-center">
            <div class="col-2">
                <?php echo get_the_post_thumbnail($productItem['product'], 'thumbnail', ['class' => 'img-fluid w-100']); ?>
            </div>
            <div class="col-2 text-center">
                <p class="h1 font-weight-bold">x<?php echo $productItem['num_of_items']; ?></p>
            </div>
            <div class="col-8 text-left">
                <h3 class="h5 font-weight-bold mb-0 pb-0">
                    <?php echo get_the_title($productItem['product']); ?>
                </h3>
                <?php if($productItem['product_sku']): ?>
                    <p><?php echo $productItem['product_sku']; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <hr />
        <?php }
    }
});

/**
 * Add swtaches to products archives
 */
add_action( 'woocommerce_after_shop_loop_item', function($product) {
    global $product;
    if($product->is_type( 'variable' )) {
        $variations = $product->get_available_variations();
        if($variations){
            echo '<ul class="swatch">';
            foreach($variations as $key => $value){
                $termID = get_term_by('slug', $value['attributes']['attribute_pa_color'], 'pa_color')->term_id;
                $swatchMeta = get_term_meta($termID);
                $swatchType = $swatchMeta['pa_color_swatches_id_type'][0];
                echo '<li class="swatch--wrapper">';
                if($swatchType == 'color') {
                    echo '<span class="swatch--color" style="background-color:'.$swatchMeta['pa_color_swatches_id_color'][0].';"></span>';
                } elseif($swatchType == 'photo') {
                    $photo = wp_get_attachment_image_src($swatchMeta['pa_color_swatches_id_photo'][0], 'thumbnail')[0];
                    echo '<img class="swatch--photo" src="'.$photo.'" width="150" height="150" />';
                }
                echo '</li>';
            }
            echo '</ul>';
        }
    }
});
