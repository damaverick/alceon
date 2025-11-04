    <?php
    // Get the main heading
    $heading = get_sub_field('resource_title');
    $url = get_sub_field('resource_url');

    // Array of your color classes to cycle through
    $color_classes = [
        'icon-widget--blue',
        'icon-widget--lightblue',
        'icon-widget--pac-blue',

        'icon-widget--purple',
        'icon-widget--violet',
        'icon-widget--bronze',


    ];

    // Counter to track which icon we're on
    $icon_index = 0;
    ?>

    <section class="section--icon-widgets pt-0  ">
        <div class="container">


            <div class="row">
                <div class="col">
                    <h2 class="mb-5">Resources</h2>
                </div>
            </div>



            <?php
            // Check if the repeater field 'icon_item' has rows
            if (have_rows('resources')):
            ?>
                <div class="row g-4">

                    <?php
                    // Loop through each icon item
                    while (have_rows('resources')) : the_row();

                        // Get sub-fields for this item

                        $icon_text = get_sub_field('resource_title');

                        // Get the correct class for this item from the array
                        $current_class = $color_classes[$icon_index % count($color_classes)];
                    ?>

                        <div class="col-12 col-md-4">
                            <div class="icon-widget <?php echo esc_attr($current_class); ?>">

                                <?php if ($icon_text): ?>
                                    <p class="icon-widget__text">
                                        <?php echo wp_kses_post($icon_text); ?>
                                    </p>
                                <?php endif; ?>






                                <div class="icon-widget__icon">
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/icons/doc.svg'); ?>" alt="">
                                </div>

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