<section class="aspect-[2/1] overflow-hidden relative flex items-center parallax-section" style="background-image:url('http://localhost:10014/wp-content/uploads/2026/02/main_header.jpg')"> 
    <div class="overlay-left"></div>
    <div class="container mx-auto relative z-20 text-white">
        <div class="w-2/3 text-white text-xl">
            <h1 class="text-5xl font-semibold mb-4"><?php the_title(); ?></h1>
            <?php the_excerpt(); ?>
            <br />
            <?php get_template_part('components/button'); ?>
        </div>
    </div>
</section>