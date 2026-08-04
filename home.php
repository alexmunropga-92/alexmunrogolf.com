<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php 
$banner_image = get_field('banner_image', 54); 
get_template_part('components/page-header', null, [
    'image' => $banner_image,
    'custom_title' => 'Blog'
]); 
?>

<?php get_template_part('components/blog-filters'); ?>

<section>
    <div class="container mx-auto">
        <?php get_template_part('components/blog-listing-grid'); ?>
    </div>
</section>

<?php get_template_part('components/footer'); ?>