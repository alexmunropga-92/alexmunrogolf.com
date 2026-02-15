<?php
/*
Template Name: Basic Page
*/
?>

<?php
get_template_part('components/head');
get_template_part('components/header');
?>

<?php get_template_part('components/page-header'); ?>
<section class="py-12">
    <div class="container mx-auto">
        <div class="flex space-x-10 items-center">
            <div class="">
                <img class="max-w-full h-auto h-[200px] w-[200px]" alt="alex munro" height="200" width="200" src="http://localhost:10014/wp-content/uploads/2026/02/alex.jpg" />
            </div>
            <div class="text-md text-[var(--blue)]">
                <?php 
                    get_template_part(
                    'components/internal-header',
                        null,
                        [
                            'text' => 'Alex Munro',
                            'header_type' => 'h2',
                            'additional_classes' => 'mb-5'
                        ]
                    );
                ?>
                <p>PGA Professional</p>
                <p>Level 2 PGA Coach</p>
                <p>Level 2 TPI Certified Instructor</p>
            </div>
        </div>
    </div>
</section>




<?php get_template_part('components/footer'); ?>