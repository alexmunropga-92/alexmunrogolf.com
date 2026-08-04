<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php $archive = get_queried_object();?>
<?php 
$banner_image = get_field('banner_image', 54); 
get_template_part('components/page-header', null, [
    'image' => $banner_image,
    'custom_title' => "Blog - $archive->name" 
]); 
?>

<?php get_template_part('components/blog-filters', null, [
    'archive' => $archive
]); ?>

<section>
    <div class="container mx-auto">
        <?php get_template_part('components/blog-listing-grid'); ?>
    </div>
</section>

<?php get_template_part('components/footer'); ?>