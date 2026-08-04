<?php $site_icon_url = get_site_icon_url( 150 );?>
<header class="shadow-xl py-1">
   <div  x-data="{ mobileNavToggle: false, mobileMenuDisplay:false }" class="container mx-auto relative h-full">
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
            <div id="mobileNavToggle" @click="mobileNavToggle = !mobileNavToggle, mobileMenuDisplay = !mobileMenuDisplay" class="ms-auto me-0 float-right sm:hidden"
               :class="{ 'mobile-menu-toggle--open': mobileNavToggle }">
               <div class="icon-bar bg-blue h-1 w-8 mb-1 relative"></div>
               <div class="icon-bar bg-blue h-1 w-8 mb-1 relative"></div>
               <div class="icon-bar bg-blue h-1 w-8 mb-1 relaitve"></div>
            </div>
            <?php get_template_part('components/mobile-menu'); ?>
         </div>
      </div>
   </div>
</header>