<?php get_template_part('components/head'); ?>
<?php get_template_part('components/header'); ?>

<?php 
$banner_image = get_field('banner_image', 54); 
get_template_part('components/page-header', null, [
    'image' => $banner_image,
]); 
?>

<?php get_template_part('components/service-row'); ?>

<?php get_template_part('components/footer'); ?>