<section class="sm:aspect-[2/1] sm:py-0 py-25 mt-20 overflow-hidden relative flex items-center parallax-section"> 
    <img fetchpriority="high" class="absolute object-cover top-0 left-0 h-full w-full" src="https://alexmunrogolf.com/wp-content/uploads/2026/02/main_header.jpg" />
    <div class="overlay-left"></div>
    <div class="container mx-auto relative z-20 text-white md:text-start text-center">
        <div class="md:w-2/3 text-white">
            <h1 class="sm:text-5xl text-4xl font-semibold mb-4"><?php the_title(); ?></h1>
            <div class="sm:text-xl text-md">
                <?php the_excerpt(); ?>
            </div>
            <br />
            <?php
                get_template_part(
                'components/button',
                    null,
                    [
                        'text' => 'Get In Touch',
                        'url'  => '/contact',
                    ]
                );
            ?>
        </div>
    </div>
</section>