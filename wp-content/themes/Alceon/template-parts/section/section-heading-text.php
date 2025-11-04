<?php

/**
 * Reusable Text Intro Section
 *
 * Checks for 'is_flexible' arg to determine context.
 *
 * @param array $args {
 * @type bool $is_flexible Is this loaded inside a Flexible Content loop?
 * }
 */

// 1. Check for flexible content context
$is_flexible = isset($args['is_flexible']) && $args['is_flexible'];

// 2. Set variables using the correct ACF function
// *** IMPORTANT: Change 'heading' and 'text' to your actual ACF field names ***
$ht_heading = $is_flexible ? get_sub_field('heading') : get_field('intro_heading');
$ht_text = $is_flexible ? get_sub_field('text') : get_field('intro_text');

?>
<section class="section--white pb-5 baorder-top-0 what-we-offer">
    <div class="container">
        <div class="row d-flex justify-content-between align-items-start mb-5">

            <?php if ($ht_heading) : // Check if heading exists 
            ?>
                <div class="col-lg-5">
                    <h2 class="mb-3"><?php echo esc_html($ht_heading); ?></h2>
                </div>
            <?php endif; ?>

            <?php if ($ht_text) : // Check if text exists 
            ?>
                <div class="col-lg-6 pe-lg-5">
                    <?php echo wpautop(wp_kses_post($ht_text)); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>