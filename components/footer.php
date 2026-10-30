<?php $site_icon_url = get_site_icon_url( 150 );?>
<?php
    // Enquiry form on every page, except the contact page which already has its own form
    if (!is_page_template('page-contact.php') && !is_page('contact')) {
        get_template_part('components/enquiry-block');
    }
    get_template_part('components/enquiry-thank-you');
?>
<footer>
    <div class="container mx-auto py-8 sm:py-[3rem]">
        <div class="grid grid-cols-12 items-center text-center sm:text-start gap-y-5 sm:gap-0">
            <div class="col-span-12 sm:col-span-2">
                <img height="70" width="70" class="max-w-[70px] mx-auto sm:ms-0" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
            </div>
            <div class="col-span-12 sm:col-span-5 text-sm md:text-base">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer_menu',
                    'fallback_cb' => false,
                )); ?>
            </div>
            <div class="col-span-12 sm:col-span-5">
                <a href="mailto:alex@alexmunrogolf.com"class="block sm:text-end text-base mt-2 text-sm md:text-base">alex@alexmunrogolf.com</a>
                <a href="tel:07960404806" class="block sm:text-end text-sm md:text-base">07960404806</a>
                <?php get_template_part('components/social-icon-row', 
                    null,
                    [
                        'additional_classes' => 'justify-center sm:justify-end mt-4'
                    ]
                ); ?>
            </div>
        </div>
    </div>
    <div class="bg-[var(--blue)] py-6">
        <div class="container mx-auto">
            <div class="flex items-center justify-center sm:justify-start space-x-3 font-regular text-white text-sm sm:text-base">
                <p><a href="/privacy-policy">Privacy Policy</a></p>
                <span>/</span>
                <p><a href="/cookie-policy">Cookie Policy</a></p>
                <span>/</span>
                <p><a href="/terms-and-conditions">Terms & Conditions</a></p>
            </div>
            <div class="text-white mt-4">
                <?php echo get_option('ajm_address', ajm_default_address()); ?>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>