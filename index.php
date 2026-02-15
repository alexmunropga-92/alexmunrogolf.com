<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php get_template_part('components/hero-banner'); ?>

<?php get_template_part('components/text-image-row'); ?>


<div class="overlay bg-cover bg-no-repeat relative py-40 bg-[url('http://localhost:10014/wp-content/uploads/2026/02/philosophy_background.jpg')]">
    <div class="container mx-auto text-center relative text-white text-xl z-10">
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
        <p>Providing top-quality sports nutrition advice for peak performance in youth athletes</p>
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

<?php get_template_part('components/blog-row'); ?>
<?php get_template_part('components/newsletter'); ?>
<?php get_template_part('components/footer'); ?>