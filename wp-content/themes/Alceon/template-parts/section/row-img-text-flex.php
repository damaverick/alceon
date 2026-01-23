<?php
// --- Get Section Fields ---
$section_bg_color = get_sub_field('section_image_text__bg_color');
$section_heading  = get_sub_field('section_image_text__heading');
$section_intro    = get_sub_field('section_image_text__intro');
$image_offset     = get_sub_field('offset_image');
$column_ratio     = get_sub_field('column_width_ratio') ?: 'default';
$order_override   = get_sub_field('order_override') ?: 'alternating';

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// Determine column classes based on ratio
switch ($column_ratio) {
    case 'equal':
        $img_col_class = 'col-lg-6';
        $text_col_class = 'col-lg-6';
        break;
    case 'text_larger':
        $img_col_class = 'col-lg-5';
        $text_col_class = 'col-lg-7';
        break;
    case 'default':
    default:
        $img_col_class = 'col-lg-7';
        $text_col_class = 'col-lg-5';
        break;
}
?>

<section class="section--<?php echo esc_attr($section_bg_color); ?> img-txt-section<?php echo ($image_offset === 'yes') ? ' section-feature--overlap-bottom' : ''; ?>" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
    <div class="container">

        <?php if ($section_heading) : ?>
            <div class="row align-items-center">
                <div class="col-md-12 pb-5" data-aos="fade-up">
                    <h2 class="mb-3"><?php echo esc_html($section_heading); ?></h2>
                    <?php if ($section_intro) : ?>
                        <p class="mb-0">
                            <?php echo wp_kses_post($section_intro); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        if (have_rows('image_text_row')) :

            $row_index = 0;

            while (have_rows('image_text_row')) : the_row();
                $row_index++;

                // --- 1. Get Sub Field Values ---
                $image       = get_sub_field('image_text_row__image');
                $title       = get_sub_field('image_text_row__heading');
                $text        = get_sub_field('image_text_row__text');
                $button_text = get_sub_field('image_text_row__button_text');
                $button_url  = get_sub_field('image_text_row__button_url');

                // --- 2. Logic for Orientation & Animations ---
                // Check if order override is set
                if ($order_override === 'image_left') {
                    // Force image left, text right
                    $is_reversed = false;
                } elseif ($order_override === 'text_left') {
                    // Force text left, image right
                    $is_reversed = true;
                } else {
                    // Default: alternate based on row index
                    // If row index is even (2, 4, 6), it is reversed (Image on Right)
                    $is_reversed = ($row_index % 2 == 0);
                }

                if ($is_reversed) {
                    // REVERSED: Image on Right, Text on Left
                    $row_class = 'flex-lg-row-reverse';
                    $img_aos   = 'fade-left';  // Image slides IN from the right (to the left)
                    $text_aos  = 'fade-right'; // Text slides IN from the left (to the right)
                } else {
                    // STANDARD: Image on Left, Text on Right
                    $row_class = '';
                    $img_aos   = 'fade-right'; // Image slides IN from the left (to the right)
                    $text_aos  = 'fade-left';  // Text slides IN from the right (to the left)
                }
                ?>

                <!-- This is one row from the repeater -->
                <div class="row align-items-center <?php echo esc_attr($row_class); ?> mb-5 pb-lg-5 img-txt-section__row">

                    <!-- IMAGE COLUMN -->
                    <div class="col-12 <?php echo esc_attr($img_col_class); ?> img-wrap" data-aos="<?php echo esc_attr($img_aos); ?>">
                        <?php
                        if ($image) :
                            echo wp_get_attachment_image($image['ID'], 'large', false, [
                                'class' => 'img-fluid w-100 rounded-right',
                                'alt'   => $image['alt'],
                            ]);
                        else :
                            echo '<img src="https://placehold.co/800x600/eee/ccc?text=No+Image" alt="Placeholder" class="img-fluid rounded w-100">';
                        endif;
                ?>
                    </div>

                    <!-- TEXT COLUMN -->
                    <div class="col-12 <?php echo esc_attr($text_col_class); ?> mt-4 mt-lg-0" data-aos="<?php echo esc_attr($text_aos); ?>">

                        <?php if ($title) : ?>
                            <h3 class="mb-3"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mb-4">
                                <?php echo wp_kses_post($text); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($button_url && $button_text) : ?>
                            <a href="<?php echo esc_url($button_url); ?>" class="btn btn-outline-primary rounded-pill">
                                <?php echo esc_html($button_text); ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php
            endwhile;
endif;
?>

    </div>
</section>