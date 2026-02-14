<?php $site_icon_url = get_site_icon_url( 150 );?>
<footer>
    <div class="container mx-auto py-[3rem]">
        <div class="grid grid-cols-12 items-center">
            <div class="col-span-2">
                <img class="max-w-[70px]" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
            </div>
            <div class="col-span-3">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer_menu'
                )); ?>
            </div>
            <div class="col-span-7">
                <img class="max-w-[220px] me-0 ms-auto" src="http://netgain-nutrition.local/wp-content/uploads/2025/05/payment_methods.png">
                <a class="block text-end text-base mt-2">info@netgainnutrition.co.uk</a>
                <a class="block text-end">07736171967</a>
            </div>
        </div>
    </div>
    <div class="bg-[var(--blue)] py-6">
        <div class="container mx-auto">
            <div class="flex items-center space-x-3 font-regular text-white">
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