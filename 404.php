<?php
get_template_part('components/head');
get_template_part('components/header');

get_template_part('components/page-header', null, [
    'custom_title' => 'Page Not Found',
]);
?>

<section class="py-12 md:py-20">
    <div class="container mx-auto text-center">
        <p class="text-6xl sm:text-8xl font-semibold text-[var(--blue)] mb-4">404</p>
        <div class="prose max-w-none mx-auto text-[var(--blue)] mb-10">
            <p>Oops, looks like this page is out of bounds! It may have been moved or no longer exists.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            <?php
            get_template_part('components/button', null, [
                'text'    => 'Back to Home',
                'url'     => home_url('/'),
                'variant' => 'secondary',
            ]);
            get_template_part('components/button', null, [
                'text'    => 'Golf Coaching',
                'url'     => get_post_type_archive_link('golf-coaching'),
                'variant' => 'secondary',
            ]);
            get_template_part('components/button', null, [
                'text'    => 'Contact Us',
                'url'     => home_url('/contact/'),
                'variant' => 'secondary',
            ]);
            ?>
        </div>
    </div>
</section>

<?php get_template_part('components/footer'); ?>
