<?php
$args = $args ?? [];
$text = $args['text'] ?? 'Learn More';
$url = $args['url'] ?? home_url('/');
$variant = $args['variant'] ?? 'primary';
$additional_classes = $args['additional_classes'] ?? '';
?>

<a 
    class="
    sm:text-lg text-md rounded-[50px] sm:py-3 py-2 sm:px-8 px-6 inline-block transition duration-300 border
    <?php echo $additional_classes; ?>
    <?php echo $variant === 'secondary' ? 'bg-blue text-white hover:bg-white hover:text-[var(--blue)] border-[var(--blue)]' : 'border-white bg-white text-[var(--blue)] hover:bg-[var(--blue)] hover:text-white'; ?>" 
    href="<?php echo $url; ?>">
    <?php echo $args['text'] ?? 'Learn More'; ?>
</a>