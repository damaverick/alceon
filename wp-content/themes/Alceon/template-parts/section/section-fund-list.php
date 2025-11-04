<section class="section--grey what-we-offer border-top-0">
  <div class="container">
    <div class="container pb-5">

      <div class="row d-flex justify-content-between align-items-start mb-5">
        <div class="col-md-5">
          <h2 class="mb-3">What we offer</h2>
        </div>
        <div class="col-lg-6 pe-lg-5">
          <p>As a private capital partner, we offer access to high-quality, often under-the-radar opportunities across:</p>
        </div>
      </div>


    </div>



    <?php
    // --- Custom Loop for Child Pages ---

    // ** NEW: Check which page we are on to set the correct Parent ID **

    $parent_id = 0; // Initialize the Parent ID
    $tree = wp_get_post_parent_id(get_the_ID());
    if (is_page('your-capital') || $tree == 310) {
      // Set the Parent ID for "Your Capital"
      $parent_id = 308; // We assume 308 is correct for 'your-capital' based on your code

    } elseif (is_page('our-capital')) {
      // Set the Parent ID for "Our Capital"
      $parent_id = 306; // <-- *** IMPORTANT: REPLACE 123 with the correct Page ID for "Our Capital" ***
    }

    // This check is still used below for the custom field, so we keep it.
    $is_special_page = is_page(array('your-capital', 'our-capital'));


    // 1. Get the Parent Page ID (This is now done above)

    // Only proceed if the parent ID was set (is not 0)
    if ($parent_id) :

      // 2. Define the arguments for the query
      $args = array(
        'post_type'   => 'page',
        'post_parent'  => $parent_id,    // <-- This will now be dynamic (e.g., 308 or 123)
        'posts_per_page' => -1,        // Get all of them
        'orderby'    => 'menu_order',  // Respects the "Page Order" you set
        'order'     => 'ASC',
        'meta_query'   => array(
          array(
            'key'   => 'show_in_audience_grid',
            'value'  => '1',         // '1' means 'True'
            'compare' => '=',
          ),
        ),
      );

      // 3. Run the query
      $child_pages = new WP_Query($args);

      // 4. The Loop
      if ($child_pages->have_posts()) :
        while ($child_pages->have_posts()) : $child_pages->the_post();

          // --- ** MODIFIED LOGIC ** ---

          // 1. Determine which field name to use based on the main page
          $intro_field_name = $is_special_page ? 'listing_text_your_capital' : 'listing_text';

          // 2. Get the intro text from the correct field
          // Note: This gets the field *from the child page* in the loop
          $intro = get_field($intro_field_name);

          // 3. Get the button text (this was already correct)
          $button_text = get_field('button_text');

          // --- ** END MODIFIED LOGIC ** ---

          // Set a default fallback for the button text
          $button_text_final = $button_text ? $button_text : 'Learn More';
    ?>

          <div class="row align-items-start gx-lg-5 offer-row border-top border-2 py-5 ">

            <div class="col-12 col-lg-8 pe-lg-5 mb-4 mb-lg-0">

              <h3 class="mb-4"><?php the_title(); ?></h3>

              <?php if ($intro) : // Only show the paragraph if the 'intro' field has content 
              ?>
                <p class="mb-4">
                  <?php echo esc_html($intro); ?>
                </p>
              <?php endif; ?>

              <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-1 rounded-pill">
                <?php echo esc_html($button_text_final); ?>
              </a>
            </div>

            <div class="col-12 col-lg-4">
              <?php
              // Display the Page's Featured Image
              if (has_post_thumbnail()) {
                the_post_thumbnail('large', [
                  'class' => 'img-fluid rounded-top-right'
                ]);
              } else {
                // Optional: Show a placeholder if no featured image is set
                echo '<img src="https://placehold.co/600x400/eee/ccc?text=No+Image" alt="Placeholder" class="img-fluid rounded">';
              }
              ?>
            </div>
          </div>
    <?php
        endwhile;
      endif;

      // 5. Restore original Post Data
      wp_reset_postdata();

    endif; // End check for $parent_id
    // --- End Custom Loop ---
    ?>



  </div>
</section>