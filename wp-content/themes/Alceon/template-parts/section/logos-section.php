<?php if (get_row_layout() == 'section_logos'): ?>
  <?php
  // Get fields for the layout
  $title_1 = get_sub_field('title_1');
  $title_2 = get_sub_field('title_2');
  ?>

  <section class="section--gradient-dark-blue text-white">
    <div class="container">

      <?php // ===== First Logo Row (Exited Investments) ===== 
      ?>
      <?php if ($title_1): ?>
        <div class="row mb-4">
          <div class="col-12">
            <h3 class="section-title mb-4"><?php echo esc_html($title_1); ?></h3>
          </div>
        </div>
      <?php endif; ?>

      <?php if (have_rows('logos_row_1')): ?>
        <div class="row g-4 justify-content-start text-white text-center text-md-start mb-5 pb-4">

          <?php while (have_rows('logos_row_1')) : the_row();
            // Get sub-fields for Row 1
            $logo = get_sub_field('logo');
            $logo_text = get_sub_field('logo_text');
            $statistic = get_sub_field('statistic');
          ?>
            <div class="col-6 col-md-4 col-lg-3">
              <div class="investment-stat d-flex flex-column align-items-center text-white">

                <?php if ($logo): ?>
                  <img src="<?php echo esc_url($logo['url']); ?>"
                    alt="<?php echo esc_attr($logo['alt']); ?>"
                    class="investment-stat__logo mb-3">
                <?php endif; ?>

                <?php if ($logo_text): ?>
                  <h4 class="investment-stat__title mb-2"><?php echo esc_html($logo_text); ?></h4>
                <?php endif; ?>

                <?php if ($statistic): ?>
                  <div class="investment-stat__data d-flex flex-wrap align-items-baseline gap-2">
                    <span class="investment-stat__number"><?php echo esc_html($statistic); ?></span>
                    <span class="investment-stat__metric">IRR</span>
                  </div>
                <?php endif; ?>

              </div>
            </div>
          <?php endwhile; ?>

        </div>
      <?php endif; // end have_rows('logos_row_1') 
      ?>


      <?php // ===== Conditional Divider =====
      // Only show the divider if the *second* row has logos
      if (have_rows('logos_row_2')):
      ?>
        <div class="section-divider--white my-5 pb-4"></div>
      <?php endif; ?>


      <?php // ===== Second Logo Row (Current Investments) ===== 
      ?>
      <?php if ($title_2): ?>
        <div class="row mb-4">
          <div class="col-12">
            <h3 class="section-title mb-4"><?php echo esc_html($title_2); ?></h3>
          </div>
        </div>
      <?php endif; ?>

      <?php if (have_rows('logos_row_2')): ?>
        <div class="row g-4 justify-content-start text-white text-center text-md-start">

          <?php while (have_rows('logos_row_2')) : the_row();
            // Get sub-fields for Row 2
            $logo = get_sub_field('logo');
            $logo_text = get_sub_field('logo_text');
          ?>
            <div class="col-6 col-md-4 col-lg-3">
              <div class="investment-stat d-flex flex-column align-items-center text-white">

                <?php if ($logo): ?>
                  <img src="<?php echo esc_url($logo['url']); ?>"
                    alt="<?php echo esc_attr($logo['alt']); ?>"
                    class="investment-stat__logo mb-3">
                <?php endif; ?>

                <?php if ($logo_text): ?>
                  <h4 class="investment-stat__title mb-0"><?php echo esc_html($logo_text); ?></h4>
                <?php endif; ?>

              </div>
            </div>
          <?php endwhile; ?>

        </div>
      <?php endif; // end have_rows('logos_row_2') 
      ?>

    </div>
  </section>

<?php endif; // end if layout == 'section_logos' 
?>