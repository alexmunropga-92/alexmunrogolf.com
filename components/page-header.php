<div class="overlay bg-cover bg-no-repeat relative py-22" style="background-image: url(<?php echo $args['image']['url']; ?>);">
    <div class="container mx-auto relative text-white text-xl relative z-10">
        <h1 class="text-white mb-5 text-5xl font-semibold">
            <?php if(isset( $args['custom_title'])) {
                echo  $args['custom_title'];
            } else {
                the_title(); 
            } ?>
        </h1>
    </div>
</div>