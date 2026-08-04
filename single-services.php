<?php
/*
Template Name: Basic Page
*/
?>

<?php
get_template_part('components/head');
get_template_part('components/header');
?>
<?php $banner_image = get_field('banner_image'); ?>
<?php $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
<?php get_template_part('components/page-header',
    null,
    [
        'image' => $banner_image,
    ]); 
?>
<section class="md:py-12 py-8">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 md:gap-10 gap-y-8">
            <?php if($image_url) { ?>
                <div class="md:col-span-4 col-span-12">
                    <div class="overflow-hidden rounded-md">
                        <img class="rounded-md" src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" />
                    </div>
                </div>
            <?php } ?>
            <div class="<?php echo $image_url ? 'md:col-span-8 col-span-12' : 'col-span-12' ?>">
                <div class="prose max-w-none text-blue [&>h3]:text-blue [&>h2]:text-blue">
                    <?php the_content(); ?>
                </div>
                <?php
                    get_template_part(
                    'components/button',
                        null,
                        [
                            'text' => 'Book Now',
                            'url'  => 'https://launchacademybristol.as.me/schedule/b5b7e2b4/?calendarIds=13800920',
                            'variant' => 'secondary',
                            'additional_classes' => 'mt-10'
                        ]
                    );
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('components/service-row', null, [
    'display_header' => true,
    'header' => 'Other Services'
]); ?>
<?php get_template_part('components/footer'); ?>