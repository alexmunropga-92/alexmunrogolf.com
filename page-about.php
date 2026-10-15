<?php
/*
Template Name: About Page
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
        <div class="flex space-x-10 items-center">
            <div class="">
                <img class="max-w-full h-auto h-[200px] w-[200px]" alt="alex munro" height="200" width="200" src="https://alexmunrogolf.com/wp-content/uploads/2026/02/alex.jpg" />
            </div>
            <div class="text-md text-[var(--blue)]">
                <?php 
                    get_template_part(
                    'components/internal-header',
                        null,
                        [
                            'text' => 'Alex Munro',
                            'header_type' => 'h2',
                            'additional_classes' => 'mb-5'
                        ]
                    );
                ?>
                <p>PGA Professional</p>
                <p>Level 2 PGA Coach</p>
                <p>Level 2 TPI Certified Instructor</p>
            </div>
        </div>
        <div class="prose py-12 max-w-none text-[var(--blue)] [&>h3]:text-[var(--blue)] [&>h2]:text-[var(--blue)]">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php get_template_part('components/footer'); ?>