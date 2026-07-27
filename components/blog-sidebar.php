<?php $related_posts = $args['related_posts'] ?? null; ?>
<div class="sticky top-10">
    <p class="font-semibold text-blue mb-4">By Alex Munro</p>
    <?php get_template_part('components/social-icon-row'); ?>
    <?php get_template_part('components/related-articles', null, [
        'related_posts' => $related_posts,
    ]); ?>
</div>