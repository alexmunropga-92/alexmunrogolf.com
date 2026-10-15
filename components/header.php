<?php $site_icon_url = get_site_icon_url( 150 );?>
<header class="shadow-xl py-1 fixed top-0 left-0 w-full z-100 bg-white">
   <div
      x-data="{
         open: false,
         headerHeight: 0,
         setHeaderHeight() { this.headerHeight = this.$root.closest('header').offsetHeight },
         toggle() { this.setHeaderHeight(); this.open = !this.open },
         close() { this.open = false }
      }"
      x-init="setHeaderHeight()"
      x-effect="document.documentElement.style.overflow = open ? 'hidden' : ''"
      @keydown.escape.window="close()"
      @resize.window="setHeaderHeight(); if (window.innerWidth >= 640) close()"
      class="container mx-auto relative h-full"
      >
      <div class="grid grid-cols-12 items-center h-full">
         <div class="col-span-2">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
               <img class="max-w-[70px]" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
            </a>
         </div>
         <div class="col-span-10">
            <nav class="hidden sm:flex items-center justify-end space-x-5 text-sm">
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary_menu',
                    'fallback_cb' => false,
                )); ?>
               <?php
                    get_template_part(
                    'components/button',
                        null,
                        [
                            'text' => 'Book Now',
                            'url'  => 'https://launchacademybristol.as.me/schedule/b5b7e2b4/?calendarIds=13800920',
                            'variant' => 'secondary',
                            'additional_classes' => 'text-sm'
                        ]
                    );
               ?>
            </nav>
            <button
               id="mobileNavToggle"
               type="button"
               @click="toggle()"
               aria-controls="mobileMenu"
               :aria-expanded="open.toString()"
               :aria-label="open ? 'Close menu' : 'Open menu'"
               aria-label="Open menu"
               class="ms-auto me-0 float-right sm:hidden p-2 -me-2 cursor-pointer"
               :class="{ 'mobile-menu-toggle--open': open }"
               >
               <span class="icon-bar block bg-blue h-1 w-8 mb-1 relative"></span>
               <span class="icon-bar block bg-blue h-1 w-8 mb-1 relative"></span>
               <span class="icon-bar block bg-blue h-1 w-8 relative"></span>
            </button>
            <?php get_template_part('components/mobile-menu'); ?>
         </div>
      </div>
   </div>
</header>
