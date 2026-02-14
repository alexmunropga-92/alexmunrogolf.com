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
            <nav class="flex items-center justify-end">
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary_menu'
                )); ?>
                <a class="py-2 ms-4 px-6 border border-green-700 rounded-[50px]">Contact</a>
            </nav>
         </div>
      </div>
   </div>
</header>