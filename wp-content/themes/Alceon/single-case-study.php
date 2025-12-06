<?php

/**


 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

<section class="section-feature section--gradient section--stats  section-feature--overlap-bottom">
  <div class="container">

    <?php
    // Check if the 'statistics' repeater field has rows
    if (have_rows('statistics')):
        ?>
      <div class="row  g-lg-5 justify-content-start">

        <?php
            // Loop through each statistic
            while (have_rows('statistics')) : the_row();
                $statistic = get_sub_field('statistic');
                $supporting_text = get_sub_field('supporting_text');
                ?>

          <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-item">
              <?php if ($statistic): ?>
                <div class="stat-item__number"><?php echo esc_html($statistic); ?></div>
              <?php endif; ?>
              <?php if ($supporting_text): ?>
                <p class="stat-item__text"><?php echo esc_html($supporting_text); ?></p>
              <?php endif; ?>
            </div>
          </div>

        <?php endwhile; // End statistic loop
        ?>

      </div>
    <?php endif; // End if( have_rows('statistics') )
?>


    <div class="row position-relative align-items-center mt-5 pt-5">

      <div class="col-lg-7 section-feature--overlap-bottom__img-wrap">
        <?php
    // Check if the post has a Featured Image
    if (has_post_thumbnail()) :

        // Display the Featured Image, adding your custom classes
        the_post_thumbnail('full', [
          'class' => 'img-fluid section-feature__image rounded-right'
        ]);

    endif;
?>
      </div>

      <div class="col-lg-5">
        <div class="section-feature__content">
          <?php
  // Get Testimonial fields
  $testimonial = get_field('testimonial');
$referee_name = get_field('referee_name');
$referee_title = get_field('referee_title');
?>

          <?php if ($testimonial): ?>
            <h3 class="text-white h2 mt-5"><?php echo esc_html($testimonial); ?></h3>
          <?php endif; ?>

          <?php if ($referee_name || $referee_title): // Only show <p> if at least one exists
              ?>
            <p>
              <?php if ($referee_name): ?>
                <strong><?php echo esc_html($referee_name); ?></strong>
              <?php endif; ?>

              <?php if ($referee_title): ?>
                <br><?php echo esc_html($referee_title); ?>
              <?php endif; ?>
            </p>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>
</section>


<section class="section--white   mt-5 border-top-0 pb-5">
  <div class="container">

    <div class="row d-flex justify-content-between align-items-start mb-5">
      <div class="col-md-5">
        <h2 class="mb-3">Asset Highlights</h2>
      </div>
      <div class="col-md-7">
        <?php
        // Get 'asset_highlights' (assuming this is a WYSIWYG field)
        $asset_highlights = get_field('asset_highlights');
if ($asset_highlights) {
    echo wp_kses_post($asset_highlights); // This will output the <ul> list from the editor
}
?>
      </div>
    </div>

  </div>
</section>




<?php
get_template_part('template-parts/section/section-full-width-img-video');
?>

<?php
get_footer();
