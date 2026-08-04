<section class="sm:py-12 py-8" x-data="{ show: false }" x-intersect:enter="show = true">
    <div class="container mx-auto transition-section" :class="show ? 'transition-section--visible' : ''">
            <div class="grid grid-cols-12 gap-4">
            <?php 
                $blog_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                ]);

                while($blog_query->have_posts()) {
                    $blog_query->the_post() ?>

                <?php
                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                ?>
                
                <div class="col-span-12 sm:col-span-6 lg:col-span-4 border border-blue rounded-lg p-3 sm:p-5">
                    <div class="overflow-hidden aspect-[5/4]">
                        <img class="h-full rounded-msd w-full object-cover" src="<?php echo $thumbnail_url ? $thumbnail_url[0] : 'http://localhost:10014/wp-content/uploads/2026/02/main_header.jpg' ?>" alt="<?php the_title() ?>" />
                    </div>
                    <div class="p-2 sm:py-0">
                        <h2 class="text-xl sm:text-2xl sm:min-h-25 mb-1 mt-4 font-bold text-[var(--blue)]"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="text-md sm:text-lg font-semibold mb-2 text-[var(--blue)]"><?php the_time('d M Y'); ?></p>
                        <div>
                            <p class="text-[var(--blue)]"><?php the_excerpt(); ?></p>
                            <?php get_template_part(
                                'components/button',
                                null,
                                [
                                    'text' => 'Read More',
                                    'url'  => get_permalink(),
                                    'additional_classes' => '!text-sm mt-5',
                                    'variant' => 'secondary'
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>
            <?php  }  ?>
        </div>
    </div>
</section>