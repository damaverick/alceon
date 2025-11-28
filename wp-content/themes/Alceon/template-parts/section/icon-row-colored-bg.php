<?php

/**
 * Reusable Icon Row Section
 *
 * Can be used in a Flexible Content layout (is_flexible = true)
 * or as a standalone section (is_flexible = false).
 * Both contexts use an 'icon_item' repeater.
 *
 * @param array $args {
 * @type bool $is_flexible Is this loaded inside a Flexible Content loop?
 * }
 */

// 1. SET CONTEXT
// ==================================================================
$is_flexible = isset($args['is_flexible']) && $args['is_flexible'];

// 2. SET VARIABLES BASED ON CONTEXT
// ==================================================================
$color_classes   = [
    'icon-widget--blue',
    'icon-widget--lightblue',
    'icon-widget--purple',
    'icon-widget--violet'
];
$column_class          = 'col-12 col-md-6';
$widget_extra_classes  = 'd-flex align-items-end';
$section_extra_classes = 'pt-4';

if ($is_flexible) {
    // --- FLEXIBLE CONTENT (Page) SETTINGS ---
    $repeater_name         = 'icon_item'; // Repeater name is the same in both contexts

    $section_heading = get_sub_field('heading');
    $paragraph_text  = get_sub_field('icon_row_section_paragraph');
    $icon_text  = get_field('icon_row_sub_text_bg');
} else {
    // --- STANDALONE (Top-Level) SETTINGS ---
    // Get top-level fields instead of sub-fields
    $repeater_name         = 'icon_item_bg'; // Repeater name is the same in both contexts

    $section_heading = get_field('heading_bg');
    $paragraph_text  = get_field('icon_row_section_paragraph_bg');
    $icon_text  = get_sub_field('icon_row_sub_text_bg');
}

// 3. SETUP LOOP
// ==================================================================
$icon_index  = 0;
$color_count = count($color_classes);

// The have_rows() function correctly checks for a sub-field (if $is_flexible)
// or a top-level field (if !$is_flexible) using the same variable name.
if (have_rows($repeater_name)) :
?>

    <section class="section--white section--icon-widgets <?php echo esc_attr($section_extra_classes); ?>">
        <div class="container">

            <?php if ($section_heading) : ?>
                <div class="row">
                    <div class="col">
                        <h2 class="mb-5"><?php echo wp_kses_post($section_heading); ?></h2>
                        <?php if ($paragraph_text) : ?>
                            <p><?php echo wp_kses_post($paragraph_text); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row g-4">

                <?php
                // Loop through the repeater
                while (have_rows($repeater_name)) : the_row();

                    // Get the correct color class for this item
                    $current_class = $color_classes[$icon_index % $color_count];

                    // --- Get Repeater Fields ---
                    // Since both flex and standalone use the 'icon_item' repeater
                    // and its sub-fields, we can use get_sub_field() for both.

                    if ($is_flexible) {
                        $icon      = get_sub_field('icon');
                        $icon_text = get_sub_field('icon_text');
                    } else {
                        $icon      = get_sub_field('icon_bg');
                        $icon_text = get_sub_field('icon_row_section_paragraph_bg');
                    }


                ?>

                    <div class="<?php echo esc_attr($column_class); ?>">
                        <div class="icon-widget <?php echo esc_attr($current_class); ?> <?php echo esc_attr($widget_extra_classes); ?>">

                            <?php if ($icon_text) : ?>
                                <p class="icon-widget__text">
                                    <?php echo wp_kses_post($icon_text); ?>
                                </p>
                            <?php endif; ?>

                            <div class="icon-widget__icon">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                <?php else : // Fallback 'shield' icon 
                                ?>
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/icons/shield.svg'); ?>" alt="">
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                <?php
                    $icon_index++; // Increment the counter
                endwhile; // End the item loop
                ?>

            </div>
        </div>
    </section>

<?php
endif; // End if( have_rows() )
?>