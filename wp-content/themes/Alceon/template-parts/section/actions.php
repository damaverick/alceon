<?php
/**
 * Actions Section
 * Grey section with heading, text, and action items repeater.
 */

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// Get fields
$heading = get_sub_field('actions_heading');
$text = get_sub_field('actions_text');
?>

<section class="section--grey" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-5" data-aos="fade-right">
        <?php if ($heading): ?>
          <h2><?php echo wp_kses_post($heading); ?></h2>
        <?php endif; ?>
      </div>
      
      <div class="col-md-7 d-flex flex-column" data-aos="fade-left">
        <?php if ($text): ?>
          <?php echo wp_kses_post($text); ?>
        <?php endif; ?>

        <?php if (have_rows('action_items')): ?>
          <section class="actions mt-5 pb-5 w100">
            <?php while (have_rows('action_items')): the_row();
                $action_title = get_sub_field('action_title');
                $action_url = get_sub_field('action_url');
                $action_button_text = get_sub_field('action_button_text');
                ?>
              <div class="action-row d-flex justify-content-between align-items-center border-bottom">
                <?php if ($action_title): ?>
                  <h3 class="h4 mb-0"><?php echo esc_html($action_title); ?></h3>
                <?php endif; ?>
                
                <?php if ($action_url && $action_button_text): ?>
                  <a href="<?php echo esc_url($action_url); ?>"
                     class="btn btn-outline-dark fw-bold rounded-pill btn-outline-primary">
                    <?php echo esc_html($action_button_text); ?>
                  </a>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </section>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
