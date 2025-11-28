<?php
// --- Get the column count ---
$column_count = get_sub_field('column_count');

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

<section class="section--dark-blue text-white">
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
                  <p> <?php echo wp_kses_post($description);  ?></p>
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

    <?php if (get_sub_field('stats_subtext')): ?>
      <p class="mt-5 footnotes" data-aos="fade-up" data-aos-delay="200">
          <?php echo esc_html(get_sub_field('stats_subtext')); ?>
      </p>
    <?php endif; ?>
  </div>
</section>


<script>
document.addEventListener("DOMContentLoaded", function() {
  
  // 1. Setup the Observer
  let observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      // If the element is visible
      if (entry.isIntersecting) {
        let el = entry.target;
        let $el = jQuery(el);

        // Prevent running twice
        if ($el.hasClass('counted')) return;
        $el.addClass('counted');

        // 2. Get the specific data for this number
        let targetVal = parseFloat($el.attr('data-target'));
        let decimals  = parseInt($el.attr('data-decimals'));
        let prefix    = $el.attr('data-prefix') || ""; // Fallback to empty string
        let suffix    = $el.attr('data-suffix') || "";

        // 3. Run jQuery Animation
        jQuery({ countNum: 0 }).animate({
            countNum: targetVal
        },
        {
            duration: 2000, // 2 seconds
            easing: 'swing',
            step: function() {
                // Update the text visually as we count up
                $el.text(
                    prefix + 
                    this.countNum.toFixed(decimals) + 
                    suffix
                );
            },
            complete: function() {
                // Ensure the final number is exact
                $el.text(
                    prefix + 
                    this.countNum.toFixed(decimals) + 
                    suffix
                );
            }
        });

        // Stop watching this element (performance)
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.5 }); // Trigger when 50% of the number is visible

  // 4. Attach Observer to all counters
  document.querySelectorAll('.js-counter').forEach(counter => {
    observer.observe(counter);
  });

});
</script>