<div class="col-span-3">
    <form method="GET" class="my-15">
        <select name="location" onchange="this.form.submit()" class="p-3 border border-[var(--primary)] rounded min-w-[300px]">
            <option value="">Filter by Location</option>
            <?php foreach ( $locations as $term ) : ?>
                <option value="<?php echo esc_attr($term->slug); ?>" <?php selected( $_GET['location'] ?? '', $term->slug ); ?>>
                    <?php echo esc_html($term->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>