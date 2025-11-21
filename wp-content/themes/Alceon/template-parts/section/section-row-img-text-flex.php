<?php
// --- Get Section Fields ---
// These fields apply to the whole section, so we get them before the HTML.

// Get the background color field (e.g., a value like 'white', 'grey-light')
$section_bg_color = get_sub_field('section_image_text__bg_color');

// Get the main heading for the section
$section_heading = get_sub_field('section_image_text__heading');

// Get the intro paragraph
$section_intro = get_sub_field('section_image_text__intro');



$image_offset = get_sub_field('offset_image');
?>

<section class="section--<?php echo esc_attr( $section_bg_color ); ?> img-txt-section<?php echo ( $image_offset === 'yes' ) ? ' section-feature--overlap-bottom' : ''; ?>">
    <div class="container">

 

        <div class="row align-items-center">
            <div class="col-md-12 pb-5">
                <?php if ($section_heading) :  ?>
                    <h2 class="mb-3"><?php echo esc_html($section_heading); ?></h2>
                     <?php endif; ?>
                    <?php if ($section_intro) :  ?>
                       <p class="mb-0">
                        <?php
                        // Use wp_kses_post() if this is a WYSIWYG or text area that allows HTML
                        echo wp_kses_post($section_intro);
                        ?>
                    </p>
                <?php endif; ?>


           

            </div>
           

        <?php
        // Check if the ACF Repeater field 'image_text_row' has rows
        if (have_rows('image_text_row')) :

            $row_index = 0; // Initialize a counter for the alternating layout

            // Loop through each row
            while (have_rows('image_text_row')) : the_row();

                // Increment the counter
                $row_index++;

                // --- 1. Get Sub Field Values (for this specific row) ---
                $image = get_sub_field('image_text_row__image'); // ACF Image Field (Return: Image Array)
                $title = get_sub_field('image_text_row__heading'); // ACF Text Field
                $text = get_sub_field('image_text_row__text'); // ACF Text Area or WYSIWYG
                $button_text = get_sub_field('image_text_row__button_text'); // ACF Text Field
                $button_url = get_sub_field('image_text_row__button_url'); // ACF URL Field

                // --- 2. Logic for alternating row class ---
                // This adds 'flex-lg-row-reverse' to every 2nd, 4th, 6th row
                $row_class = ($row_index % 2 == 0) ? 'flex-lg-row-reverse' : '';

        ?>

                <!-- This is one row from the repeater -->
                <div class="row align-items-center <?php echo esc_attr($row_class); ?> mb-5 pb-5 img-txt-section__row">

                    <div class="col-12 col-lg-7 img-wrap">
                        <?php
                        if ($image) :
                            // Display image using its ID for full responsive support
                            echo wp_get_attachment_image($image['ID'], 'large', false, [
                                'class' => 'img-fluid w-100 rounded-right',
                                'alt' => $image['alt'] // Use alt text from Media Library
                            ]);
                        else :
                            // Placeholder if no image is set
                            echo '<img src="https://placehold.co/800x600/eee/ccc?text=No+Image" alt="Placeholder" class="img-fluid rounded w-100">';
                        endif;
                        ?>
                    </div>

                    <div class="col-12 col-lg-5 mt-4 mt-lg-0">

                        <?php if ($title) : ?>
                            <h3 class="mb-3"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mb-4">
                                <?php echo wp_kses_post($text); // Allows basic HTML like <strong>, <em>
                                ?>
                            </p>
                        <?php endif; ?>

                        <?php
                        // Check if both button URL and text exist
                        if ($button_url && $button_text) :
                        ?>
                            <a href="<?php echo esc_url($button_url); ?>" class="btn btn-outline-primary rounded-pill">
                                <?php echo esc_html($button_text); ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
        <?php
            // End the loop
            endwhile;
        endif;
        ?>

    </div>
</section>