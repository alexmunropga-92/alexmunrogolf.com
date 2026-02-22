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
<section>
    <div class="container mx-auto sm:max-w-2xl">
        <div class="grid grid-cols-12 py-20">
            <div class="col-span-8">
                <div class="prose text-blue [&>h3]:text-blue [&>h2]:text-blue">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-span-4">
                <?php get_template_part('components/blog-sidebar'); ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('components/newsletter'); ?>
<?php get_template_part('components/footer'); ?>