<?php $site_icon_url = get_site_icon_url( 150 );?>
<header class="h-[95px] shadow-xl">
   <div class="container mx-auto relative h-full">
      <div class="grid grid-cols-12 items-center h-full">
         <div class="col-span-2">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
               <img class="max-w-[70px]" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
            </a>
         </div>
         <div class="col-span-10">
            <nav class="flex items-center justify-end space-x-5 text-sm">
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary_menu',
                    'fallback_cb' => false,
                )); ?>
                <?php
                    get_template_part(
                    'components/button',
                        null,
                        [
                            'text' => 'Contact Us',
                            'url'  => '/contact',
                            'variant' => 'secondary',
                            'additional_classes' => 'text-sm'
                        ]
                    );
                  ?>
            </nav>
         </div>
      </div>
   </div>
</header>