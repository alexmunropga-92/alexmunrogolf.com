<?php
    $text = $args['text'] ?? '';
    $header_type = $args['header_type'] ?? 'h2';
    $additional_classes = $args['additional_classes'] ?? '';
?>
<<?php echo $header_type; ?> class="font-bold text-[var(--blue)] <?php echo $additional_classes; ?>" ><?php echo $text; ?></h2></<?php echo $header_type; ?>>