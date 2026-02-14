<?php
get_template_part('components/head');
get_template_part('components/header');
?>
<?php get_template_part('components/page-header'); ?>
<div class="container mx-auto">
    <div class="grid grid-cols-12 py-10 gap-10">
        <div class="col-span-4">
            <?php if ( has_post_thumbnail() ) { ?>
                <img
                    class="h-full border-2 border-[var(--blue)] rounded-md w-full object-cover"
                    src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>"
                    alt="<?php echo esc_attr( get_the_title() ); ?>"
                />
            <?php } else { ?>
                <img class="max-w-[70px]" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Site Icon">
            <?php } ?>
        </div>
        <div class="col-span-8">
            <div class="text-lg">
                <h2 class="text-3xl font-bold text-[var(--blue)] mb-4" >About <?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
            </div>
        </div>
    </div>
</div>
<?php

$coach_id = get_the_ID();
$coach_name = get_the_title();
$posts = get_posts(array(
    'post_type' => 'coaching-camps',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => 'camp_coach',    
            'value'   => '"' . $coach_id . '"', 
            'compare' => 'LIKE'
        ]
    ]
));
get_template_part('components/camp-row', null, [
    'posts' => $posts,
    'camp_row_header' => "Coach Camps Run By $coach_name",
]);

?>
<?php get_template_part('components/footer'); ?>


