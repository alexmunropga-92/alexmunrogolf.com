<?php 

$article_count = $args['article_count'] ?? 3;
?>
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
                        'text' => 'Tips & Advice',
                        'header_type' => 'h2'
                    ]
                );
            }
        ?>
        <div class="blog-swiper swiper">
            <div class="swiper-wrapper">
                <?php 
                    $blog_query = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => $article_count,
                        'orderby'        => 'date',
                    ]);

                    while($blog_query->have_posts()) {
                        $blog_query->the_post() ?>

                    <?php
                    $thumbnail_id = get_post_thumbnail_id();
                    $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                    ?>
                    
                    <div class="swiper-slide border border-blue bg-blue rounded-lg p-3 sm:p-5">
                        <div class="overflow-hidden aspect-[5/4]">
                            <img class="h-full rounded-md w-full object-cover" src="<?php echo $thumbnail_url[0]; ?>" alt="<?php the_title() ?>" />
                        </div>
                        <div class="p-2 sm:py-0">
                            <h2 class="text-xl sm:text-2xl sm:min-h-25 mb-1 mt-4 font-bold text-white"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="text-md sm:text-lg font-semibold mb-2 text-white"><?php the_time('d M Y'); ?></p>
                            <div class="py-2 sm:py-0 text-white">
                                <p><?php the_excerpt(); ?></p>
                                <?php get_template_part(
                                    'components/button',
                                    null,
                                    [
                                        'text' => 'Read More',
                                        'url'  => get_permalink(),
                                        'additional_classes' => '!text-sm mt-5'
                                    ]
                                ); ?>
                            </div>
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