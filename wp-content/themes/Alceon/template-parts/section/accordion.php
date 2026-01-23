<?php
// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';
?>
<section class="section--accordion section--white" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
    <div class="container">
        
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12 col-lg-8">
                <?php
                $section_heading = get_sub_field('section_heading');
$intro_text = get_sub_field('intro_text');
?>

                <?php if ($section_heading): ?>
                    <h2><?php echo esc_html($section_heading); ?></h2>
                <?php endif; ?>
                
                <?php if ($intro_text): ?>
                    <p><?php echo wp_kses_post($intro_text); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="accordion accordion--custom" id="infoAccordion">
            
          <?php
            // Check if the repeater field 'accordion_item' has rows
            if (have_rows('accordion_item')):

                // 2. Initialize delay counter
                $acc_index = 0;

                // Loop through each item
                while (have_rows('accordion_item')) : the_row();

                    // Get sub-fields for *this* item
                    $heading      = get_sub_field('heading');
                    $text         = get_sub_field('text');
                    $button_text  = get_sub_field('button_text');
                    $link_url     = get_sub_field('button_url');

                    // Create unique IDs using the row index
                    $index       = get_row_index();
                    $heading_id  = 'accHeading' . $index;
                    $collapse_id = 'accCollapse' . $index;
                    // Mark the first item so it can be shown/expanded by default
                    $is_first = ($index === 1);

                    // 3. Calculate Delay (0ms, 100ms, 200ms...)
                    $aos_delay = $acc_index * 100;
                    ?>

                <div class="accordion-item" 
                     data-aos="fade-up" 
                     data-aos-delay="<?php echo intval($aos_delay); ?>">
                     
                    <h3 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                            aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                            aria-controls="<?php echo esc_attr($collapse_id); ?>"
                        >
                            <?php if ($heading): ?>
                                <span class="accordion-title h4"><?php echo esc_html($heading); ?></span>
                            <?php endif; ?>
                            <span class="accordion-icon"></span>
                        </button>
                    </h3>

                    <div
                        id="<?php echo esc_attr($collapse_id); ?>"
                        class="accordion-collapse collapse<?php echo $is_first ? ' show' : ''; ?>"
                        aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                        data-bs-parent="#infoAccordion"
                    >
                        <div class="accordion-body">
                            <div class="accordion-content d-flex flex-wrap align-items-start justify-content-between">
                                <div class="accordion-text pe-4 flex-grow-1  ">

                                    <?php if ($text): ?>
                                        <?php echo wpautop(wp_kses_post($text)); ?>
                                    <?php endif; ?>

                                    <?php if ($link_url && $button_text): ?>
                                        <a
                                            href="<?php echo esc_url($link_url); ?>"
                                            class="btn btn-outline-primary fw-bold rounded-pill"
                                    
                                        >
                                            <?php echo esc_html($button_text); ?>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
                // 5. Increment Counter
                $acc_index++;
                endwhile; // End the accordion_item loop
            endif; // End if( have_rows('accordion_item') )
?>


        </div>
    </div>
</section>