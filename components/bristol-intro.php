<?php
$faqs = [
    [
        'q' => 'How much do golf lessons in Bristol cost?',
        'a' => '1 to 1 golf lessons are £55 per hour and junior golf coaching is £45 per hour. Online golf coaching starts from £30.',
    ],
    [
        'q' => 'Do you coach beginners as well as experienced golfers?',
        'a' => 'Yes. I coach golfers of all abilities, from complete beginners to competitive players, and every lesson is built around your own game and goals.',
    ],
    [
        'q' => 'Do you offer golf coaching for juniors?',
        'a' => 'Yes. My junior golf coaching in Bristol focuses on strong fundamentals, building confidence and enjoying the game.',
    ],
    [
        'q' => 'Can I have golf lessons online instead?',
        'a' => 'Yes. If you cannot get to Bristol, or simply prefer it, online golf coaching gives you personalised swing analysis and feedback from me through Skillest.',
    ],
];
?>
<section
    x-data="{ visible: false }"
    x-intersect="visible = true"
    :class="visible ? 'transition-section--visible' : ''"
    class="transition-section py-12 sm:py-20"
    >
    <div class="container mx-auto text-[var(--blue)]">
        <div class="max-w-3xl mx-auto text-center">
            <?php
                get_template_part(
                'components/internal-header',
                    null,
                    [
                        'text' => 'Golf Lessons in Bristol for Every Level',
                        'header_type' => 'h2',
                        'additional_classes' => 'mb-5'
                    ]
                );
            ?>
            <p class="text-lg mb-4">Looking for golf lessons in Bristol? I'm Alex Munro, a PGA Professional offering personalised golf coaching in Bristol for beginners, improvers, club golfers and competitive players.</p>
            <p class="text-lg">Every lesson starts with understanding how you play and what you want to achieve, so your coaching is built around you rather than a one-size-fits-all swing method. As a Level 2 TPI Certified Instructor I can also look at how your body moves, helping you improve faster while reducing the risk of injury.</p>
        </div>
    </div>
</section>

<?php
get_template_part('components/service-listing-grid');
wp_reset_postdata();
?>

<section
    x-data="{ visible: false, open: 0 }"
    x-intersect="visible = true"
    :class="visible ? 'transition-section--visible' : ''"
    class="transition-section py-12 sm:py-20"
    >
    <div class="container mx-auto text-[var(--blue)]">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-bold text-center mb-8">Golf Coaching in Bristol: Your Questions Answered</h2>
            <div class="space-y-3">
                <?php foreach ($faqs as $i => $faq) : ?>
                    <div class="border border-[var(--blue)] rounded-lg overflow-hidden bg-white">
                        <h3>
                            <button
                                type="button"
                                class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 text-lg font-semibold cursor-pointer"
                                :class="open === <?php echo $i; ?> ? 'bg-[var(--blue)] text-white' : ''"
                                :aria-expanded="(open === <?php echo $i; ?>).toString()"
                                aria-controls="faq-<?php echo $i; ?>"
                                @click="open = open === <?php echo $i; ?> ? null : <?php echo $i; ?>"
                                >
                                <span><?php echo esc_html($faq['q']); ?></span>
                                <svg class="shrink-0 transition-transform duration-300" :class="open === <?php echo $i; ?> ? 'rotate-180' : ''" aria-hidden="true" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                            </button>
                        </h3>
                        <div id="faq-<?php echo $i; ?>" x-show="open === <?php echo $i; ?>" x-transition.opacity style="display:none">
                            <p class="px-5 py-4"><?php echo esc_html($faq['a']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
