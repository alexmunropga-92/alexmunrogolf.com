<?php 
//Styles
function ajm_enqueue_styles() {
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

function netgain_files() {
    wp_enqueue_script('googleMap','//maps.googleapis.com/maps/api/js?key=AIzaSyBSjuX_x2iM3RQ_zhiu9c1ozvpzOW9Y8jo', NULL, '1.0', true);

    wp_enqueue_script(
        'postcode-script', // Handle (a unique name for your script)
        get_template_directory_uri() . '/js/postcode.js', // Path to the JS file
        ['jquery'], // Dependencies (jQuery loads before this)
        null, // Version (null = no version)
        true // Load in footer (true = yes)
    );
    // Localize (pass PHP data into your JS)
    wp_localize_script('postcode-script', 'ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);

}

add_action('wp_enqueue_scripts', 'netgain_files'); 
add_action('wp_enqueue_scripts', 'ajm_enqueue_styles', 20);

add_filter('woocommerce_enqueue_styles', '__return_false');


//Specific Features
function netgain_features() {
    register_nav_menu('primary_menu', 'Primary Menu');
    function university_files() {
        wp_enqueue_script('googleMap','//maps.googleapis.com/maps/api/js?key=AIzaSyBSjuX_x2iM3RQ_zhiu9c1ozvpzOW9Y8jo', NULL, '1.0', true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
        wp_enqueue_style('custom_google_fonts', 'fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('university_mail_styles', get_theme_file_uri('/build/style-index.css'));
        
        //wp_enqueue_style('university_mail_styles', get_theme_file_uri('/build/index.css'));
    
        wp_localize_script('main-university-js', 'universityData', array(
            'root_url' => get_site_url(),
        ));
    }
    add_action('wp_enqueue_scripts', 'university_files'); 
    register_nav_menu('footer_menu', 'Footer Menu');
}
add_action('after_setup_theme', 'netgain_features');

add_filter('category_template', function($template) {
    return get_template_directory() . '/archive.php';
});

//Add fields
add_theme_support('post-thumbnails');

// Add WooCommerce support
function netgain_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'netgain_add_woocommerce_support');


//Maps API Key
function location_map_key($api) {
    $api['key'] = 'AIzaSyBSjuX_x2iM3RQ_zhiu9c1ozvpzOW9Y8jo';
    return $api;
}
add_filter('acf/fields/google_map/api', 'location_map_key');

//Location Taxonomy for Coaching Camps
function filter_coaching_camps_by_location_taxonomy( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive('coaching-camps') ) {
        if ( !empty($_GET['location']) ) {
            $query->set('tax_query', array( 
                array(
                    'taxonomy' => 'location', // your taxonomy name
                    'field'    => 'slug',     // using slug from dropdown
                    'terms'    => sanitize_text_field($_GET['location']),
                )
            ));
        }
    }
}
add_action('pre_get_posts', 'filter_coaching_camps_by_location_taxonomy');

function get_camps_ordered_by_distance($postcode) {
    $coords = get_coordinates_from_postcode($postcode);
    if (!$coords) return [];

    $user_lat = $coords['lat'];
    $user_lng = $coords['lng'];

    // Get all coaching-camps posts
    $camps = get_posts([
        'post_type' => 'coaching-camps',
        'numberposts' => -1,
    ]);

    $camps_with_distance = [];

    //Loop over all posts
    foreach ($camps as $post) {
        $map = get_field('google_map', $post->ID);
        if ($map && isset($map['lat'], $map['lng'])) {

            //Get the users longitude and latitude and the post longitude and latitude
            $distance = haversine_distance($user_lat, $user_lng, $map['lat'], $map['lng']);

            //Create an array with the post and the distance, the distance will be used for sorting
            $camps_with_distance[] = [
                'post' => $post,
                'distance' => $distance,
            ];
        }
    }

    // Sort posts by distance (closest first)
    usort($camps_with_distance, function($a, $b) {
        return $a['distance'] <=> $b['distance'];
    });

    return $camps_with_distance;
}

//Haversine formula
function haversine_distance($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 6371; // km

    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLng/2) * sin($dLng/2);

    $c = 2 * atan2(sqrt($a), sqrt(1-$a));

    return $earth_radius * $c;
}


//Coordinates fomr the postcode
function get_coordinates_from_postcode($postcode) {
    $postcode = urlencode($postcode);
    $api_key = 'AIzaSyChwiqJs5LN5ppto3X4nO7rHEdMMmbyy5A';

    //Use google API to get coordinates
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$postcode}&key={$api_key}";
    
    //Make the request and handle error
    $response = wp_remote_get($url);
    if (is_wp_error($response)) return false;

    //Get the response and check for results
    $body = json_decode(wp_remote_retrieve_body($response));
    if (!empty($body->results[0]->geometry->location)) {
        return [
            'lat' => $body->results[0]->geometry->location->lat,
            'lng' => $body->results[0]->geometry->location->lng,
        ];
    }

    return false;
}

//Shortcodes 
function pricing_grid_shortcode($atts) {

    $atts = shortcode_atts( array(
        'title_1' => 'Private Lesson',
        'duration_1' => '30 minutes',
        'price_1' => '£35',
        'description_1' => 'One-on-one coaching focused on your technique and consistency.',
        'title_2' => 'Private Lesson',
        'duration_2' => '60 minutes',
        'price_2' => '£60',
        'description_2' => 'One-on-one coaching focused on your technique and consistency.',
    ), $atts, 'tennis_lesson' );

    ob_start(); ?>
    
    <div class="rounded-md overflow-hidden border border-[var(--blue)] my-12">
        <div class="grid grid-cols-12 bg-[var(--blue)] py-3 px-5">
            <div class="col-span-3">
                <span class="text-white">Lesson Type</span>
            </div>
            <div class="col-span-3">
                <span class="text-white">Duration</span>
            </div>
            <div class="col-span-2">
                <span class="text-white">Price</span>
            </div>
            <div class="col-span-4">
                
            </div>

        </div>
        <div class="grid grid-cols-12 px-5 py-5 items-center text-[var(--blue)]">
            <div class="col-span-3">
                <?php echo esc_html( $atts['title_1'] ); ?>
            </div>
            <div class="col-span-3">
                <?php echo esc_html( $atts['duration_1'] ); ?>
            </div>
            <div class="col-span-2">
                <?php echo esc_html( $atts['price_1'] ); ?>
            </div>
            <div class="col-span-4 text-end">
            <a href="" class="hover:bg-white me-0 ms-auto transition duration-300 hover:text-[var(--blue)] border border-[var(--blue)] text-white rounded-md inline-block bg-[var(--blue)] py-2 px-4">Book Now</a>
            </div>
        </div>  
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('pricing_grid', 'pricing_grid_shortcode');



//Logic to get closest camps to location
add_action('wp_ajax_submit_postcode', 'handle_postcode_submission');
add_action('wp_ajax_nopriv_submit_postcode', 'handle_postcode_submission');


function handle_postcode_submission() {
    if (isset($_POST['postcode'])) {
        $postcode = sanitize_text_field($_POST['postcode']);

        wp_send_json_success([
            'message' => 'Postcode received successfully',
            'postcode' => $postcode
        ]);
    } else {
        wp_send_json_error(['message' => 'No postcode provided']);
    }

    wp_die(); // Always end AJAX requests
}


?>