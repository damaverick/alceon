<?php
global $post;

// ---- Basic context for the CURRENT page ----
$current_id = ($post instanceof WP_Post) ? (int) $post->ID : 0;
$parent_id  = $current_id ? (int) wp_get_post_parent_id($current_id) : 0;

// -------------------------------------
// Heading & top intro from CURRENT page
// -------------------------------------

// 1) Heading from ACF text field on this page
$cap_heading = get_field('capability_source_heading', $current_id);
if (empty($cap_heading)) {
    $cap_heading = 'What we offer';
}

// 2) Top intro from ACF select: convert value -> label
$top_intro_text = '';

// Try as sub field first (if used inside a flexible layout)
$field_obj = function_exists('get_sub_field_object')
    ? get_sub_field_object('capability_source_intro_text')
    : null;

// If not a sub field, fall back to normal field object on the page
if (!$field_obj) {
    $field_obj = get_field_object('capability_source_intro_text', $current_id);
}

if (!empty($field_obj)) {
    $value   = $field_obj['value'] ?? null;
    $choices = $field_obj['choices'] ?? [];

    if (is_array($value) && isset($value['label'])) {
        // Return format = "Both"
        $top_intro_text = $value['label'];
    } elseif (is_string($value) && isset($choices[$value])) {
        // Return format = "Value", so look up the label from choices
        $top_intro_text = $choices[$value];
    } elseif (is_string($value)) {
        // Fallback: just use whatever came back
        $top_intro_text = $value;
    }
}

// -------------------------------------
// cap_source from CURRENT page controls which children to loop
// -------------------------------------
$cap_source_raw  = get_field('capability_source', $current_id);
$cap_source_slug = strtolower(str_replace(' ', '_', trim((string) $cap_source_raw)));

if ($cap_source_slug === 'your_capital') {
    // Your Capital children live under 308
    $loop_parent_id = 308;
} else {
    // Our Capital children live under 306
    $loop_parent_id = 306;
}

// ---- Query children of 306/308 ----
$q = new WP_Query([
    'post_type'      => 'page',
    'post_parent'    => $loop_parent_id,
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
]);
?>
<section class="section--grey what-we-offer border-top-0">
  <div class="container pb-5">

    <div class="row d-flex justify-content-between align-items-start mb-5">
      <div class="col-12 mb-4">
        <h2 class="mb-1"><?php echo esc_html($cap_heading); ?></h2>
      </div>
      <div class="col-12">
        <?php if (!empty($top_intro_text)) : ?>
          <?php echo wp_kses_post(wpautop($top_intro_text)); ?>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($q->have_posts()) : ?>
      <?php while ($q->have_posts()) : $q->the_post(); ?>
        <?php
          // -------------------------------
          // Per-row intro text (child pages)
          // decided by the CONTEXT page
          // -------------------------------
         if ($current_id === 27) {
    // On "Your Capital" (27) page:
    $intro = get_field('listing_text');

} elseif ($current_id === 125) {
    // On "Our Capital" (125) page:
    $intro = get_field('listing_text_your_capital');
}

              elseif ($parent_id === 310) {
              // Section is being shown on a page whose parent is 310
              $intro = get_field('listing_text_your_capital');
          } else {
              // Everywhere else, default to listing_text_your_capital
              $intro = get_field('listing_text_your_capital');
          }

          $button_text = get_field('button_text');
          if (empty($button_text)) {
              $button_text = 'Learn More';
          }
        ?>
        <div class="row align-items-start gx-lg-5 offer-row border-top border-2 py-5">
          <div class="col-12 col-lg-8 pe-lg-5 mb-4 mb-lg-0">
            <h3 class="mb-3"><?php the_title(); ?></h3>

            <?php if (!empty($intro)) : ?>
              <p class="mb-4 mb-sm-3"><?php echo esc_html($intro); ?></p>
            <?php endif; ?>

            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-1 rounded-pill">
              <?php echo esc_html($button_text); ?>
            </a>
          </div>
          <div class="col-12 col-lg-4">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-top-right']); ?>
            <?php else : ?>
              <img src="https://placehold.co/600x400/eee/ccc?text=No+Image"
                   alt="Placeholder"
                   class="img-fluid rounded">
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>

  </div>
</section>
