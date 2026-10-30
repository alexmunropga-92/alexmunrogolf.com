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
    <div class="container mx-auto sm:py-10 py-8">
        <div class="text-base sm:my-10 content-block">
            <div class="grid grid-cols-12 lg:mt-20 2xl:gap-20 lg:gap-10 gap-y-5">
                <div class="col-span-12 lg:col-span-5">
                    <h2 class="text-3xl lg:text-4xl">Get In Touch</h2>
                    <p class="font-bold text-lg lg:text-xl text-blue">Do you need help? We'd love to hear from you. Here's how you can reach us</p>
                    <p class="font-semibold !mb-1 text-blue">Email: <a href="mailto:alex@alexmunrogolf.com">alex@alexmunrogolf.com</a></p>
                    <p class="font-semibold text-blue">Phone: <a href="tel:07960404806">07960404806</a></p>
                    <hr class="my-10 h-[2px] !text-blue lg:block hidden"/>
                </div>
                <div class="col-span-12 lg:col-span-7">
                    <?php get_template_part('components/enquiry-form'); ?>
                </div>
            </div>

        </div>
    </div>
</section>



<?php get_template_part('components/footer'); ?>