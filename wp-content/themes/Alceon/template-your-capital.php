<?php

/**
 * 
Template Name: Your Capital

 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

<?php
/**
 * Dark Blue Intro Section
 *
 * Pulls content from 'section_blue_heading' and 'section_blue_text' fields.
 */

// 1. Get the ACF field values
// Note: Use get_sub_field() if this is inside a Flexible Content loop
$heading = get_field('section_blue_heading');
$text    = get_field('section_blue_text');

// 2. Only show the section if both fields have content
if ($heading && $text) :
?>

  <section class="section--dark-blue text-white">
    <div class="container">
      <div class="row d-flex justify-content-between">

        <div class="col-md-5">
          <h3 class="h2 text-white">
            <?php echo wp_kses_post($heading); // Allows safe HTML like <br> 
            ?>
          </h3>
        </div>

        <div class="col-md-6 pe-lg-5">
          <?php echo wpautop(wp_kses_post($text)); // Converts line breaks to <p> tags 
          ?>
        </div>

      </div>
    </div>
  </section>

<?php
endif; // End check for $heading && $text
?>



<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-heading-text');
?>

<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-icon-row-colored-bg');
?>

<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-fund-list');
?>




<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-icon-row');
?>


<?php if (is_page('your-capital')):
  // Inside a non-flexible template (e.g., page-about.php)
  get_template_part('template-parts/section/section-row-img-text');
endif
?>




<?php
// Include modular sections
get_template_part('template-parts/global/contact-form', 'contact');

?>
<?php
get_footer();
