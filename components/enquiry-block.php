<?php
$args = $args ?? [];
$heading = $args['heading'] ?? 'Make an Enquiry';
$intro = $args['intro'] ?? 'Interested in lessons or have a question? Send me a message and I\'ll get back to you as soon as possible.';
$additional_classes = $args['additional_classes'] ?? '';
?>
<section
    id="enquiry"
    x-data="{ show: false }"
    x-intersect:enter="show = true"
    class="enquiry-block bg-blue py-12 sm:py-20 <?php echo esc_attr($additional_classes); ?>"
    >
    <div class="container mx-auto transition-section" :class="show ? 'transition-section--visible' : ''">
        <div class="grid grid-cols-12 gap-y-8 md:gap-x-12">
            <div class="col-span-12 md:col-span-5 text-center md:text-start">
                <?php
                    get_template_part(
                    'components/internal-header',
                        null,
                        [
                            'text' => $heading,
                            'header_type' => 'h2',
                            'additional_classes' => '!text-white mb-5'
                        ]
                    );
                ?>
                <p class="text-white text-lg mb-6"><?php echo esc_html($intro); ?></p>
                <p class="text-white font-semibold !mb-1">Email: <a href="mailto:alex@alexmunrogolf.com">alex@alexmunrogolf.com</a></p>
                <p class="text-white font-semibold">Phone: <a href="tel:07960404806">07960404806</a></p>
            </div>
            <div class="col-span-12 md:col-span-7">
                <div class="form-wrapper">
                    <?php echo do_shortcode('[mailpoet_form id="2"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
