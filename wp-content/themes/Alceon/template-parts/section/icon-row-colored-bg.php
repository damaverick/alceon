<?php

/**
 * Reusable Icon Row Section
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
    $repeater_name         = 'icon_item';

    $section_heading = get_sub_field('heading');
    $paragraph_text  = get_sub_field('icon_row_section_paragraph');
    $icon_text       = get_field('icon_row_sub_text_bg');
} else {
    // --- STANDALONE (Top-Level) SETTINGS ---
    $repeater_name         = 'icon_item_bg';

    $section_heading = get_field('heading_bg');
    $paragraph_text  = get_field('icon_row_section_paragraph_bg');
    $icon_text       = get_sub_field('icon_row_sub_text_bg');
}

// 3. SETUP LOOP
// ==================================================================
$icon_index  = 0;
$color_count = count($color_classes);

if (have_rows($repeater_name)) :
    ?>

    <section class="section--white section--icon-widgets <?php echo esc_attr($section_extra_classes); ?>">
        <div class="container">

            <?php if ($section_heading) : ?>
                <div class="row">
                    <div class="col" data-aos="fade-up">
                        <h2 class="mb-5"><?php echo wp_kses_post($section_heading); ?></h2>
                        <?php if ($paragraph_text) : ?>
                            <p><?php echo wp_kses_post($paragraph_text); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row g-4">

                <?php
                    while (have_rows($repeater_name)) : the_row();

                        // Get the correct color class for this item
                        $current_class = $color_classes[$icon_index % $color_count];

                        // Calculate delay: 0ms, 100ms, 200ms, etc.
                        $aos_delay = $icon_index * 100;

                        if ($is_flexible) {
                            $icon      = get_sub_field('icon');
                            $icon_text = get_sub_field('icon_text');
                        } else {
                            $icon      = get_sub_field('icon_bg');
                            $icon_text = get_sub_field('icon_row_section_paragraph_bg');
                        }
                        ?>

                    <div class="<?php echo esc_attr($column_class); ?>" 
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo intval($aos_delay); ?>">
                         
                        <div class="icon-widget <?php echo esc_attr($current_class); ?> <?php echo esc_attr($widget_extra_classes); ?>">

                            <?php if ($icon_text) : ?>
                                <p class="icon-widget__text">
                                    <?php echo wp_kses_post($icon_text); ?>
                                </p>
                            <?php endif; ?>

                            <div class="icon-widget__icon">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/icons/shield.svg'); ?>" alt="">
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                <?php
                            $icon_index++; // Increment the counter (and the delay multiplier)
                    endwhile;
?>

            </div>
        </div>
    </section>

<?php
endif;
?>