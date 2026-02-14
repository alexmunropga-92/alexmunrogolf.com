<?php
/*
Template Name: Contact Page
*/
get_template_part('components/head');
get_template_part('components/header');
?>
<?php get_template_part('components/archive-header'); ?>

<div class="bg-[var(--blue)]">
    <div class="container mx-auto">
        <?php
        $locations = get_terms(array(
            'taxonomy' => 'location',
            'hide_empty' => true,
        ));
        $age_groups = get_terms(array(
            'taxonomy' => 'age-group',
            'hide_empty' => true,
        )); ?>
        <div class="grid grid-cols-12 gap-x-5 py-8 mb-10">
            <div class="col-span-4">
                <form method="GET" class="bg-white rounded">
                    <select name="location" onchange="this.form.submit()" class="p-3 border border-[var(--blue)] w-full rounded">
                        <option value="">Filter by Location</option>
                        <?php foreach ( $locations as $term ) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>" <?php selected( $_GET['location'] ?? '', $term->slug ); ?>>
                                <?php echo esc_html($term->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <div class="col-span-4">
                <form method="GET" class="bg-white rounded">
                    <select name="age-group" onchange="this.form.submit()" class="p-3 border border-[var(--blue)] w-full rounded">
                        <option value="">Filter by Age</option>
                        <?php foreach ( $age_groups as $term ) : ?>
                            <option value="<?php echo esc_attr($term->slug); ?>" <?php selected( $_GET['age'] ?? '', $term->slug ); ?>>
                                <?php echo esc_html($term->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <div class="col-span-4 text-end">
                <a id="geolocationTrigger" class="bg-white transition cursor-pointer py-[10px] duration-300 text-[var(--blue)] border border-white hover:text-white rounded inline-block hover:bg-[var(--blue)] py-2 px-4">Find Camps Near Me</a>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto">
        <?php
        if (!empty($_GET['postcode'])) {
        $ordered_posts = get_camps_ordered_by_distance(sanitize_text_field($_GET['postcode']));

            if (!empty($ordered_posts)) : ?>
                <div class="grid grid-cols-12 gap-5">
                    <?php foreach ($ordered_posts as $item) :
                        $post = $item['post'];
                        $distance = $item['distance'];
                        setup_postdata($post); // important for template tags
                        $camp_date = get_field('camp_date'); ?>
                        
                        <div class="col-span-4 border border-[var(--blue)] rounded-lg p-5">
                            <div class="overflow-hidden h-[200px]">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium', ['class' => 'h-full rounded-md w-full object-cover']); ?>
                                <?php endif; ?>
                            </div>
                            <h2 class="text-2xl mb-1 mt-4 font-bold text-[var(--blue)]"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="text-lg font-semibold text-[var(--blue)]"><?php echo $camp_date; ?></p>
                            <div>
                                <p class="text-[var(--blue)]"><?php the_excerpt(); ?></p>
                                <a class="hover:bg-white transition duration-300 hover:text-[var(--blue)] border border-[var(--blue)] mt-5 text-white rounded-md inline-block bg-[var(--blue)] py-2 px-4" href="<?php the_permalink(); ?>">Find Out More</a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p>No coaching camps found near that postcode.</p>
            <?php endif; ?>
        <?php } else { ?>
            <?php if ( have_posts() ) : ?>
                <div class="grid grid-cols-12 gap-10">
                    <?php while ( have_posts() ) : the_post(); 
                        $camp_date = get_field('camp_date'); ?>
                        
                        <div class="col-span-4 border border-[var(--blue)] rounded-lg p-5">
                            <div class="overflow-hidden h-[200px]">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium', ['class' => 'h-full rounded-md w-full object-cover']); ?>
                                <?php endif; ?>
                            </div>
                            <h2 class="text-2xl mb-1 mt-4 font-bold text-[var(--blue)]"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="text-lg font-semibold text-[var(--blue)]"><?php echo $camp_date; ?></p>
                            <div>
                                <p class="text-[var(--blue)]"><?php the_excerpt(); ?></p>
                                <a class="hover:bg-white transition duration-300 hover:text-[var(--blue)] border border-[var(--blue)] mt-5 text-white rounded-md inline-block bg-[var(--blue)] py-2 px-4" href="<?php the_permalink(); ?>">Find Out More</a>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <?php the_posts_pagination(); ?>
            <?php else : ?>
                <p>No coaching camps found.</p>
            <?php endif; ?>
        <?php } ?>

        

    </div>
</div>

<script>


    document.getElementById('geolocationTrigger').addEventListener('click', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });

    function error(err) {
        console.warn('Geolocation error:', err);
        alert('Could not get your location: ' + err.message);
    }

    async function getPostCodeFromCoordinates(lat, lon) {
        const response = await fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`);
        const data = await response.json();
        return data.postcode;
    }
    async function success(position) {

        //Get latitude and longitude
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // Use a geocoding API to convert lat/lon to postcode
        const postcode = await getPostCodeFromCoordinates(latitude, longitude);

        // Send postcode to server
        if (postcode) {
            sendPostcodeToServer(postcode);
        } else {
            alert('Could not determine postcode from your location.');
        }

        
    }

    async function sendPostcodeToServer(postcode) {
        const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: new URLSearchParams({
                action: 'submit_postcode',
                postcode: postcode
            })
        });

        const data = await response.json();
        if (data.success) {
            console.log('Postcode sent successfully:', data.data);
            // Optionally, you can reload the page with the postcode as a query parameter
            window.location.href = window.location.pathname + '?postcode=' + encodeURIComponent(postcode);
        } else {
            console.error('Error sending postcode:', data.data);
        }
    }

</script>


<?php get_template_part('components/footer'); ?>