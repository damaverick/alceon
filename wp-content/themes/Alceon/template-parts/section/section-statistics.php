<?php // --- NEW: Get the column count ---
$column_count = get_sub_field('column_count') ;

// --- NEW: Set the Bootstrap class based on the count ---
$lg_class = '';

if ($column_count == '2') {
  $lg_class = 'col-lg-6';  // 12 / 2 = 6
} elseif ($column_count == '3') {
  $lg_class = 'col-lg-4';  // 12 / 3 = 4
} elseif ($column_count == '5') {
  $lg_class = 'col-lg-5th'; // Custom 20% column
} else {
  $lg_class = 'col-lg-3';  // Default to 4 columns (12 / 4 = 3)
}


$column_class = 'col-12 col-sm-6 ' . $lg_class . ' text-center text-lg-start'; 


?>





<section class="section--dark-blue text-white">
  <div class="container">

    
    <div class="row align-items-start">
      <div class="col-12 col-lg-7 pt-5">
        <?php if (get_sub_field('statistic_heading')): ?>
          <h2 class="mt-5 text-white"><?php echo  get_sub_field('statistic_heading'); ?></h2>
        <?php endif; ?>

        <?php
        echo wpautop(get_sub_field('statistic_intro'));
        ?>
      </div>
    </div>

    <div class="row g-4 mt-5">

      <?php
      // Check if the 'stats_repeater' has rows
      if (have_rows('statistic_item')):
        // Loop through the rows
        while (have_rows('statistic_item')) : the_row();

          // Get sub-field values
          $stat = get_sub_field('statistic');
          $description = get_sub_field('statistic_text');
      ?>

          <div class="<?php echo esc_attr($column_class); ?>">
            <div class="stat-item">
              <?php if ($stat): ?>
                <h2 class="stat-number"><?php echo esc_html($stat); ?></h2>
              <?php endif; ?>

              <?php if ($description): ?>
                <div class="stat-text w-75">
                  <p> <?php echo wp_kses_post($description);  ?></p>
                </div>
              <?php endif; ?>
            </div>
          </div>

      <?php
        endwhile;
      else :
      // No stats found
      endif;
      ?>

    </div> 
    <!-- END ROW -->

    <?php if (get_sub_field('stats_subtext')): ?>
      <p class="mt-5 footnotes"><?php echo esc_html(get_sub_field('stats_subtext')); ?></p>
    <?php endif; ?>
  </div>
</section>