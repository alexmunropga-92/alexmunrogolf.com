<div class="overlay bg-cover bg-no-repeat relative sm:py-30 py-12 mt-20 parallax-section parallax-section--top" style="background-image: url(<?php echo $args['image']['url'] ?? get_template_directory_uri() . '/assets/images/main_header.jpg'; ?>);">
    <div class="container mx-auto relative text-white text-xl relative z-10 text-center sm:text-left">
        <h1 class="text-white mb-5 sm:text-5xl text-4xl font-semibold md:max-w-1/2">
        <?php
            if (isset($args['custom_title'])) {
                echo esc_html($args['custom_title']);
            } elseif (is_post_type_archive()) {
                echo esc_html(post_type_archive_title('', false));
            } else {
                echo esc_html(get_the_title());
            }
            ?>
        </h1>
    </div>
</div>