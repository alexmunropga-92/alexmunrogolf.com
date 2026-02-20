<section>
    <div class="container mx-auto">
        <div class="border-b border-blue/[50%] pb-4 pt-6 flex justify-between items-center">
            <h3>Filter by Category</h3>
            <ul>
                <?php 
                    $categories = get_categories();
                    foreach($categories as $category) {
                        echo '<li class="tag"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</section>