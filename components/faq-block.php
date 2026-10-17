<?php
    $faqs = get_posts([
        'post_type'      => 'faq',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
    ]);
?>

<?php
    // Add FAQ schema markup if there are FAQs, pass it to functions.php to print in the head
    if ($faqs) {
        ajm_print_schema([
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(function ($faq) {
                return [
                    '@type'          => 'Question',
                    'name'           => get_the_title($faq),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => trim(wp_strip_all_tags(apply_filters('the_content', $faq->post_content))),
                    ],
                ];
            }, $faqs),
        ]);
    }
?>

<section
    x-data="{ visible: false, open: 0 }"
    x-intersect="visible = true"
    :class="visible ? 'transition-section--visible' : ''"
    class="transition-section py-12 sm:py-20"
    >
    <div class="container mx-auto text-[var(--blue)]">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-bold text-center mb-8">Your Questions Answered</h2>
            <div class="space-y-3">
                <?php foreach ($faqs as $i => $faq) : ?>
                    <div class="border border-[var(--blue)] rounded-lg overflow-hidden bg-white">
                        <h3 class="mb-0">
                            <button
                                type="button"
                                class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 text-lg font-semibold cursor-pointer"
                                :class="open === <?php echo $i; ?> ? 'bg-[var(--blue)] text-white' : ''"
                                :aria-expanded="(open === <?php echo $i; ?>).toString()"
                                aria-controls="faq-<?php echo $i; ?>"
                                @click="open = open === <?php echo $i; ?> ? null : <?php echo $i; ?>"
                                >
                                <span><?php echo esc_html(get_the_title($faq)); ?></span>
                                <svg class="shrink-0 transition-transform duration-300" :class="open === <?php echo $i; ?> ? 'rotate-180' : ''" aria-hidden="true" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                            </button>
                        </h3>
                        <div id="faq-<?php echo $i; ?>" x-show="open === <?php echo $i; ?>" x-transition.opacity style="display:none">
                            <div class="px-5 py-4 space-y-3"><?php echo apply_filters('the_content', $faq->post_content); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>