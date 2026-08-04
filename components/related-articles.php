<?php $related_posts = $args['related_posts'] ?? null; ?>
<?php if($related_posts) { ?>
    <div class="mt-15">
        <h3 class="text-xl font-bold text-blue mb-4">Related Articles</h3>
        <div class="flex flex-col">
            <?php foreach($related_posts as $post) { ?>
                <div class="mb-2 border border-blue rounded-md p-3">
                    <div class="flex space-x-4 items-center">
                        <div class="text-blue w-1/2">
                            <p class="text-xs font-semibold"><?php echo get_the_date(); ?></p>
                            <h4 class="font-semibold text-md"><?php echo get_the_title($post->ID); ?></h4>
                            <?php get_template_part('components/button', 
                                null,
                                [
                                    'text' => 'Read More',
                                    'url' => get_permalink($post->ID),
                                    'variant' => 'secondary',
                                    'additional_classes' => '!text-sm !py-2 !px-4 mt-3'
                                ]
                            ); ?>
                        </div>
                        <div class="aspect-square w-1/2 overflow-hidden rounded-md">
                            <img class="h-full rounded-md w-full object-cover" src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php echo get_the_title($post->ID); ?>" />
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>