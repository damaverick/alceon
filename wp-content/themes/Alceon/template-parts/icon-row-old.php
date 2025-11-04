<?php if (get_row_layout() == 'section_icon_row'): ?>
    <?php
    // Get the main heading for the whole section
    $heading = get_sub_field('heading');
    ?>


<section class="section--white icon-row pt-0">
  <div class="container">

    <?php if ($heading): // Check if heading exists ?>
        <div class="row mb-5">
          <div class="col-12">
            <h2 class="icon-row__heading mb-3"><?php echo esc_html($heading); ?></h2>
          </div>
        </div>
    <?php endif; ?>

    <?php
    // Check if the repeater field (named 'icons') has rows
    if (have_rows('icon_item')):
    ?>
        <div class="row justify-content-between gy-5 gx-4 gx-lg-5">

        <?php
        // Loop through each icon in the repeater
        while (have_rows('icon_item')) : the_row();

            // Get the sub-fields for *this specific icon*
            $icon_img = get_sub_field('icon');
            $icon_heading = get_sub_field('icon_heading');
            $icon_text = get_sub_field('icon_text');
            $icon_subtext = get_sub_field('sub_text');
        ?>

          <div class="col-12 col-sm-6 col-lg-3 text-center text-lg-start">
            
            <?php if ($icon_img): // Check for image and use its URL and Alt text ?>
                <img src="<?php echo esc_url($icon_img['url']); ?>" 
                     alt="<?php echo esc_attr($icon_img['alt']); ?>" 
                     class="icon-row__icon mb-3">
            <?php endif; ?>

            <?php if ($icon_heading): ?>
                <h4 class="icon-row__title mb-2 sml"><?php echo esc_html($icon_heading); ?></h4>
            <?php endif; ?>

            <?php if ($icon_text): // Using wp_kses_post to allow basic HTML like <strong> ?>
                <p class="icon-row__text mb-0">
                    <?php echo wp_kses_post($icon_text); ?>
                </p>
            <?php endif; ?>
            
            <?php if ($icon_subtext): // Added this part for your sub_text field ?>
                <p class="icon-row__subtext mt-2">
                    <?php echo wp_kses_post($icon_subtext); ?>
                </p>
            <?php endif; ?>

          </div>

        <?php endwhile; // End the icon loop ?>

      </div><?php endif; // End if( have_rows('icons') ) ?>

  </div></section>

<?php endif; // End if (get_row_layout() == 'section_icon_row') ?>