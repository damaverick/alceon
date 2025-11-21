<?php
/* Template Name:   Home */

get_header();
?>

<section class="section-feature section--gradient section-feature--overlap-bottom">
  <div class="container">
    <div class="row position-relative align-items-start">

      <div class="col-lg-7 section-feature--overlap-bottom__img-wrap">
        <?php
        $intro_image = get_field('intro_image');
        if ($intro_image):
          $url = esc_url($intro_image['url']);
          $alt = esc_attr($intro_image['alt']);
        ?>
          <img src="<?php echo $url; ?>" class="img-fluid section-feature__image" alt="<?php echo $alt; ?>">
        <?php endif; ?>
      </div>

      <div class="col-lg-5">
        <div class="section-feature__content">
          <?php if (get_field('intro_text_home')): ?>
            <h3 class="text-white h2 mt-5"><?php echo  get_field('intro_text_home'); ?></h3>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>
<section class="section--dark-blue text-white">
  <div class="container">
    <div class="row align-items-start">
      <div class="col-12 col-lg-7 pt-5">
        <?php if (get_field('who_we_are_heading')): ?>
          <h2 class="mt-5 text-white"><?php echo  get_field('who_we_are_heading'); ?></h2>
        <?php endif; ?>

        <?php
        echo wpautop(get_field('who_we_are_text'));
        ?>
      </div>
    </div>

    <div class="row g-4 mt-5">

      <?php
      // Check if the 'stats_repeater' has rows
      if (have_rows('statistics')):
        // Loop through the rows
        while (have_rows('statistics')) : the_row();

          // Get sub-field values
          $stat = get_sub_field('stat_number');
          $description = get_sub_field('stat_description');
      ?>

          <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-item">
              <?php if ($stat): ?>
                <h2 class="stat-number"><?php echo esc_html($stat); ?></h2>
              <?php endif; ?>

              <?php if ($description): ?>
                <div class="stat-text w-75">
                  <p> <?php echo wp_kses_post($description);  ?></p>
                </div>
              <?php endif; ?>
            </div>
          </div>

      <?php
        endwhile;
      else :
      // No stats found
      endif;
      ?>

    </div> <?php if (get_field('stats_subtext')): ?>
      <p class="mt-5 footnotes"><?php echo esc_html(get_field('stats_subtext')); ?></p>
    <?php endif; ?>
  </div>
</section>



<?php
get_template_part('template-parts/section/section-full-width-img-video');
?>


<?php get_footer(); ?>