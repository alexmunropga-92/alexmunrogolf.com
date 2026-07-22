<section x-data="{show: false}" x-intersect:enter="show = true" class="overlay bg-cover bg-no-repeat relative py-12 sm:py-20 lg:py-40 bg-[url('http://localhost:10014/wp-content/uploads/2026/02/newsletter_background.jpg')]">
    <div class="container mx-auto relative z-20 text-center transition-section" :class="show ? 'transition-section--visible' : ''">
            <?php
                get_template_part(
                'components/internal-header',
                    null,
                    [
                        'text' => 'Subscribe to our newsletter for the latest tips and updates.',
                        'header_type' => 'h2',
                        'additional_classes' => 'text-white mb-5'
                    ]
                ); 
            ?>
        <?php echo do_shortcode('[mailpoet_form id="1"]'); ?>
    </div>
</section>