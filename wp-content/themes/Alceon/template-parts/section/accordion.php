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

                                    <?php
                                    $enable_modal = get_sub_field('enable_modal');
                    $modal_heading = get_sub_field('modal_heading');
                    $hubspot_form_id = get_sub_field('hubspot_form_id');
                    $modal_id = 'accordionModal' . $index;

                    if ($button_text):
                        if ($enable_modal && $hubspot_form_id):
                            ?>
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary fw-bold rounded-pill"
                                            data-bs-toggle="modal"
                                            data-bs-target="#<?php echo esc_attr($modal_id); ?>"
                                        >
                                            <?php echo esc_html($button_text); ?>
                                        </button>
                                    <?php elseif ($link_url): ?>
                                        <a
                                            href="<?php echo esc_url($link_url); ?>"
                                            class="btn btn-outline-primary fw-bold rounded-pill"
                                        >
                                            <?php echo esc_html($button_text); ?>
                                        </a>
                                    <?php
                                    endif;
                    endif;
                    ?>

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

<?php
// Output modals after accordion
if (have_rows('accordion_item')):
    while (have_rows('accordion_item')) : the_row();
        $enable_modal = get_sub_field('enable_modal');
        $modal_heading = get_sub_field('modal_heading');
        $hubspot_form_id = get_sub_field('hubspot_form_id');
        $index = get_row_index();
        $modal_id = 'accordionModal' . $index;

        if ($enable_modal && $hubspot_form_id):
            ?>

<div class="modal fade" id="<?php echo esc_attr($modal_id); ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content section--gradient text-white" style="border:none; overflow:hidden;">
      
      <div class="modal-body p-4 p-md-5 position-relative">
        
        <button type="button" 
                class="btn btn-light btn-outline-white" 
                data-bs-dismiss="modal" 
                aria-label="Close"
                style="position:absolute; top: 2rem; right: 2rem; z-index: 10;">
          Close
        </button>

        <div class="row" style="margin-top: 3.5rem;"> 
          <div class="col-12 mb-md-5 text-start">
            <?php if ($modal_heading): ?>
              <h2 class="text-white mb-4"><?php echo esc_html($modal_heading); ?></h2>
            <?php endif; ?>
          </div>

          <div class="col-12 text-start">
            <div class="custom-hubspot-form" data-hs-forms-root="true">
              <div class="hs-form-html" 
                   data-region="ap1" 
                   data-form-id="<?php echo esc_attr($hubspot_form_id); ?>" 
                   data-portal-id="4264043">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<?php
        endif;
    endwhile;
endif;
?>