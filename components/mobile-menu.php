<nav id="mobileMenu" :class="{ 'mobile-menu--open': mobileMenuDisplay}" class="sm:hidden transition duration-400s top-[75px] fixed top-0 left-0 w-full bg-white z-50 h-full w-full">
    <div class="container mx-auto">
        <div class="text-2xl font-semibold py-8">
            <?php wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'fallback_cb' => false,
            )); ?>
        </div>
    </div>
</nav>