<?php
// --- Get the column count ---
$column_count = get_sub_field('column_count');

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// --- Set the Bootstrap class ---
$lg_class = '';
if ($column_count == '2') {
    $lg_class = 'col-lg-6';
} elseif ($column_count == '3') {
    $lg_class = 'col-lg-4';
} elseif ($column_count == '5') {
    $lg_class = 'col-lg-5th';
} else {
    $lg_class = 'col-lg-3';
}

$column_class = 'col-12 col-sm-6 ' . $lg_class . ' text-center text-lg-start';
?>

<section class="section--dark-blue text-white" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
  <div class="container">
    
    <div class="row align-items-start">
      <div class="col-12 col-lg-7" data-aos="fade-up">
        <?php if (get_sub_field('statistic_heading')): ?>
          <h2 class="text-white"><?php echo get_sub_field('statistic_heading'); ?></h2>
        <?php endif; ?>

        <?php echo wpautop(get_sub_field('statistic_intro')); ?>
      </div>
    </div>

    <div class="row g-4 mt-5">

      <?php
      if (have_rows('statistic_item')):
          $stat_index = 0;

          while (have_rows('statistic_item')) : the_row();
              $stat_text = get_sub_field('statistic'); // e.g. "$1.5B"
              $description = get_sub_field('statistic_text');
              $aos_delay = $stat_index * 100;

              // --- ROBUST PARSING ---
              // Split the string into: Prefix (non-digits), Number, Suffix (non-digits)
              // Example: "$1.5B" -> Prefix: "$", Num: "1.5", Suffix: "B"
              preg_match('/^([^\d]*)([\d\.]+)([^\d]*)$/', $stat_text, $matches);

              $prefix = isset($matches[1]) ? $matches[1] : '';
              $number = isset($matches[2]) ? $matches[2] : 0;
              $suffix = isset($matches[3]) ? $matches[3] : '';

              // Determine decimals (if dot exists)
              $decimals = (strpos($number, '.') !== false) ? 1 : 0;
              ?>

          <div class="<?php echo esc_attr($column_class); ?>" 
               data-aos="fade-up" 
               data-aos-delay="<?php echo intval($aos_delay); ?>">
               
            <div class="stat-item">
              <?php if ($stat_text): ?>
                <h2 class="stat-number js-counter" 
                    data-target="<?php echo esc_attr($number); ?>" 
                    data-decimals="<?php echo esc_attr($decimals); ?>"
                    data-prefix="<?php echo esc_attr($prefix); ?>"
                    data-suffix="<?php echo esc_attr($suffix); ?>">
                    <?php echo esc_html($prefix . '0' . $suffix); ?>
                </h2>
              <?php endif; ?>

              <?php if ($description): ?>
                <div class="stat-text w-75">
                  <p> <?php echo wp_kses_post($description); ?></p>
                </div>
              <?php endif; ?>
            </div>
          </div>

      <?php
                  $stat_index++;
          endwhile;
      endif;
?>

    </div> 

    <?php if (get_sub_field('icon_row_subtext')): ?>
      <p class="mt-5 footnotes" data-aos="fade-up" data-aos-delay="200">
          <?php echo get_sub_field('icon_row_subtext'); ?>
      </p>
    <?php endif; ?>
  </div>
</section>

