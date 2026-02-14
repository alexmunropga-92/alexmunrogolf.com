<?php
get_template_part('components/head');
get_template_part('components/header');
?>
<?php get_template_part('components/page-header'); ?>
<?php $camp_date = get_field('camp_date'); ?>
<?php $camp_price = get_field('coaching_camp_price'); ?>
<?php $camp_coaches = get_field('camp_coach'); ?>
<?php $first_coach = $camp_coaches[0]; ?>

    <div class="container mx-auto">
        <div class="grid grid-cols-12 py-12 gap-x-10">
            <div class="col-span-5">
                <div class="p-4 border border-[var(--blue)] rounded-md overflow-hidden">
                    <img
                        class="h-full w-full h-auto rounded-md "
                        src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>"
                        alt="<?php echo esc_attr( get_the_title() ); ?>"
                    />
                </div>
            </div>
            <div class="col-span-7">
                <div class="flex flex-col gap-y-4">
                    <h1 class="text-4xl text-[var(--blue)] mb-5 font-bold"><?php the_title(); ?></h1>
                    <p class="text-2xl text-[var(--blue)] font-bold" >Date: <?php echo $camp_date; ?></p> 
                    <p class="text-2xl text-[var(--blue)] font-bold" >Price: £<?php echo $camp_price; ?></p> 
                    <p class="text-2xl text-[var(--blue)] font-bold" >Lead Coach: <?php echo get_the_title( $first_coach->ID ); ?></p> 

                </div>
            </div>
        </div>
    </div>
<?php get_template_part('components/footer'); ?>