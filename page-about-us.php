<?php
/*
Template Name: Basic Page
*/
?>

<?php
get_template_part('components/head');
get_template_part('components/header');
?>

<?php get_template_part('components/page-header'); ?>
<div class="container mx-auto py-10">
    <div class="text-base my-10 content-block">
        <div class="grid grid-cols-12">
            <div class="col-span-8">
                <?php the_content(); ?>
            </div>
            <div class="col-span-4">
                <div class="sticky top-[50px]">
                    <div class="float-right bg-[var(--blue)] p-5 rounded-lg">
                        <h3 class="text-2xl font-bold text-white">Sign Up</h3>
                        <?php echo do_shortcode('[newsletter_form form="1"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php get_template_part('components/footer'); ?>