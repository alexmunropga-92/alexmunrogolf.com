<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php get_template_part('components/hero-banner'); ?>

<?php get_template_part('components/text-image-row'); ?>


<div class="overlay bg-cover bg-no-repeat relative py-40 bg-[url('http://localhost:10014/wp-content/uploads/2026/02/philosophy_background.jpg')]">
    <div class="container mx-auto text-center relative text-white text-xl">
        <h3 class="text-white mb-5 text-5xl font-semibold">About Us</h3>
        <p>Providing top-quality sports nutrition advice for peak performance in youth athletes</p>
        <?php
            get_template_part(
            'components/button',
                null,
                [
                    'text' => 'Learn More',
                    'url'  => '/contact',
                    'variant' => 'secondary',
                    'additional_classes' => 'mt-10'
                ]
            );
        ?>
    </div>
</div>

<?php get_template_part('components/blog-row'); ?>
<?php get_template_part('components/newsletter'); ?>
<?php get_template_part('components/footer'); ?>