<nav
    id="mobileMenu"
    aria-label="Mobile menu"
    :class="{ 'mobile-menu--open': open }"
    :style="{ top: headerHeight + 'px' }"
    @click="if ($event.target.closest('a')) close()"
    class="sm:hidden fixed inset-x-0 bottom-0 bg-white z-50 overflow-y-auto"
    >
    <div class="container mx-auto">
        <div class="text-2xl font-semibold py-8">
            <?php wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'fallback_cb' => false,
                'ajm_mobile_menu' => true,
            )); ?>
        </div>
        <div class="pb-10 px-2">
            <?php
                get_template_part(
                'components/button',
                    null,
                    [
                        'text' => 'Book Now',
                        'url'  => 'https://launchacademybristol.as.me/schedule/b5b7e2b4/?calendarIds=13800920',
                        'variant' => 'secondary',
                    ]
                );
            ?>
        </div>
    </div>
</nav>
