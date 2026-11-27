<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php 
$banner_image = get_field('banner_image', 54); 
get_template_part('components/page-header', null, [
    'image' => $banner_image,
    'custom_title' => get_the_title(84),
]); 
?>

<div class="container mx-auto">
    <div class="prose py-8 md:py-12 max-w-none">
        <?php
        $content = get_post_field('post_content', 84);
        echo apply_filters('the_content', $content);
        ?>
    </div>
</div>

<?php get_template_part('components/service-listing-grid'); ?>

<?php get_template_part('components/footer'); ?>