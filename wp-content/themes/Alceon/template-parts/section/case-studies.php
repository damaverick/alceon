<?php
/**
 * Template part for displaying the Case Studies block.
 *
 * (Called from a flexible content loop)
 */

// Get fields from the Flexible Content layout itself
$section_subtitle = get_sub_field('case_studies_subtitle');
$section_intro_text = get_sub_field('case_studies_paragraph');

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// Get the array of posts from the Relationship field
// ASSUMPTION: Your Relationship field is named 'case_studies'
$selected_case_studies = get_sub_field('case_studies');
?>

<section class="section--case-studies" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
  <div class="container">

    <div class="row justify-content-space-between align-items-center">
      <div class="col-md-12 mb-2">
        <h2>Proven partnerships</h2>
        
        <?php if ($section_subtitle): ?>
            <h4 class="section-subtitle pt-2"><?php echo esc_html($section_subtitle); ?></h4>
        <?php endif; ?>
      </div>
      
      <div class="col-md-12">
        <?php if ($section_intro_text): ?>
            <p class="mb-0"><?php echo wp_kses_post($section_intro_text); ?></p>
        <?php endif; ?>
      </div>
    </div>

    <?php
    // Check if any posts were selected
    if ($selected_case_studies):

        $case_index = 0; // Counter for alternating layout

        // Loop through each selected post object
        foreach ($selected_case_studies as $post):

            // Set up post data for the selected CPT
            setup_postdata($post);

            // Get fields from the Case Study CPT
            $listing_image = get_field('listing_image');
            $location = get_field('location');
            $listing_text = get_field('listing_text');

            // --- Logic for alternating layout ---
            $is_alt_row = ($case_index % 2 == 0); // Checks if index is even (0, 2, 4...)

            $row_class = $is_alt_row ? 'flex-lg-row-reverse case-row case-row--alt' : '';
            $img_col_class = $is_alt_row ? 'ps-lg-5' : ''; // Padding for alt row
            $text_col_class = $is_alt_row ? 'pe-lg-5' : 'ps-lg-5'; // Padding for alt row
            // --- End logic ---
            ?>
    
    <div class="row align-items-center gx-0 mb-5 pb-5 <?php echo esc_attr($row_class); ?>">
      
      <div class="col-12 col-lg-7 position-relative <?php echo esc_attr($img_col_class); ?>">
        <div class="case-img-wrapper">
          
          <?php if ($listing_image): ?>
            <img
              src="<?php echo esc_url($listing_image['url']); ?>"
              alt="<?php echo esc_attr($listing_image['alt']); ?>"
              class="img-fluid w-100 rounded-top-right"
            >
          <?php endif; ?>

          <?php
                  if (have_rows('statistic')):
                      ?>
            <div class="case-stats position-absolute">
              <div class="case-stats__inner d-flex justify-content-center align-items-center gap-5">
                
                <?php
                            // Loop through each stat
                            while (have_rows('statistic')) : the_row();
                                $stat_number = get_sub_field('stat_title');
                                $stat_label = get_sub_field('stat_description');
                                ?>
                  <div class="case-stat text-left">
                    <?php if ($stat_number): ?>
                        <div class="case-stat__number"><?php echo esc_html($stat_number); ?></div>
                    <?php endif; ?>
                    <?php if ($stat_label): ?>
                        <p class="case-stat__label"><?php echo esc_html($stat_label); ?></p>
                    <?php endif; ?>
                  </div>
                <?php endwhile; ?>

              </div>
            </div>
          <?php endif; // end have_rows('stats')?>

        </div>
      </div>

      <div class="col-12 col-lg-5 mt-4 mt-lg-0 <?php echo esc_attr($text_col_class); ?>">
        <h3 class="mb-1"><?php the_title(); ?></h3>
        
        <?php if ($location): ?>
            <h4 class="case-subtitle mb-3"><?php echo esc_html($location); ?></h4>
        <?php endif; ?>

        <?php if ($listing_text): ?>
            <p class="mb-4"><?php echo wp_kses_post($listing_text); ?></p>
        <?php endif; ?>
        
        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary rounded-pill">View Case Study</a>
      </div>
    </div>
    <?php
            $case_index++; // Increment the counter
        endforeach; // End foreach loop

        wp_reset_postdata(); // IMPORTANT: Reset post data after the loop
    endif; // End if($selected_case_studies)
?>

  </div>
</section>