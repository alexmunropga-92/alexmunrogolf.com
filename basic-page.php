<?php
/*
Template Name: Basic Page
*/
?>

<?php
get_template_part('components/head');
get_template_part('components/header');
?>
<?php $banner_image = get_field('banner_image'); ?>
<?php get_template_part('components/page-header',
    null,
    [
        'image' => $banner_image,
    ]); 
?>
<section class="py-12">
    <div class="container mx-auto">
        <div class="prose py-12 max-w-none text-[var(--blue)] [&>h3]:text-[var(--blue)] [&>h2]:text-[var(--blue)]">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php get_template_part('components/footer'); ?>