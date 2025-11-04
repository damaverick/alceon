<?php

/**
 * Reusable Icon Row Section
 *
 * This template can be called directly or from a Flexible Content loop.
 * It checks for an 'is_flexible' argument to decide which
 * ACF functions to use.
 *
 * It also checks for a 'column_count' field to dynamically set
 * the column layout to 3 or 4 columns.
 *
 * @param array $args {
 * @type bool $is_flexible Is this loaded inside a Flexible Content loop?
 * }
 */

// Check if we are in a flexible content context
$is_flexible = isset($args['is_flexible']) && $args['is_flexible'];

// Use get_sub_field() if flexible, otherwise use get_field()
$heading = $is_flexible ? get_sub_field('heading') : get_field('heading');
$repeater_field_name = 'icon_item'; // Field name is the same in both contexts

// --- NEW: Get the column count ---
$column_count = $is_flexible ? get_sub_field('column_count') : get_field('column_count');

// --- NEW: Set the Bootstrap class based on the count ---
$lg_class = '';
if ($column_count == '3') {
  $lg_class = 'col-lg-4'; // 12 / 3 = 4
} else {
  $lg_class = 'col-lg-3'; // Default to 4 columns (12 / 4 = 3)
}

// Combine with the other responsive classes
$column_class = 'col-12 col-sm-6 ' . $lg_class . ' text-center text-lg-start';

?>
<section class="section--white icon-row">
  <div class="container">

    <?php if ($heading): // Check if heading exists 
    ?>
      <div class="row mb-5">
        <div class="col-12">
          <h2 class="mb-3"><?php echo esc_html($heading); ?></h2>
        </div>
      </div>
    <?php endif; ?>

    <?php
    // The have_rows() function is context-aware.
    if (have_rows($repeater_field_name)):
    ?>
      <div class="row justify-content-start gy-5 gx-4 gx-lg-5">

        <?php
        // Loop through each icon in the repeater
        while (have_rows($repeater_field_name)) : the_row();

          // These are sub-fields of the 'icon_item' repeater,
          // so they ALWAYS use get_sub_field()
          $icon_img = get_sub_field('icon');
          $icon_heading = get_sub_field('icon_heading');
          $icon_text = get_sub_field('icon_text');
        ?>

          <div class="<?php echo esc_attr($column_class); ?>">

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

        <?php endwhile; ?>


      </div>
    <?php endif; // End if( have_rows('icon_item') ) 
    ?>

    <?php
    // Get the raw value
    $subtext_raw = $is_flexible ? get_sub_field('icon_row_sub_text') : get_field('icon_row_sub_text');

    // FIX: Cast to (string) to prevent passing null to trim()
    if (trim((string) $subtext_raw)):
    ?>
      <div class="row">
        <div class="col">
          <p><?php echo wp_kses_post($subtext_raw); ?></p>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>