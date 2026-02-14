<?php
/*
Template Name: Contact Page
*/
get_template_part('components/head');
get_template_part('components/header');
?>
<div class="container mx-auto py-10">
    <div class="text-base my-10 content-block">
        <div class="w-[60%]">
            <h1 class="text-4xl mb-2 font-bold text-[var(--blue)]"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>
        <div class="grid grid-cols-12 mt-20 gap-20">
            <div class="col-span-5">
                <p class="font-bold text-xl text-[var(--blue)]">Do you need help? We'd love to hear from you. Here's how you can reach us</p>
                <p class="font-semibold !mb-1 text-[var(--blue)]">Email: <a href="mailto:info@netgainnutrition.com">info@netgainnutrition.com</a></p>
                <p class="font-semibold text-[var(--blue)]">Phone: <a href="tel:07960404806">07960404806</a></p>
                <hr class="my-10 h-[2px] !text-[var(--blue)]"/>
                <p class="font-bold text-xl text-[var(--blue)]">Opening Hours</p>
                <p class="!mb-1 font-semibold text-[var(--blue)]">Monday to Thursday: 7:30am - 5:00pm</p>
                <p class="!mb-1 font-semibold text-[var(--blue)]">Fridays,: 7:30am - 4:00pm</p>
                <p class="font-semibold text-[var(--blue)]">Saturday & Sunday: Closed</p>

            </div>
            <div class="col-span-7">
                <?php echo do_shortcode('[wpforms id="137"]'); ?>
            </div>
        </div>

    </div>
</div>



<?php get_template_part('components/footer'); ?>