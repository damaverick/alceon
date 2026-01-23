<?php

/**
 * Reusable Icon Row Section.
 */

// Check if we are in a flexible content context
$is_flexible = isset($args['is_flexible']) && $args['is_flexible'];

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// Use get_sub_field() if flexible, otherwise use get_field()
$heading = $is_flexible ? get_sub_field('heading') : get_field('heading');
$intro = $is_flexible ? get_sub_field('icon_row_intro_text') : get_field('icon_row_intro_text');

$repeater_field_name = 'icon_item';

// --- Get the column count ---
$column_count = $is_flexible ? get_sub_field('column_count') : get_field('column_count');

// --- Set the Bootstrap class based on the count ---
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

// Combine with the other responsive classes
$column_class = 'col-12 col-sm-6 ' . $lg_class . ' text-start text-sm-center text-lg-start';

?>
<section class="section--white icon-row" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
  <div class="container">

    <?php if ($heading): ?>
    
    <div class="row d-flex justify-content-between align-items-start  mb-lg-5">
      <div class="col-md-5">
       <h2 data-aos="fade-right"><?php echo esc_html($heading); ?></h2>
      </div>
      <div class="col-lg-6 pe-lg-5" data-aos="fade-left">
        <?php if ($intro !== ''): ?>
          <?php echo wp_kses_post(wpautop($intro)); ?>
        <?php endif; ?>
      </div>
    </div>
   
    <?php endif; ?>

    <?php
        if (have_rows($repeater_field_name)):
            ?>
      <div class="row justify-content-start gy-5 gx-4 gx-lg-5" >

        <?php
                // 1. Initialize delay counter (starts at 0ms)
                $aos_delay = 0;

            while (have_rows($repeater_field_name)) : the_row();

                $icon_img = get_sub_field('icon');
                $icon_heading = get_sub_field('icon_heading');
                $icon_text = get_sub_field('icon_text');
                ?>

          <div class="<?php echo esc_attr($column_class); ?>" 
               data-aos="fade-up" 
               data-aos-delay="<?php echo intval($aos_delay); ?>">

            <?php if ($icon_img): ?>
              <img src="<?php echo esc_url($icon_img['url']); ?>"
                alt="<?php echo esc_attr($icon_img['alt']); ?>"
                class="icon-row__icon mb-3">
            <?php endif; ?>

            <?php if ($icon_heading): ?>
              <h4 class="icon-row__heading mb-1">
                <?php echo wp_kses_post($icon_heading); ?>
              </h4>
            <?php endif; ?>

            <?php if ($icon_text): ?>
              <p class="icon-row__text mb-0">
                <?php echo wp_kses_post($icon_text); ?>
              </p>
            <?php endif; ?>

          </div>

        <?php
        // 3. Increment delay by 100ms for the next item
        $aos_delay += 100;

            endwhile; ?>


      </div>
    <?php endif; ?>

    <?php
    $subtext_raw = $is_flexible ? get_sub_field('icon_row_subtext') : get_field('icon_row_subtext');

if (trim((string) $subtext_raw)):
    ?>
      <div class="row mt-5" data-aos="fade-up">
        <div class="col">
          <p class="footnotes"><?php echo wp_kses_post($subtext_raw); ?></p>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>