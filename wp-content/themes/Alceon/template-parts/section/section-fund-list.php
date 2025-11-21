<?php
/**
 * Capability List — simple regular ACF version (no Flexible Content)
 * Requires page-level ACF fields:
 *  - capability_list_heading (text)
 *  - capability_source_list  (select: value 'your_capital' | 'our_capital')
 */

// --- CONFIG: update IDs if needed ---
$YOUR_CAPITAL_CONTENT_ID     = 27;
$OUR_CAPITAL_CONTENT_ID      = 125;

$YOUR_CAPITAL_LOOP_PARENT_ID = 308;
$OUR_CAPITAL_LOOP_PARENT_ID  = 306;

// Field names
$CAP_TEXT_PRIMARY  = 'capability_text_capital';
$CAP_TEXT_FALLBACK = 'capability_text';
$INTRO_FIELD_YOUR  = 'listing_text_your_capital';
$INTRO_FIELD_OUR   = 'listing_text_our_capital_lp';

// --- Read regular ACF fields on this page ---
$cap_heading = (string) get_field('capability_list_heading');
$cap_source  = (string) get_field('capability_source_list'); // expect value 'your_capital' or 'our_capital'

// normalize in case ACF is returning Label
$norm = strtolower(trim($cap_source));
$norm = str_replace(' ', '_', $norm);
$cap_source = in_array($norm, ['your_capital', 'our_capital'], true) ? $norm : 'our_capital';

// Resolve IDs + intro field
if ($cap_source === 'your_capital') {
    $content_source_id = $YOUR_CAPITAL_CONTENT_ID;
    $loop_parent_id    = $YOUR_CAPITAL_LOOP_PARENT_ID;
    $intro_field_name  = $INTRO_FIELD_YOUR;
} else {
    $content_source_id = $OUR_CAPITAL_CONTENT_ID;
    $loop_parent_id    = $OUR_CAPITAL_LOOP_PARENT_ID;
    $intro_field_name  = $INTRO_FIELD_OUR;
}

// Pull top intro block (single fallback to a second field name)
$cap_text_raw = (string) get_field($CAP_TEXT_PRIMARY, $content_source_id);
if ($cap_text_raw === '' || $cap_text_raw === null) {
    $cap_text_raw = (string) get_field($CAP_TEXT_FALLBACK, $content_source_id);
}

// Defaults
$cap_heading       = $cap_heading ?: 'What we offer';
$cap_text_raw      = $cap_text_raw ?: 'As a private capital partner, we offer access to high-quality, often under-the-radar opportunities across:';
$cap_text_rendered = apply_filters('the_content', $cap_text_raw);
?>

<section class="section--grey what-we-offer border-top-0">
  <div class="container pb-5">

    <div class="row d-flex justify-content-between align-items-start mb-5">
      <div class="col-md-5">
        <h2 class="mb-3"><?php echo esc_html($cap_heading); ?></h2>
      </div>
      <div class="col-lg-6 pe-lg-5">
        <?php echo $cap_text_rendered; ?>
      </div>
    </div>

    <?php
    // Loop child pages under the selected parent (308 or 306)
    $q = new WP_Query([
        'post_type'      => 'page',
        'post_parent'    => (int) $loop_parent_id,
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'no_found_rows'  => true,
    ]);

    if ($q->have_posts()):
        while ($q->have_posts()): $q->the_post();

            $intro        = (string) get_field($intro_field_name);
            $button_text  = (string) get_field('button_text');
            $button_text  = $button_text !== '' ? $button_text : 'Learn More';
            ?>
            <div class="row align-items-start gx-lg-5 offer-row border-top border-2 py-5">
              <div class="col-12 col-lg-8 pe-lg-5 mb-4 mb-lg-0">
                <h3 class="mb-4"><?php the_title(); ?></h3>

                <?php if ($intro !== ''): ?>
                  <p class="mb-4"><?php echo esc_html($intro); ?></p>
                <?php endif; ?>

                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-1 rounded-pill">
                  <?php echo esc_html($button_text); ?>
                </a>
              </div>

              <div class="col-12 col-lg-4">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'img-fluid rounded-top-right']);
                } else {
                    echo '<img src="https://placehold.co/600x400/eee/ccc?text=No+Image" alt="Placeholder" class="img-fluid rounded">';
                }
                ?>
              </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
  </div>
</section>
