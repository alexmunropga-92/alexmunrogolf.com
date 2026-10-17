<?php
$content = $args['content'] ?? '';
?>
<section
    x-data="{ visible: false }"
    x-intersect="visible = true"
    :class="visible ? 'transition-section--visible' : ''"
    class="transition-section py-12 sm:py-20"
    >
    <div class="container mx-auto text-[var(--blue)]">
        <div class="max-w-3xl mx-auto text-center">
            <?php echo $content; ?>
        </div>
    </div>
</section>

<?php
get_template_part('components/service-listing-grid');
wp_reset_postdata();
?>
