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
<?php $current_post_id = get_the_ID(); ?>
<?php $related_posts = get_field('associated_articles', $current_post_id); ?>
<?php $hide_featured_image = get_field('hide_featured_image', $current_post_id); ?>

<?php get_template_part('components/page-header',
    null,
    [
        'image' => $banner_image,
    ]); 
?>
<section>
    <div class="container mx-auto sm:max-w-2xl">
        <div class="grid grid-cols-12 xl:py-20 py-8 lg:gap-x-8">
            <div class="col-span-12 lg:col-span-8">
                <div class="prose !max-w-none text-blue [&>h3]:text-blue [&>h2]:text-blue">
                    <?php if($image_url && $hide_featured_image == 'no') { ?>
                        <div class="overflow-hidden aspect-square rounded-md">
                            <img class="rounded-md w-full h-full object-cover !my-0" src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" />
                        </div>
                    <?php } ?>
                    <div class="block lg:hidden">
                        <p class="font-semibold text-blue mb-2">By Alex Munro</p>
                        <?php get_template_part('components/social-icon-row'); ?>
                    </div>
                    <?php the_content(); ?>
                </div>
                <?php $blog_link = get_field('blog_link'); ?>
                <?php $blog_link_text = $blog_link['blog_link_text']; ?>
                <?php $blog_link_url = $blog_link['blog_link_url']; ?>
                <?php
                    get_template_part(
                    'components/button',
                        null,
                        [
                            'text' => $blog_link_text ? $blog_link_text : 'Get In Touch',
                            'url'  => $blog_link_url ? $blog_link_url : '/contact',
                            'variant' => 'secondary',   
                            'additional_classes' => 'mt-8'
                        ]
                    );
                ?>
            </div>
            <div class="col-span-4 lg:block hidden">
                <?php get_template_part('components/blog-sidebar', null, [
                    'related_posts' => $related_posts,
                ]); ?>
            </div>
        </div>
        <div class="block lg:hidden">
            <?php get_template_part('components/related-articles-row', null, [
                'related_posts' => $related_posts,
            ]); ?>
        </div>
    </div>
</section>
<?php get_template_part('components/newsletter'); ?>
<?php get_template_part('components/footer'); ?>