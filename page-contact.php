<?php
/*
Template Name: Contact Page
*/
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
<section x-data="{ show: false }" x-intersect:enter="show = true">
    <div class="container mx-auto py-10">
        <div class="text-base my-10 content-block">
            <div class="grid grid-cols-12 mt-20 gap-20">
                <div class="col-span-5">
                    <h2 class="text-4xl">Get In Touch</h2>
                    <p class="font-bold text-xl text-blue">Do you need help? We'd love to hear from you. Here's how you can reach us</p>
                    <p class="font-semibold !mb-1 text-blue">Email: <a href="mailto:alex@alexmunrogolf.com">alex@alexmunrogolf.com</a></p>
                    <p class="font-semibold text-blue">Phone: <a href="tel:07960404806">07960404806</a></p>
                    <hr class="my-10 h-[2px] !text-blue"/>
                </div>
                <div class="col-span-7">
                    <div class="form-wrapper">
                        <?php echo do_shortcode('[mailpoet_form id="2"]'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<?php get_template_part('components/footer'); ?>