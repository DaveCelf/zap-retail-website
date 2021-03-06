<?php

namespace App;

use WP_User;

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
function add_upc_code()
{
    global $woocommerce, $post;
    echo '<div class="form-field form-row form-row-full">';
    woocommerce_wp_text_input([
            'id'            => '_upc_code',
            'label'         => __('EAN', 'zap'),
            'placeholder'   => 'ZP8374560',
            'desc_tip'      => true,
            'description'   => __('Enter the EAN value here.', 'zap'),
        ]);
    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', __NAMESPACE__.'\\add_upc_code');

/*
 * Save simple UPC Field
 */
function save_upc_code($post_id)
{
    $upcCode = $_POST['_upc_code'];
    update_post_meta($post_id, '_upc_code', esc_html($upcCode));
}
add_action('woocommerce_process_product_meta', __NAMESPACE__.'\\save_upc_code');

/*
 * Display variable UPC Field
 */
function add_upc_code_variation_custom_field($loop, $variation_data, $variation)
{
    $variation_upc_code = get_post_meta($variation->ID, '_upc_code', true);
    if (! $variation_upc_code) {
        $variation_upc_code = '';
    }

    echo '<div class="options_group form-row form-row-full">';
    woocommerce_wp_text_input([
        'id'          => '_upc_code['.$loop.']',
        'label'       => __('Variation EAN Code', 'woocommerce'),
        'placeholder' => 'ZP8374560',
        'desc_tip'    => true,
        'description' => __('Enter the EAN code here.', 'zap'),
        'value'       => get_post_meta($variation->ID, '_upc_code', true),
    ]);
    echo '</div>';
}
add_action('woocommerce_variation_options_pricing', __NAMESPACE__.'\\add_upc_code_variation_custom_field', 10, 3);

/*
 * Save variable UPC Field
 */
function save_upc_code_variation_custom_field($variation_id, $i)
{
    if (isset($_POST['_upc_code'][$i])) {
        update_post_meta($variation_id, '_upc_code', sanitize_text_field($_POST['_upc_code'][$i]));
    }
}
add_action('woocommerce_save_product_variation', __NAMESPACE__.'\\save_upc_code_variation_custom_field', 10, 2);

/**
 * Add custom fields for variations
 *
*/
add_filter('woocommerce_available_variation', function ($variations) {
    $variations['upc_code'] = get_post_meta($variations[ 'variation_id' ], '_upc_code', true);
    return $variations;
});

/*
 * Display Lead time
 */
function add_lead_time()
{
    global $woocommerce, $post;
    echo '<div class="form-field form-row form-row-full">';
    woocommerce_wp_text_input([
            'id'            => '_lead_time',
            'label'         => __('Lead Time', 'zap'),
            'placeholder'   => '5 days',
            'desc_tip'      => true,
            'description'   => __('Enter the lead time here', 'zap'),
        ]);
    echo '</div>';
}
add_action('woocommerce_product_options_inventory_product_data', __NAMESPACE__.'\\add_lead_time');

/*
 * Save Lead time
 */
function save_lead_code($post_id)
{
    $leadTime = $_POST['_lead_time'];
    update_post_meta($post_id, '_lead_time', esc_html($leadTime));
}
add_action('woocommerce_process_product_meta', __NAMESPACE__.'\\save_lead_code');

/*
 * Display min order
 */
function add_min_order_no()
{
    global $woocommerce, $post;
    echo '<div class="form-field form-row form-row-full">';
    woocommerce_wp_text_input([
            'id'            => '_min_order_no',
            'label'         => __('Min. Order Number', 'zap'),
            'placeholder'   => 0,
            'desc_tip'      => true,
            'description'   => __('Enter the minimum quantity to order', 'zap'),
            'type'          => 'number',
            'custom_attributes' => [
                'step'  => 'any',
                'min'   => '0'
            ]
        ]);
    echo '</div>';
}
add_action('woocommerce_product_options_inventory_product_data', __NAMESPACE__.'\\add_min_order_no');

/*
 * Save Min Order Number
 */
function save_min_order_no($post_id)
{
    $minOrderNo = $_POST['_min_order_no'];
    if (!empty($minOrderNo)) {
        update_post_meta($post_id, '_min_order_no', esc_html($minOrderNo));
    }
}
add_action('woocommerce_process_product_meta', __NAMESPACE__.'\\save_min_order_no');

/**
 * Move SKU to underneath UPC
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_before_add_to_cart_form', 'woocommerce_template_single_meta', 30);

/**
 * Add Imagery underneath descritpion
 */
add_action('woocommerce_before_add_to_cart_form', function () {
    $siestaLogo = get_field('siesta_logo');
    $catasLogo = get_field('catas_logo');
    $recycleLogo = get_field('recycle_logo');

    echo '<div class="w-100 affiliate-logos mb-3">';
    if ($siestaLogo == 'yes') {
        echo '<img width="60" height="60" class="siesta-logo" src="'.asset_path('images/siesta.png').'" />';
    }
    if ($catasLogo == 'yes') {
        echo '<img width="120" height="60" class="catas-logo" src="'.asset_path('images/catas.png').'" />';
    }
    if ($recycleLogo == 'yes') {
        echo '<img width="120" height="60" class="catas-logo" src="'.asset_path('images/recycle.svg').'" />';
    }
    
    echo '</div>';
}, 20);

/**
 * Remove woo breadcrumbs on all pages
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/**
 * Change single product page order
 * TABS
 */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_after_add_to_cart_form', 'woocommerce_output_product_data_tabs', 10);

/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['description']); // Remove the description tab
    unset($tabs['reviews']); // Remove the reviews tab
    return $tabs;
}, 98);


/**
 * Add a Resources data tab
 */
add_filter('woocommerce_product_tabs', function ($tabs) {
    // Adds the new resource tab
    $tabs['resources'] = array(
        'title'     => __('Resources', 'woocommerce'),
        'priority'  => 50,
        'callback'  => function () {
            $resources = get_field('download_relation');
            if ($resources) {
                echo '<div class="list-group">';
                foreach ($resources as $resource) {
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
 * Add video tab
 */
add_filter('woocommerce_product_tabs', function ($tabs) {
    // Adds the new resource tab

    $videos = get_field('video_relation');

    if ($videos) {
        $tabs['video'] = array(
            'title'     => __('Videos and Guides', 'woocommerce'),
            'priority'  => 50,
            'callback'  => function () {
                $videos = get_field('video_relation');
                echo '<div class="list-group">';
                foreach ($videos as $video) {
                    echo '<a target="_blank" class="px-0 d-flex justify-content-between list-group-item list-group-item-action" href="'.get_field('video_url', $video).'">';
                    echo '<span class="resource-title-wrap">';
                    echo '<img class="mr-2" width="20px" height="auto" src="'.asset_path('images/youtube.svg').'" />';
                    echo get_the_title($video);
                    echo '</span>';
                    echo '<img width="20px" height="auto" src="'.asset_path('images/download-orange.svg').'" />';
                    echo '</a>';
                }
                echo '</div>';
            }
        );
    }

    return $tabs;
});

/**
 * Add set items
 */
add_action('woocommerce_after_add_to_cart_form', function () {
    if (get_field('product_set_items', get_the_ID())) {
        echo '<div class="w-100">';
        echo '<h4 class="h3 font-weight-bold pt-4 mb-3">Set Items</div>';
        foreach (get_field('product_set_items') as $productItem) { ?>
        <div class="row align-items-center">
            <div class="col-2">
                <img src="<?php echo $productItem['product_img']['sizes']['woocommerce_thumbnail']; ?>" width="300" height="300" class="img-fluid w-100" />
            </div>
            <div class="col-2 text-center">
                <p class="h1 font-weight-bold">x<?php echo $productItem['num_of_items']; ?></p>
            </div>
            <div class="col-8 text-left">
                <h3 class="h5 font-weight-bold mb-0 pb-0">
                    <?php echo get_the_title($productItem['product']); ?>
                </h3>
                <?php if ($productItem['product_sku']): ?>
                    <p><?php echo $productItem['product_sku']; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <hr />
        <?php }
        echo '</div>';
    }
}, 50);

/**
 * Add swtaches to products archives
 */
add_action('woocommerce_after_shop_loop_item', function ($product) {
    global $product;
    if ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        if ($variations) {
            echo '<ul class="swatch">';
            foreach ($variations as $key => $value) {
                $termID = get_term_by('slug', $value['attributes']['attribute_pa_color'], 'pa_color')->term_id;
                $swatchMeta = get_term_meta($termID);
                $swatchType = $swatchMeta['pa_color_swatches_id_type'][0];
                echo '<li class="swatch--wrapper">';
                if ($swatchType == 'color') {
                    echo '<span class="swatch--color" style="background-color:'.$swatchMeta['pa_color_swatches_id_color'][0].';"></span>';
                } elseif ($swatchType == 'photo') {
                    $photo = wp_get_attachment_image_src($swatchMeta['pa_color_swatches_id_photo'][0], 'thumbnail')[0];
                    echo '<img class="swatch--photo" src="'.$photo.'" width="150" height="150" />';
                }
                echo '</li>';
            }
            echo '</ul>';
        }
    }
});

/**
 * Change shop toproducts page
 */
add_action('template_redirect', function () {
    if (is_shop()) {
        wp_redirect(home_url('/products'));
        exit();
    }
});

/**
 * Reformat the dimension display
 */
add_filter('woocommerce_format_dimensions', function ($dimension_string, $dimensions) {
    if (empty($dimension_string)) {
        return __('N/A', 'woocommerce');
    }
    $dimensions = array_filter(array_map('wc_format_localized_decimal', $dimensions));

    return 'Depth: '.$dimensions['length'].get_option('woocommerce_dimension_unit').' Width: '.$dimensions['width'].get_option('woocommerce_dimension_unit').' Height: '.$dimensions['height'].get_option('woocommerce_dimension_unit');
}, 10, 2);

/**
 * Hide Price & Add to Cart for Logged Out Users
 * Show VAT Switcher
 */
add_action('init', function () {
    if (! is_user_logged_in()) {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
        add_action('woocommerce_single_product_summary', __NAMESPACE__.'\\set_login_price', 10);
        add_action('woocommerce_after_shop_loop_item', __NAMESPACE__.'\\set_login_price', 11);
    } else {
        add_action('woocommerce_single_product_summary', __NAMESPACE__.'\\display_lead_time_fe', 10, 3);
        add_action('woocommerce_single_product_summary', __NAMESPACE__.'\\add_vat_switch', 10, 2);
    }
});

/**
 * Add Lead Time underneath descritpion
 */
function display_lead_time_fe()
{
    $leadTime = get_post_meta(get_the_ID(), '_lead_time', true);
    //only show lead tim if it has been filled out
    if (!$leadTime) {
        echo '<p class="text--orange"><strong>In stock for quick delivery</strong></p>';
    } else {
        echo '<p class="text--orange"><strong>Lead time '.$leadTime.'</strong></p>';
    }
};

/**
 * Add plugin shortcode for VAT Switcher
 *
 * @return void
 */
function add_vat_switch()
{
    echo '<div class="pb-2">';
    echo do_shortcode('[wc_show_tax including_label="Click here to show price Including VAT" excluding_label="Click here to show price Excluding VAT"]');
    echo '</div>';
};


/**
 * Set login for prices
 *
 * @return String
 */
function set_login_price() { ?>
    <div class="alert alert-warning mt-3" role="alert">
        Please 
        <a class="font-weight-bold" href="<?php echo get_home_url(null, '/register'); ?>">
            register</a> or 
        </a>
        <a class="font-weight-bold" href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>">
            login 
        </a>
        to view product prices
    </div>
<?php }

/**
 * Change account menu items
 */
add_filter('woocommerce_account_menu_items', function ($menu_links) {
    unset($menu_links['edit-address']); // Addresses
    unset($menu_links['dashboard']); // Remove Dashboard
    unset($menu_links['payment-methods']); // Remove Payment Methods
    unset($menu_links['orders']); // Remove Orders
    unset($menu_links['downloads']); // Disable Downloads

    return $menu_links;
});

/**
 * Woocommerce Login redirect
 */
add_filter('woocommerce_login_redirect', function ($redirect, $user) {
    // Get the first of all the roles assigned to the user
    $role = $user->roles[0];

    $dashboard = admin_url();
    $myaccount = get_permalink(wc_get_page_id('myaccount')).'/edit-account';

    if ($role == 'customer' || $role == 'subscriber') {
        //Redirect customers and subscribers to the "My Account" page
        $redirect = $myaccount;
    }

    return $redirect;
}, 10, 2);

/**
 * Change Sender Email
 *
 * @param String $original_email_address
 * @return void
 */
add_filter('wp_mail_from', function ($original_email_address) {
    return 'noreply@zap-retail.com';
});

/**
 * Function to change sender name
 *
 * @param String $original_email_from
 * @return void
 */
add_filter('wp_mail_from_name', function ($original_email_from) {
    return 'Zap Retail';
});

/** Remove defaut register user email */
remove_action('register_new_user', 'wp_send_new_user_notifications');
remove_action('edit_user_created_user', 'wp_send_new_user_notifications', 10, 2);

/** Add new user email message **/
function new_user_registration_email($user_id)
{
    $userData = new WP_User($user_id);
    $userEmail = stripslashes($userData->user_email);
    $resetKey = get_password_reset_key($userData);
    $to = $userEmail;
    $userLogin = $userData->user_login;
    $headers = 'From: ZAP Retail <noreply@zap-retail.com>';
    $subject = 'Your registration is complete.';
    $siteUrl = get_home_url();
    $name = $userData->first_name;
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    ob_start();
    include(__DIR__ . DIRECTORY_SEPARATOR . '/Emails/new-user-registration.php');
    $message = ob_get_contents();
    ob_end_clean();
    
    wp_mail($to, $subject, $message, $headers);
};
add_action('edit_user_created_user', __NAMESPACE__.'\\new_user_registration_email', 10, 1);

function login_styling() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo asset_path('images/zap-retail-logo.svg'); ?>)  !important;
            height: 56px;
            width: 130px;
            background-size: 130px 56px;
            background-repeat: no-repeat;
        }
        form {
            border: 0 none !important;
            box-shadow: none !important;
            background: #f1f1f1 !important;
        }
        .login form .input, .login input[type="text"], .login input[type="password"] {
            border-radius: 0 !important;
            border: 0 none !important;
            background: #ffffff !important;
        }
        .login .message {
            border-left: 4px solid #cd9925 !important;
        }
        .login #login_error {
            border-left-color: #cd9925 !important;
        }
        .wp-core-ui .button-primary {
            background: #cd9925 !important;
            box-shadow: 0 1px 0 #cd9925 !important;
            text-shadow: none !important;
            border-color: #cd9925 !important;
            border-radius: 0 !important;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', __NAMESPACE__.'\\login_styling');

/**
 * Disable output buffering for login form
 *
 * @return void
 */
function autocomplete_login_init()
{
    ob_start();
}
add_action('login_init', __NAMESPACE__ . '\\autocomplete_login_init');

/**
 * Edit the output to add the autocomplete attribute
 *
 * @return void
 */
function autocomplete_login_form()
{
    $login = ob_get_contents();
    ob_end_clean();
    $login = str_replace('id="user_login"', 'id="user_login" autocomplete="off"', $login);
    $login = str_replace('id="user_pass"', 'id="user_pass" autocomplete="off"', $login);
    echo $login;
}
add_action('login_form', __NAMESPACE__ . '\\autocomplete_login_form');

/**
 * Update forgotten password subject line
 *
 * @return void
 */
function retrieve_password_title()
{
    return "ZAP Retail Reset Password";
}
add_filter('retrieve_password_title', __NAMESPACE__ . '\\retrieve_password_title');

/**
 * Change login error message
 */
add_filter('login_errors', function ($error) {
    return __('<strong>ERROR</strong>: Invalid Login credentials.');
});

/**
 * admin_cache_headers function
 * Adds new cache header for logged in users
 * Stop caching of authentication pages using no-store
 *
 * @return void
 */
function admin_cache_headers()
{
    if (is_user_logged_in()) {
        header('Cache-Control: no-store');
    }
}
add_action('send_headers', __NAMESPACE__ .  '\\admin_cache_headers');

/**
 * Change logo site url
 * return String
 */
add_filter('login_headerurl', function ($url) {
    return home_url();
});

/**
 *  Change logo title to blogname
 */
add_filter('login_headertext', function () {
    return get_option('blogname');
});

/**
 * Checks user role and redirects login to the necessary page
 * Checks to see if redirect cookie exists.
 *
 * @return void
 */
function redirect_after_login()
{
    return home_url();
}
add_filter('login_redirect', __NAMESPACE__. '\\redirect_after_login', 10, 3);
add_filter('woocommerce_login_redirect', __NAMESPACE__. '\\redirect_after_login');

/**
 * Order up sell product by menu_order
 *
 * @param String $orderby
 * @return String
 */
function woocommerce_upsells_orderby($orderby)
{
    return 'menu_order';
};
add_filter('woocommerce_upsells_orderby', __NAMESPACE__. '\\woocommerce_upsells_orderby', 10, 1);

/**
 * Order up sell product asc/desc/rand
 *
 * @param String $order
 * @return String
 */
function upsells_order($order)
{
    return 'asc'; // Default is 'desc'
}
add_filter('woocommerce_upsells_order', __NAMESPACE__. '\\upsells_order', 10, 1);
