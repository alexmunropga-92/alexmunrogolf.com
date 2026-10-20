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

// FAQ Custom Post Type
function register_faq() {
    register_post_type('faq', [
        'labels' => [
            'name' => 'FAQ',
            'singular_name' => 'FAQ',
            'add_new_item'       => 'Add New FAQ',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'faq'],
        'supports' => ['title', 'editor'],
        'menu_icon' => 'dashicons-portfolio',
    ]);
}
add_action('init', 'register_faq');

// Change title
// Change FAQ title placeholder
function change_title_placeholder($title) {
    $screen = get_current_screen();

    // Change the placeholder text for the FAQ post type
    if ($screen && $screen->post_type === 'faq') {
        return 'Add FAQ';
    }

    return $title;
}
add_filter('enter_title_here', 'change_title_placeholder');

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

//Schema markup (JSON-LD)
function ajm_print_schema($schema) {
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

function ajm_business_id() {
    return home_url('/#business');
}

//Local business schema (home page) to reinforce the Bristol service area
add_action('wp_head', function () {
    if (!is_front_page()) {
        return;
    }

    // Get all published services and create Offer objects for each
    $services = get_posts(['post_type' => 'services', 'posts_per_page' => -1, 'post_status' => 'publish']);
    $offers = array_map(function ($service) {
        return [
            '@type'       => 'Offer',
            'itemOffered' => [
                '@type'       => 'Service',
                'name'        => get_the_title($service),
                'description' => wp_strip_all_tags(get_the_excerpt($service)),
                'url'         => get_permalink($service),
            ],
        ];
    }, $services);

    // Define the business schema with relevant details
    $business = [
        '@type'        => ['ProfessionalService', 'SportsActivityLocation'],
        '@id'          => ajm_business_id(),
        'name'         => 'Alex Munro Golf',
        'description'  => 'Golf lessons and golf coaching in Bristol with PGA Professional Alex Munro.',
        'url'          => home_url('/'),
        'telephone'    => '+447960404806',
        'email'        => 'alex@alexmunrogolf.com',
        'priceRange'   => '££',
        'areaServed'   => [
            ['@type' => 'City', 'name' => 'Bristol'],
            ['@type' => 'AdministrativeArea', 'name' => 'Bristol, South West England'],
        ],
        'knowsAbout'   => ['Golf lessons', 'Golf coaching', 'Junior golf coaching', 'Short game', 'Golf swing technique'],
        'sport'        => 'Golf',
        'sameAs'       => [
            'https://www.facebook.com/people/Alex-Munro-Golf-Coaching/100063679795002/',
            'https://www.instagram.com/alexmunrogolf/',
            'https://x.com/munroalex',
        ],
        'founder'      => ['@id' => home_url('/#alex-munro')],
        'potentialAction' => [
            '@type'  => 'ReserveAction',
            'target' => [
                '@type'          => 'EntryPoint',
                'urlTemplate'    => 'https://launchacademybristol.as.me/schedule/b5b7e2b4/?calendarIds=13800920',
                'actionPlatform' => ['http://schema.org/DesktopWebPlatform', 'http://schema.org/MobileWebPlatform'],
            ],
            'result' => ['@type' => 'Reservation', 'name' => 'Book a golf lesson'],
        ],
    ];

    if ($address = ajm_address_schema()) {
        $business['address'] = $address;
    }
    if ($hours = ajm_opening_hours_schema()) {
        $business['openingHoursSpecification'] = $hours;
    }

    if ($logo_id = get_theme_mod('custom_logo')) {
        $business['logo'] = wp_get_attachment_image_url($logo_id, 'full');
        $business['image'] = $business['logo'];
    }

    // Add the OfferCatalog to the business schema if there are offers
    if ($offers) {
        $business['hasOfferCatalog'] = ['@type' => 'OfferCatalog', 'name' => 'Golf lessons and coaching', 'itemListElement' => $offers];
    }

    // Define the person schema for Alex Munro
    $person = [
        '@type'      => 'Person',
        '@id'        => home_url('/#alex-munro'),
        'name'       => 'Alex Munro',
        'jobTitle'   => 'PGA Professional Golf Coach',
        'url'        => home_url('/'),
        'worksFor'   => ['@id' => ajm_business_id()],
        'sameAs'     => $business['sameAs'],
        'knowsAbout' => $business['knowsAbout'],
    ];

    // Output the combined schema for the business and the person
    ajm_print_schema(['@context' => 'https://schema.org', '@graph' => [$business, $person]]);
});

//Service schema (single service pages)
add_action('wp_head', function () {
    if (!is_singular('services')) {
        return;
    }
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => get_the_title(),
        'description' => wp_strip_all_tags(get_the_excerpt()),
        'url'         => get_permalink(),
        'serviceType' => 'Golf lessons',
        'provider'    => ['@id' => ajm_business_id()],
        'areaServed'  => ['@type' => 'City', 'name' => 'Bristol'],
    ];
    if ($image = get_the_post_thumbnail_url(null, 'full')) {
        $schema['image'] = $image;
    }
    ajm_print_schema($schema);
});

//Blog post schema (author and publisher linked to the business)
add_action('wp_head', function () {
    if (!is_singular('post')) {
        return;
    }
    $schema = [
        '@context'         => 'https://schema.org',
        '@type'            => 'BlogPosting',
        'headline'         => get_the_title(),
        'description'      => wp_strip_all_tags(get_the_excerpt()),
        'url'              => get_permalink(),
        'mainEntityOfPage' => get_permalink(),
        'datePublished'    => get_the_date('c'),
        'dateModified'     => get_the_modified_date('c'),
        'author'           => ['@id' => home_url('/#alex-munro')],
        'publisher'        => ['@id' => ajm_business_id()],
    ];
    if ($image = get_the_post_thumbnail_url(null, 'full')) {
        $schema['image'] = $image;
    }
    ajm_print_schema($schema);
});

//Contact page schema
add_action('wp_head', function () {
    if (!is_page_template('page-contact.php')) {
        return;
    }
    ajm_print_schema([
        '@context'   => 'https://schema.org',
        '@type'      => 'ContactPage',
        'name'       => get_the_title(),
        'url'        => get_permalink(),
        'mainEntity' => ['@id' => ajm_business_id()],
    ]);
});

//Services archive: use the SEO title and description from the Services page (ID 84)
add_filter('wpseo_title', function ($title) {
    return is_post_type_archive('services') ? (get_post_meta(84, '_yoast_wpseo_title', true) ?: $title) : $title;
});
add_filter('wpseo_metadesc', function ($desc) {
    return is_post_type_archive('services') ? (get_post_meta(84, '_yoast_wpseo_metadesc', true) ?: $desc) : $desc;
});

// Business address setting (Settings > General), used in the footer
function ajm_default_address() {
    return "Bristol Golf Centre\nCommon Mead Lane\nHambrook\nBristol\nBS16 1QQ";
}
add_action('admin_init', function () {
    register_setting('general', 'ajm_address', [
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'default'           => ajm_default_address(),
    ]);
    register_setting('general', 'ajm_opening_hours', [
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    add_settings_field('ajm_address', 'Address', function () {
        echo '<textarea name="ajm_address" id="ajm_address" rows="5" class="regular-text">' . esc_textarea(get_option('ajm_address', ajm_default_address())) . '</textarea>';
        echo '<p class="description">One line per row. Shown in the site footer.</p>';
    }, 'general');

});

function ajm_default_opening_hours() {
    return "Monday: 9am - 6pm\nTuesday: 9am - 6pm\nWednesday: 9am - 6pm\nThursday: 9am - 6pm\nFriday: 9am - 6pm\nSaturday: 9am - 5pm\nSunday: Closed";
}

add_action('admin_init', function () {
    register_setting('general', 'ajm_opening_hours', [
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'default'           => "Monday: 9am - 6pm\nTuesday: 9am - 6pm\nWednesday: 9am - 6pm\nThursday: 9am - 6pm\nFriday: 9am - 6pm\nSaturday: 9am - 5pm\nSunday: Closed",
    ]);
    add_settings_field('ajm_opening_hours', 'Coaching Hours', function () {
        echo '<textarea name="ajm_opening_hours" id="ajm_opening_hours" rows="5" class="regular-text">' . esc_textarea(get_option('ajm_opening_hours', ajm_default_opening_hours())) . '</textarea>';
    }, 'general');
    add_settings_field('ajm_opening_hours', 'Opening Hours', function () {
        echo '<textarea name="ajm_opening_hours" id="ajm_opening_hours" rows="5" class="regular-text" placeholder="Mon-Fri 9am-5pm&#10;Sat 10:00-14:00">' . esc_textarea(get_option('ajm_opening_hours', '')) . '</textarea>';
        echo '<p class="description">One line per row, like <code>Monday: 9am - 5pm</code> or <code>Mon-Fri 09:00-17:00</code>. Closed days can be left out or written as Closed. Used in the schema markup.</p>';
    }, 'general');
});

// Turn the address setting into a PostalAddress (last line = postcode, then town, remaining lines = street)
function ajm_address_schema() {

    // Get the address from options, split the address into lines, trim whitespace, and remove empty lines
    $lines = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', get_option('ajm_address', ajm_default_address())))));
    if (count($lines) < 3) {
        return null;
    }

    // Pop the last two lines for postcode and town, and join the remaining lines for street address
    $postcode = array_pop($lines);
    $town     = array_pop($lines);
    return [
        '@type'           => 'PostalAddress',
        'streetAddress'   => implode(', ', $lines),
        'addressLocality' => $town,
        'postalCode'      => $postcode,
        'addressCountry'  => 'GB',
    ];
}

// Convert "9am", "9:30pm" or "17:00" to 24-hour HH:MM
function ajm_time_24h($time, $meridiem) {
    $parts = explode(':', $time);
    $h = (int) $parts[0];
    $m = isset($parts[1]) ? (int) $parts[1] : 0;
    $meridiem = strtolower($meridiem);
    if ($meridiem === 'pm' && $h < 12) {
        $h += 12;
    } elseif ($meridiem === 'am' && $h === 12) {
        $h = 0;
    }
    return sprintf('%02d:%02d', $h, $m);
}

// Turn the opening hours setting into OpeningHoursSpecification objects
// Accepts lines like "Mon-Fri 09:00-17:00" or "Monday: 9am - 5pm"; "Closed" lines are skipped
function ajm_opening_hours_schema() {
    $days = ['mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday'];
    $keys = array_keys($days);
    $time = '(\d{1,2}(?::\d{2})?)\s*([ap]m)?';
    $specs = [];
    foreach (preg_split('/\r\n|\r|\n/', get_option('ajm_opening_hours', '')) as $line) {
        if (!preg_match('/^\s*([a-z]{3})[a-z]*(?:\s*-\s*([a-z]{3})[a-z]*)?\s*:?\s*' . $time . '\s*(?:-|to)\s*' . $time . '\s*$/i', $line, $m)) {
            continue;
        }
        $m += array_fill(0, 7, '');
        $start = array_search(strtolower($m[1]), $keys);
        $end   = $m[2] !== '' ? array_search(strtolower($m[2]), $keys) : $start;
        if ($start === false || $end === false) {
            continue;
        }
        $range = $start <= $end ? range($start, $end) : array_merge(range($start, 6), range(0, $end));
        // "9 - 5pm": if the opening time has no am/pm, assume the closing one's applies unless that makes it open after it closes
        $opens  = ajm_time_24h($m[3], $m[4]);
        $closes = ajm_time_24h($m[5], $m[6]);
        if ($m[4] === '' && $m[6] !== '' && $opens > $closes) {
            $opens = ajm_time_24h($m[3], $m[6]);
        }
        $specs[] = [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array_map(function ($i) use ($days, $keys) { return $days[$keys[$i]]; }, $range),
            'opens'     => $opens,
            'closes'    => $closes,
        ];
    }
    return $specs;
}

?>