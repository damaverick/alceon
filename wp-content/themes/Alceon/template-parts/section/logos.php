<?php
/**
 * Logos Section
 * White section with heading, text, and logos grid.
 */

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// Get fields
$heading = get_sub_field('logos_heading') ?: 'Community';
$text = get_sub_field('logos_text');
?>

<section class="section--white" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-3" data-aos="fade-right">
        <?php if ($heading): ?>
          <h2><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <?php if ($text): ?>
          <div><?php echo wp_kses_post($text); ?></div>
        <?php endif; ?>
      </div>

      <div class="col-md-9 pt-2 pt-md-0 ps-md-5" data-aos="fade-left">
        <?php
        // Render a logos grid
        if (have_rows('logo_items')):
            echo '<div class="institution-logos">';
            $idx = 0;
            while (have_rows('logo_items')) : the_row();
                $logo_name = get_sub_field('logo_name');
                $logo_image = get_sub_field('logo_item');
                $logo_link = get_sub_field('logo_url'); // This is a Link field (array)

                $logo_url = $logo_image ? esc_url($logo_image['url']) : '';
                $logo_alt = $logo_image && !empty($logo_image['alt']) ? esc_attr($logo_image['alt']) : esc_attr($logo_name ?: 'Logo');
                $link_url = $logo_link && is_array($logo_link) ? esc_url($logo_link['url']) : '';
                $link_target = $logo_link && is_array($logo_link) && !empty($logo_link['target']) ? $logo_link['target'] : '_blank';

                $logo_number = $idx + 1;
                ?>
            <div class="logo-item logo-<?php echo $logo_number; ?>">
              <?php if ($logo_url): ?>
                <div class="logo-box">
                  <?php if ($link_url): ?>
                    <a href="<?php echo $link_url; ?>" target="<?php echo esc_attr($link_target); ?>" rel="noopener noreferrer">
                  <?php endif; ?>
                  
                  <img src="<?php echo $logo_url; ?>"
                       alt="<?php echo $logo_alt; ?>"
                       class="logo-img" />
                  
                  <?php if ($link_url): ?>
                    </a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
        <?php
                $idx++;
            endwhile;
            echo '</div>';
        endif;
?>
      </div>
    </div>
  </div>
</section>
