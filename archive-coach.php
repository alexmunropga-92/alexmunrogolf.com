<?php

get_template_part('components/head');
get_template_part('components/header');
?>
<div class="container mx-auto">
    <?php
        //Define Arguments
        $args = array(
            'post_type' => 'coach',
            'posts_per_page' => 5, // Change as needed
            'post_status' => 'publish'
        );
        //Create new instance of WP Query
        $loop = new WP_Query($args);

        while($loop->have_posts()) {
            $loop->the_post();
        ?>
            <div class="grid grid-cols-12 py-10 border-b border-[var(--blue)] gap-10 items-center">
                <div class="col-span-4">
                    <div class="overflow-hidden h-[300px]">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <img
                                class="h-full rounded-md w-full object-cover"
                                src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>"
                                alt="<?php echo esc_attr( get_the_title() ); ?>"
                            />
                        <?php } else { ?>
                            <img class="max-w-[70px]" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-span-8">
                    <h3 class="text-2xl text-[var(--blue)] mb-5 font-semibold"><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                    <a class="hover:bg-white transition duration-300 hover:text-[var(--blue)] border border-[var(--blue)] mt-5 text-white rounded-md inline-block bg-[var(--blue)] py-2 px-4" href="<?php the_permalink(); ?>">Read More</a>
                </div>
            </div>
        <?php
        }
    ?>
</div>

<?php get_template_part('components/footer'); ?>