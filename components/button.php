<a 
    class="
    text-lg rounded-[50px] py-3 px-8 inline-block transition duration-300 border
    <?php echo $args['additional_classes'] ?>
    <?php echo $args['variant'] === 'secondary' ? 'bg-[var(--blue)] text-white hover:bg-white hover:text-[var(--blue)] border-[var(--blue)]' : 'border-white bg-white text-[var(--blue)] hover:bg-[var(--blue)] hover:text-white'; ?>" 
    href="<?php the_permalink(); ?>">
    <?php echo $args['text'] ?? 'Learn More'; ?>
</a>