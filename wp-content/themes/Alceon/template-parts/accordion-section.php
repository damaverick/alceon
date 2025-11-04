<section class="section--accordion">
    <div class="container">
        <div class="accordion accordion--custom" id="infoAccordion">
            <?php
    // --- Get fields for the accordion section ---
    $section_heading = get_sub_field('section_heading');
    $intro_text = get_sub_field('intro_text');
    ?>

    
        <?php if ($section_heading): ?>
                <h2><?php echo esc_html($section_heading); ?></h2>
            <?php endif; ?>
            
            <?php if ($intro_text): ?>
                <p><?php echo wp_kses_post($intro_text); ?></p>
            <?php endif; ?>
            
            <?php
            // Check if the repeater field 'accordion_item' has rows
            if (have_rows('accordion_item')):
                
                // Loop through each item
                while (have_rows('accordion_item')) : the_row();
                    
                    // Get sub-fields for *this* item
                    $heading = get_sub_field('heading');
                    $text = get_sub_field('text');
                    $button_text = get_sub_field('button_text');
                    $link_url = get_sub_field('button_url'); 

                    // Create unique IDs using the row index
                    $index = get_row_index();
                    $heading_id = 'accHeading' . $index;
                    $collapse_id = 'accCollapse' . $index;

                ?>

                <div class="accordion-item">
                    <h3 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                            aria-expanded="true" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                            
                            <?php if ($heading): ?>
                                <span class="accordion-title h4"><?php echo esc_html($heading); ?></span>
                            <?php endif; ?>
                            
                            <span class="accordion-icon"></span>
                        </button>
                    </h3>
                    <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse show" aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                         data-bs-parent="#infoAccordion">
                        <div class="accordion-body">
                            <div class="accordion-content d-flex flex-wrap align-items-start justify-content-between">
                                <div class="accordion-text pe-4 flex-grow-1">
                                    
                                    <?php if ($text): ?>
                                        <?php echo wpautop( wp_kses_post( $text ) ); ?>
                                    <?php endif; ?>

                                    <?php // Only show button if BOTH URL and Text exist
                                    if ($link_url && $button_text): ?>
                                        <a href="<?php echo esc_url($link_url); ?>" 
                                           class="btn btn-outline-primary fw-bold rounded-pill">
                                            <?php echo esc_html($button_text); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; // End the accordion_item loop ?>
            <?php endif; // End if( have_rows('accordion_item') ) ?>

        </div>
    </div>
</section>