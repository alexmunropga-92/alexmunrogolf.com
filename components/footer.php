<?php $site_icon_url = get_site_icon_url( 150 );?>
<footer>
    <div class="container mx-auto py-8 sm:py-[3rem]">
        <div class="grid grid-cols-12 items-center text-center sm:text-start gap-y-5 sm:gap-0">
            <div class="col-span-12 sm:col-span-2">
                <img class="max-w-[70px] mx-auto sm:ms-0" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
            </div>
            <div class="col-span-12 sm:col-span-5 text-sm md:text-base">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer_menu',
                    'fallback_cb' => false,
                )); ?>
            </div>
            <div class="col-span-12 sm:col-span-5">
                <a class="block sm:text-end text-base mt-2 text-sm md:text-base">alex@alexmunrogolf.com</a>
                <a class="block sm:text-end text-sm md:text-base">07960404806</a>
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
                <p>Privacy Policy</p>
                <span>/</span>
                <p>Cookie Policy</p>
                <span>/</span>
                <p>Terms & Conditions</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>