<?php
/**
 * Logic Section.
 */

// 1. Context (The current page ID, e.g., 27)

$current_id = get_the_ID();
$parent_id  = wp_get_post_parent_id($current_id); //

// 2. Header & Intro Text
// IMPORTANT: Changed to get_sub_field() because these are inside the Flexible Content row
$cap_heading = get_sub_field('capability_source_heading') ?: 'What we offer';

// Handle the Intro Text Object
$intro_obj = get_sub_field_object('capability_source_intro_text');
$intro_val = $intro_obj['value'] ?? '';

// Logic: If it's an array, grab the label. If it's a value, look it up in choices.
if (is_array($intro_val)) {
    $top_intro_text = $intro_val['label'];
} else {
    $top_intro_text = $intro_obj['choices'][$intro_val] ?? $intro_val;
}

// 3. Determine which Children to Query (308 vs 306)
// IMPORTANT: Changed to get_sub_field() to read your selection correctly
$cap_source_raw = get_sub_field('capability_source');

// We convert to string just in case it returns an array object
$cap_source_str = is_array($cap_source_raw) ? json_encode($cap_source_raw) : (string) $cap_source_raw;

// Check if 'your_capital' is in the selection string
$is_your_capital = (stripos($cap_source_str, 'your_capital') !== false);

$loop_parent_id = $is_your_capital ? 308 : 306;

// 4. Query Setup
$q = new WP_Query([
    'post_type'      => 'page',
    'post_parent'    => $loop_parent_id,
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'no_found_rows'  => true,
]);

// 5. Determine Field Name for Child Items
// If we are on "Your Capital" (27), we pull 'listing_text'. Otherwise 'listing_text_your_capital'.
// $child_field_name = ($current_id === 27) ? 'listing_text' : 'listing_text_your_capital';

$child_field_name = ($parent_id === 310) ? 'listing_text' : 'listing_text_your_capital';

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

?>

<section class="section--grey what-we-offer border-top-0" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
    <div class="container">

        <div class="row d-flex justify-content-between align-items-start mb-lg-5">
            <div class="col-12">
                <h2 data-aos="fade-right">
                    <?php echo esc_html($cap_heading); ?>
                </h2>
            </div>
            <div class="col-12" data-aos="fade-right">
                <?php if (! empty($top_intro_text)) : ?>
                    <?php echo wp_kses_post(wpautop($top_intro_text)); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($q->have_posts()) : ?>
            <?php while ($q->have_posts()) : $q->the_post(); ?>

                <?php
                // Note: We keep get_field() here because we are now inside the child page loop,
                // grabbing data from the child page itself, not the flexible content row.
                $intro_text  = get_field($child_field_name);
                $button_text = get_field('button_text') ?: 'Learn More';
                ?>

                <div class="row align-items-start gx-lg-5 offer-row border-desktop-only border-top border-2 pt-5 pb-0 pb-md-5">
                    
                    <div class="col-12 col-lg-8 pe-lg-5 mb-4 mb-lg-0 mt-4 mt-md-0" data-aos="fade-right">
                        <h3 class="mb-3"><?php the_title(); ?></h3>

                        <?php if (! empty($intro_text)) : ?>
                            <p class="mb-3 mt-2 mb-sm-3"><?php echo esc_html($intro_text); ?></p>
                        <?php endif; ?>

                        <a data-aos="fade-up" href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-2 rounded-pill">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>

                    <div class="col-12 col-lg-4">
                        <?php if (has_post_thumbnail()) : ?>
                            <div data-aos="fade-left">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-top-right']); ?>
                            </div>
                        <?php else : ?>
                            <img src="https://placehold.co/600x400/eee/ccc?text=No+Image" alt="Placeholder" class="img-fluid rounded">
                        <?php endif; ?>
                    </div>

                </div>

            <?php endwhile;
wp_reset_postdata(); ?>
        <?php endif; ?>

    </div>
</section>