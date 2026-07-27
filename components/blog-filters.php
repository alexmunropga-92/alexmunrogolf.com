<?php
    $archive = $args['archive'] ?? null;
?>

<section>
    <div class="container mx-auto">
        <div class="border-b border-blue/[50%] pb-4 pt-6 sm:flex justify-between items-center">
            <h3>Filter by Category</h3>
            <div class="flex space-x-2">
                <?php 
                    $categories = get_categories();
                    foreach($categories as $category) { ?>
                        <span class="tag <?php if (isset($archive) && $category->name == $archive->name) { ?> bg-white text-blue <?php } ?>">
                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                <?php echo $category->name; ?>
                            </a>
                        </span>
                    <? } ?>
            </div>
        </div>
    </div>
</section>