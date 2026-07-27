<?php $related_posts = $args['related_posts'] ?? null; ?>
<?php if($related_posts) { ?>
    <section class="sm:py-12 py-8" x-data="{ show: false }" x-intersect:enter="show = true">
        <div class="container mx-auto transition-section" :class="show ? 'transition-section--visible' : ''">
            <?php
                if(!isset($args['display_header'])) {
                    // do nothing
                } else {
                    get_template_part(
                        'components/internal-header',
                        null,
                        [
                            'text' => 'Related Articles',
                            'header_type' => 'h2'
                        ]
                    );
                }
            ?>
            <div class="blog-swiper swiper">
                <div class="swiper-wrapper">
                    <?php foreach($related_posts as $post) { ?>
                        <div class="swiper-slide border border-blue rounded-lg p-5">
                            <div class="overflow-hidden aspect-[5/4]">
                                <img class="h-full rounded-msd w-full object-cover" src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" />
                            </div>
                            <h2 class="text-xl sm:text-2xl sm:min-h-25 mb-1 mt-4 font-bold text-[var(--blue)]"><a href="<?php get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h2>
                            <p class="text-md sm:text-lg font-semibold mb-2 text-[var(--blue)]"><?php the_time('d M Y'); ?></p>
                            <div>
                                <p class="text-[var(--blue)]"><?php the_excerpt(); ?></p>
                                <?php get_template_part(
                                    'components/button',
                                    null,
                                    [
                                        'text' => 'Read More',
                                        'url'  => get_permalink(),
                                        'additional_classes' => 'text-sm mt-5',
                                        'variant' => 'secondary'
                                    ]
                                ); ?>
                            </div>
                        </div>
                    <?php  }  ?>
                </div>
                <div class="swiper-pagination mt-5"></div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const swiper = new Swiper('.blog-swiper', {
                loop: true,
                slidesPerView: 3,
                spaceBetween: 10,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        centredSlides: true,
                    },
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
        </script>
    </section>
<?php } ?>