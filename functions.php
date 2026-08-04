<?php 
//Styles
function amg_enqueue_styles() {
    //Global
    wp_enqueue_style(
        'global',
        get_template_directory_uri() . '/dist/global.css',
        [],
        filemtime(get_template_directory() . '/dist/global.css')
    );
    //Tailwind
    wp_enqueue_style(
        'tailwind',
        get_template_directory_uri() . '/dist/tailwind-output.css',
        [],
        filemtime(get_template_directory() . '/dist/tailwind-output.css')
    );
    //Header
    wp_enqueue_style(
        'header',
        get_template_directory_uri() . '/dist/header.css', 
        [],
        filemtime(get_template_directory() . '/dist/header.css')
    );
}

//Custom Post Types
function register_services() {
    register_post_type('services', [
        'labels' => [
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new_item'       => 'Add New Service',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'services'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-portfolio',
    ]);
}
add_action('init', 'register_services');

//Existing post types support
add_action('init', function () {
    add_post_type_support('page', 'excerpt');
});

function amg_files() {
    wp_enqueue_script('googleMap','//maps.googleapis.com/maps/api/js?key=AIzaSyBSjuX_x2iM3RQ_zhiu9c1ozvpzOW9Y8jo', NULL, '1.0', true);

    // wp_enqueue_script(
    //     'transitions-script',
    //     get_template_directory_uri() . '/assets/js/transitions.js',
    //     [],
    //     filemtime(get_template_directory() . '/assets/js/transitions.js'),
    //     true
    // );

    // Intersect Plugin (depends on alpine-core)
    wp_enqueue_script(
        'alpine-intersect',
        'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js',
        [],
        null,
        true
    );

    // Alpine Core (deferred)
    wp_enqueue_script(
        'alpine-core',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        [],
        null,
        true
    );

    // Enqueue Swiper
    
    wp_enqueue_style(
        'swiper',
        get_template_directory_uri() . '/node_modules/swiper/swiper-bundle.min.css',
        [],
    );

    wp_enqueue_script(
        'swiper',
        get_template_directory_uri() . '/node_modules/swiper/swiper-bundle.min.js',
        [],
        '11.2.10',
        true
    );

}

add_action('wp_enqueue_scripts', 'amg_files'); 
add_action('wp_enqueue_scripts', 'amg_enqueue_styles', 20);



//Specific Features
function ajm_features() {
    register_nav_menu('primary_menu', 'Primary Menu');
    register_nav_menu('footer_menu', 'Footer Menu');
}
add_action('after_setup_theme', 'ajm_features');

add_filter('category_template', function($template) {
    return get_template_directory() . '/archive.php';
});

//Add fields
add_theme_support('post-thumbnails');


?>