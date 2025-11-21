<section class="section--grey img-txt-section">
    <div class="container">

        <div class="row align-items-center mb-5 pb-5">
            <div class="col-md-5">
                <h2 class="mb-3">Who we partner with</h2>
            </div>
            <div class="col-lg-6 pe-lg-5">
                <?php
                // Check if the 'paragraph_text' field has content
                if (get_field('paragraph_text')) :
                ?>
                    <p class="mb-0">
                        <?php the_field('paragraph_text'); // Displays the field content 
                        ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <?php
        // Check if the ACF Repeater field 'capability' has rows
        if (have_rows('capability')) :

            $row_index = 0; // Initialize a counter for the alternating layout

            // Loop through each row
            while (have_rows('capability')) : the_row();

                // Increment the counter
                $row_index++;

                // --- 1. Get Sub Field Values ---
                $image = get_sub_field('capability_image'); // ACF Image Field (Return: Image Array)
                $title = get_sub_field('capability_title'); // ACF Text Field
                $text = get_sub_field('capability_text'); // ACF Text Area or WYSIWYG
                $button_text = get_sub_field('button_text'); // ACF Text Field
                $button_url = get_sub_field('button_url'); // ACF URL Field

                // --- 2. Logic for alternating row class ---
                // This adds 'flex-lg-row-reverse' to every 2nd, 4th, 6th row
                $row_class = ($row_index % 2 == 0) ? 'flex-lg-row-reverse' : '';

        ?>

                <div class="row align-items-center <?php echo esc_attr($row_class); ?> mb-5 pb-5">

                    <div class="col-12 col-lg-7">
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