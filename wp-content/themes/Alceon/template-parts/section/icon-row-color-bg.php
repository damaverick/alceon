<?php if (get_row_layout() == 'icon_row_section_coloured_background'): ?>
    <?php
    // Get the main heading
    $heading = get_sub_field('heading');
    $paragraph_text = get_sub_field('icon_row_section_paragraph');

    // Array of your color classes to cycle through
    $color_classes = [
        'icon-widget--blue',
        'icon-widget--lightblue',
        'icon-widget--purple',
        'icon-widget--violet'
    ];

    // Counter to track which icon we're on
    $icon_index = 0;
    ?>

    <section class="section--icon-widgets section--white">
        <div class="container">

            <?php if ($heading): ?>
                <div class="row">
                    <div class="col" data-aos="fade-up">
                        <h2 class="mb-5"><?php echo wp_kses_post($heading); ?></h2>
                        <?php if ($paragraph_text): ?> <p class="mb-5"><?php echo wp_kses_post($paragraph_text); ?></p> <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>


            <?php
            // Check if the repeater field 'icon_item' has rows
            if (have_rows('icon_item')):
                ?>
                <div class="row g-4">

                    <?php
                        // Loop through each icon item
                        while (have_rows('icon_item')) : the_row();

                            // Get sub-fields for this item
                            $icon = get_sub_field('icon');
                            $icon_text = get_sub_field('icon_text');
                            $subtext = get_sub_field('subtext');

                            // Get the correct class for this item from the array
                            $current_class = $color_classes[$icon_index % count($color_classes)];

                            // Calculate delay based on index (0, 100, 200, etc)
                            $aos_delay = $icon_index * 100;
                            ?>

                        <div class="col-12 col-md-6" 
                             data-aos="fade-up" 
                             data-aos-delay="<?php echo intval($aos_delay); ?>">
                             
                            <div class="icon-widget d-flex align-items-end <?php echo esc_attr($current_class); ?>">

                                <?php if ($icon_text): ?>
                                    <p class="icon-widget__text">
                                        <?php echo wp_kses_post($icon_text); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($subtext): ?>
                                <?php endif; ?>


                                <?php if ($icon): // Check if user uploaded an icon
                                    ?>
                                    <div class="icon-widget__icon">
                                        <img src="<?php echo esc_url($icon['url']); ?>"
                                            alt="<?php echo esc_attr($icon['alt']); ?>">
                                    </div>
                                <?php else: // Otherwise, use the default shield icon
                                    ?>
                                    <div class="icon-widget__icon">
                                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/icons/shield.svg'); ?>" alt="">
                                    </div>
                                <?php endif; // End icon check
                            ?>
                            </div>
                        </div>
                    <?php
                        $icon_index++; // Increment the counter
                        endwhile; // End the item loop
    ?>

                </div> <?php endif; // End if( have_rows('icon_item') )
?>

        </div>
    </section>

<?php endif; // End if (get_row_layout() == 'icon_row_section_coloured_background')
?>