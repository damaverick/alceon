<?php

/** Template Name: About Us */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

<?php
// Include modular sections
// get_template_part( 'template-parts/hero-slim', 'hero-slim' );

?>




  <section class="section--white">

 <div class="container">
   <div class="row d-flex">
        <div class="col-12 col-md-5">
      <?php if (get_field('intro_heading')) : ?>
        <h2 data-aos="fade-right"><?php echo esc_html(get_field('intro_heading')); ?></h2>
      <?php endif; ?>
    </div>

    <div class="col-12 col-md-7">
      <?php if (get_field('intro_text')) : ?>
        <div data-aos="fade-left">
        <?php the_field('intro_text'); // Using the_field() to allow for <p> tags from a WYSIWYG editor
          ?>
        </div>
      <?php endif; ?>
    </div>
   </div>
 </div>
  </section>





<?php if (have_rows('flexible_content')): ?>
    <?php while (have_rows('flexible_content')): the_row(); ?>
        <?php if (get_row_layout() == 'image_carousel_with_modal'): ?>
            <?php get_template_part('template-parts/section/carousel_modal'); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<section class="section--dark-blue text-white">

  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-5 col-md-5 align-center flex-column d-flex justify-content-center pr-3" data-aos="fade-right">
        <h2 class="text-white">How we work</h2>
        <?php the_field('how_we_work_text'); ?>
      </div>
      <div class="col-md-7 mt-5 mt-md-0 d-flex justify-content-end">
        <?php
$work_image = get_field('how_we_work_image');
if ($work_image):
    $work_image_url = esc_url($work_image['url']);
    $work_image_alt = $work_image['alt'] ? esc_attr($work_image['alt']) : 'How we work'; // Fallback alt
    ?>
          <img class="rounded-right w-100" data-aos="fade-left" src="<?php echo $work_image_url; ?>" alt="<?php echo $work_image_alt; ?>" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>



<section class="section--grey">

  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-5" data-aos="fade-right">
        <h2>Partner with Us</h2>

      </div>
      <div class="col-md-7 d-flex flex-column" data-aos="fade-left">
        <?php the_field('partner_with_us_text'); ?>

        <section class="actions mt-5 pb-5 w100">
          <div class="action-row d-flex justify-content-between align-items-center  border-bottom">
            <h3 class="h4 mb-0">Your Capital</h3>
            <a href="<?php echo get_bloginfo('url'); ?>/your-capital" class="btn btn-outline-dark fw-bold rounded-pill btn-outline-primary">Invest</a>
          </div>

          <div class="action-row d-flex justify-content-between align-items-center  border-bottom">
            <h3 class="h4 mb-0">Our Capital</h3>
            <a href="<?php echo get_bloginfo('url'); ?>/our-capital" class="btn btn-outline-dark fw-bold rounded-pill btn-outline-primary">Grow</a>
          </div>

          <div class="action-row d-flex justify-content-between align-items-center  border-bottom">
            <h3 class="h4 mb-0">Your Career</h3>
            <a href="<?php echo get_bloginfo('url'); ?>/your-career" class="btn btn-outline-dark fw-bold rounded-pill btn-outline-primary">Join</a>
          </div>
        </section>



      </div>
    </div>
  </div>
</section>

<section class="section--white">
  <div class="container">

  <div class="row d-flex justify-content-between">
    <div class="col-md-3" data-aos="fade-right"> 
      <h2>Community</h2>
    <div>
      <?php the_field('community_text'); ?>
    </div>
  </div>

    <div class="col-md-9 pt-2 pt-md-0 ps-md-5" data-aos="fade-left">
    

      <?php
      // Render a logos grid (3 per row)
      $institutions = get_field('institution');
if ($institutions):
    echo '<div class="institution-logos">';
    foreach ($institutions as $idx => $inst):
        $logo = $inst['logo'] ?? false;
        $logo_url = $logo ? esc_url($logo['url']) : '';
        $logo_alt = $logo && !empty($logo['alt']) ? esc_attr($logo['alt']) : esc_attr($inst['name'] ?? 'Logo');
        ?>
          <div class="logo-item">
          <?php if ($logo_url): ?>
            <div class="logo-box">
            <img
              src="<?php echo $logo_url; ?>"
              alt="<?php echo $logo_alt; ?>"
              class="logo-img"
            />
            </div>
          <?php endif; ?>
          </div>
        <?php
    endforeach;
    echo '</div>';
endif;
?>
    </div>


   </div>
  </div>
  </div>
</section>



<?php
get_footer();
