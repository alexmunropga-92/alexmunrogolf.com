<?php  $content = $args['content'] ?? ''; ?>
<section
    x-data="{ visible: false }"
    x-intersect="visible = true"
    :class="visible ? 'transition-section--visible' : ''"
    class="transition-section"
    >
    <div class="container mx-auto md:mt-12 mt-8">
        <div class="grid grid-cols-12 md:gap-x-12 items-center">
            <div class="col-span-12 md:col-span-5 order-2 md:order-1">
                <div class="max-w-[300px] md:max-w-none mx-auto sm:mt-0 mt-5">
                    <img class="h-auto w-full" src="https://alexmunrogolf.com/wp-content/uploads/2026/02/alex_image.png" alt="Alex Munro, PGA Professional golf coach in Bristol" class="w-full rounded-md object-cover">
                </div>
            </div>
            <div class="col-span-12 md:col-span-7 order-1 md:order-2">
                <div class="prose text-center md:text-start">
                    <?php echo $content; ?>
                </div>
                <?php
                    get_template_part(
                    'components/button',
                        null,
                        [
                            'text' => 'Book a free consultation',
                            'url'  => 'https://calendar.google.com/calendar/appointments/schedules/AcZssZ13o6dJT_13Qh86pyu-Olb5G7PHJaiNbl20-9iph3P7DsQgcJoE5_OWtrH1sq2WO0VX3gcI1RxX',
                            'variant' => 'secondary',
                            'additional_classes' => 'mt-8',
                            'additional_attributes' => 'target="_blank"'
                        ]
                    );
               ?>
            </div>
        </div>
    </div>
</section>