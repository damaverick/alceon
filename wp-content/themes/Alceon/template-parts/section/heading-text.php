<?php

/**
 * Reusable Text Intro Section.
 *
 * Checks for 'is_flexible' arg to determine context.
 *
 * @param array $args {
 * @type bool $is_flexible Is this loaded inside a Flexible Content loop?
 *            }
 */

// 1. Check for flexible content context
$is_flexible = isset($args['is_flexible']) && $args['is_flexible'];

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// 2. Set variables using the correct ACF function
$ht_heading = $is_flexible ? get_sub_field('heading') : get_field('intro_heading');
$ht_text    = $is_flexible ? get_sub_field('text') : get_field('intro_text');

// Background class (select field)
$bg_class = $is_flexible
    ? get_sub_field('section_background_color')
    : get_field('intro_text_background_color');

// Set a default class if the ACF field is empty (nothing selected)
if (empty($bg_class)) {
    $bg_class = 'section--white'; // Your default class
}

// 3. Vertical layout toggle (yes/no)
$vertical_layout_raw = $is_flexible
    ? get_sub_field('vertical_layout')
    : get_field('vertical_layout');

$vertical_layout = strtolower(trim((string) $vertical_layout_raw));
$stack_vertical  = ($vertical_layout === 'yes');

// 4. Decide column classes based on vertical_layout
if ($stack_vertical) {
    // Stack vertically on ALL breakpoints
    $heading_col_class = 'col-12 ';
    $text_col_class    = 'col-12';
} else {
    // Default behaviour: side-by-side on lg+, stacked on smaller
    $heading_col_class = 'col-lg-5';
    $text_col_class    = 'col-lg-7 pe-lg-5';
}

?>

<section class="section--heading-text section--<?php echo esc_attr($bg_class); ?>  border-top-0" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
    <div class="container">
        <div class="row d-flex justify-content-between align-items-start ">

            <?php if ($ht_heading) : ?>
                <div class="<?php echo esc_attr($heading_col_class); ?>" data-aos="fade-right">
                    <h2><?php echo $ht_heading; ?></h2>
                </div>
            <?php endif; ?>

            <?php if ($ht_text) : ?>
                <div class="<?php echo esc_attr($text_col_class); ?>" data-aos="fade-left">
                    <?php echo wpautop(wp_kses_post($ht_text)); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
