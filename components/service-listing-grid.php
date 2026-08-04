<section class="py-6" x-data="{ show: false }" x-intersect:enter="show = true">
    <div class="container mx-auto transition-section" :class="show ? 'transition-section--visible' : ''">
        <div class="grid grid-cols-12 gap-4">
            <?php 
                $args = array(
                    'post_type'      => 'services',
                    'posts_per_page' => -1,         
                    'post_status'    => 'publish',
                );
                $services = new WP_Query($args);
                if ($services->have_posts())  { 
                while ($services->have_posts()) {
                    $services->the_post();
                    $thumbnail_id = get_post_thumbnail_id();
                    $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                    $price = get_field('service_price');
                    ?>
                    <div class="col-span-12 sm:col-span-6 lg:col-span-4 border border-[var(--blue)] rounded-lg p-5 bg-blue group">
                        <a href="<?php the_permalink(); ?>">
                            <div class="overflow-hidden aspect-[5/4] mb-5">
                                <img class="h-full rounded-md w-full object-cover group-hover:scale-[1.1] transition-transform duration-400" src="<?php echo $thumbnail_url ? $thumbnail_url[0] : 'http://localhost:10014/wp-content/uploads/2026/02/main_header.jpg' ?>" alt="<?php the_title() ?>" />
                            </div>
                            <h2 class="text-2xl mb-1 mt-4 font-bold text-white"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div>
                                <p class="text-white text-sm"><?php echo get_the_excerpt(); ?></p>
                                <div class="flex items-center justify-between border-t border-white pt-5 mt-5">
                                    <p class="text-xl font-semibold text-white"><?php echo $price; ?> </p>
                                    <div class="border-l border-blue ps-5">
                                    <?php get_template_part(
                                        'components/button',
                                        null,
                                        [
                                            'text' => 'Read More',
                                            'url'  => get_permalink(),
                                            'additional_classes' => 'sm:text-sm'
                                        ]
                                    ); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php  }  ?>
            <?php } ?>
        </div>
    </div>
</section>