<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php get_template_part('components/hero-banner'); ?>

<?php get_template_part('components/text-image-row'); ?>


<section x-data="{ show: false }" x-intersect:enter="show = true">
    <div class="overlay bg-cover bg-no-repeat relative py-12 sm:py-20 lg:py-40 bg-[url('http://localhost:10014/wp-content/uploads/2026/02/philosophy_background.jpg')]">
        <div 
        class="container mx-auto text-center relative text-white z-10 transition-section"
        :class="show ? 'transition-section--visible' : ''"
        >
            <?php
                get_template_part(
                'components/internal-header',
                    null,
                    [
                        'text' => 'My Philosophy',
                        'header_type' => 'h2',
                        'additional_classes' => 'text-white mb-5'
                    ]
                ); 
            ?>
            <p class="text-xl">What I believe makes me an effective golf coach is my ability to analyze any swing and be able to identify the areas that are not functioning correctly. From there I am able to devise a strategy to address the issue that is simple and easy for the player to work with.</p>
            <?php
                get_template_part(
                'components/button',
                    null,
                    [
                        'text' => 'Learn More',
                        'url'  => '/contact',
                        'additional_classes' => 'mt-10'
                    ]
                );
            ?>
        </div>
    </div>
</section>

<?php get_template_part('components/blog-row',
null,
[
    'display_header' => true
]
); ?>
<?php get_template_part('components/newsletter'); ?>
<?php get_template_part('components/footer'); ?>