<?php /* Blog */ ?>
<section class="py-6" x-data="{ show: false }" x-intersect:enter="show = true">
    <div class="container mx-auto transition-section" :class="show ? 'transition-section--visible' : ''">
        <?php
            if(!isset($args['display_header'])) {
                // do nothing
            } else {
                get_template_part(
                    'components/internal-header',
                    null,
                    [
                        'text' => 'Tips & Advice',
                        'header_type' => 'h2'
                    ]
                );
            }
        ?>
        <div class="grid grid-cols-12 gap-4 my-10">
            <?php 
                while(have_posts()) {
                the_post() ?>

                <?php
                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                ?>
                
                <div class="col-span-4 border border-[var(--blue)] rounded-lg p-5">
                    <div class="overflow-hidden h-[200px]">
                        <img class="h-full rounded-md w-full object-cover" src="<?php echo $thumbnail_url[0]; ?>" alt="<?php the_title() ?>" />
                    </div>
                    <h2 class="text-2xl mb-1 mt-4 font-bold text-[var(--blue)]"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="text-lg font-semibold mb-2 text-[var(--blue)]"><?php the_time('d M Y'); ?></p>
                    <div>
                        <p class="text-[var(--blue)]"><?php the_excerpt(); ?></p>
                        <a class="hover:bg-white transition duration-300 hover:text-[var(--blue)] border border-[var(--blue)] mt-5 text-white rounded-md inline-block bg-[var(--blue)] py-2 px-4" href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                </div>
            <?php  }  ?>
        </div>
    </div>
</section>