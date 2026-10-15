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

//Mobile menu: add a toggle button to items with sub-menus
add_filter('walker_nav_menu_start_el', function($item_output, $item, $depth, $args) {
    if (empty($args->ajm_mobile_menu) || !in_array('menu-item-has-children', (array) $item->classes, true)) {
        return $item_output;
    }
    $label = esc_attr(sprintf('Show %s sub-menu', $item->title));
    return $item_output . '<button type="button" class="sub-menu-toggle" aria-label="' . $label . '"'
        . ' x-data="{ subOpen: false }" :aria-expanded="subOpen.toString()" aria-expanded="false"'
        . ' @click.stop="subOpen = !subOpen; $el.parentElement.classList.toggle(\'is-open\', subOpen)">'
        . '<svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>'
        . '</button>';
}, 10, 4);

//Enquiry form: email every enquiry straight to Alex (not a newsletter signup, nothing is stored in MailPoet)
function ajm_handle_enquiry() {
    $back = wp_validate_redirect(esc_url_raw(wp_unslash($_POST['redirect_to'] ?? '')), home_url('/'));
    $finish = function ($status) use ($back) {
        wp_safe_redirect(add_query_arg('enquiry', $status, $back) . '#enquiry');
        exit;
    };

    // Honeypot: bots fill this in, people never see it
    if (!empty($_POST['website'])) {
        $finish('sent');
    }

    $first_name = sanitize_text_field(wp_unslash($_POST['first_name'] ?? ''));
    $last_name = sanitize_text_field(wp_unslash($_POST['last_name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if ($first_name === '' || !is_email($email) || $message === '') {
        $finish('error');
    }

    $name = trim("$first_name $last_name");
    $body = "Name: $name\n"
        . "Email: $email\n"
        . "Phone: " . ($phone ?: '-') . "\n"
        . "Page: $back\n\n"
        . "Message:\n$message\n";

    $sent = wp_mail(
        'alexmunropga@gmail.com',
        'New website enquiry from ' . $name,
        $body,
        ['Reply-To: ' . str_replace(['"', "\r", "\n"], '', $name) . ' <' . $email . '>']
    );

    $finish($sent ? 'sent' : 'error');
}
add_action('admin_post_ajm_enquiry', 'ajm_handle_enquiry');
add_action('admin_post_nopriv_ajm_enquiry', 'ajm_handle_enquiry');

function ajm_enquiry_scripts() {
    wp_enqueue_script(
        'enquiry-form',
        get_template_directory_uri() . '/assets/js/enquiry-form.js',
        [],
        filemtime(get_template_directory() . '/assets/js/enquiry-form.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'ajm_enquiry_scripts');

add_filter('category_template', function($template) {
    return get_template_directory() . '/archive.php';
});

//Add fields
add_theme_support('post-thumbnails');

//Let WordPress/Yoast output the <title> tag
add_theme_support('title-tag');

//Local business schema (home page) to reinforce the Bristol service area
add_action('wp_head', function () {
    if (!is_front_page()) {
        return;
    }
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'ProfessionalService',
        'name'        => 'Alex Munro Golf',
        'description' => 'Golf lessons and golf coaching in Bristol with PGA Professional Alex Munro.',
        'url'         => home_url('/'),
        'telephone'   => '+447960404806',
        'email'       => 'alex@alexmunrogolf.com',
        'areaServed'  => ['@type' => 'City', 'name' => 'Bristol'],
        'founder'     => ['@type' => 'Person', 'name' => 'Alex Munro', 'jobTitle' => 'PGA Professional Golf Coach'],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
});

//Services archive: use the SEO title and description from the Services page (ID 84)
add_filter('wpseo_title', function ($title) {
    return is_post_type_archive('services') ? (get_post_meta(84, '_yoast_wpseo_title', true) ?: $title) : $title;
});
add_filter('wpseo_metadesc', function ($desc) {
    return is_post_type_archive('services') ? (get_post_meta(84, '_yoast_wpseo_metadesc', true) ?: $desc) : $desc;
});

?>