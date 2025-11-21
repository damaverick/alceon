<?php

/**
 Template Name: About Us

 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

<?php
// Include modular sections
// get_template_part( 'template-parts/hero-slim', 'hero-slim' );

?>

<div class="<?php echo esc_attr($container); ?> container" id="content" tabindex="-1">

  <div class="row">

    <section class="section--white d-flex pb-5">

      <div class="col-md-5">
        <?php if (get_field('intro_heading')) : ?>
          <h2><?php echo esc_html(get_field('intro_heading')); ?></h2>
        <?php endif; ?>
      </div>

      <div class="col-md-7">
        <?php if (get_field('intro_text')) : ?>
          <?php the_field('intro_text'); // Using the_field() to allow for <p> tags from a WYSIWYG editor 
          ?>
        <?php endif; ?>
      </div>
    </section>

  </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>


<section class="section--carousel position-relative overflow-hidden   pt-4 pb-5">
  <div class="container d-flex justify-content-between align-items-center mb-5">
    <h2 class="mb-0">Some of the faces behind Alceon</h2>
    <div class="carousel-nav d-flex gap-2">
      <button class="carousel-button-prev" aria-label="Previous slide">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
        </svg>
      </button>
      <button class="carousel-button-next" aria-label="Next slide">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
      </button>
    </div>
  </div>

  <div class="carousel-wrapper position-relative w-100">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <?php
        // Check if the repeater field has rows of data
        if (have_rows('our_team')):
          // Loop through the rows of data
          while (have_rows('our_team')) : the_row();

            // Get sub field values
            $image = get_sub_field('image'); // ACF Image field (returns an array)
            $name = get_sub_field('name'); // Text field
            $title = get_sub_field('title'); // Text field
            $text = get_sub_field('text');   // Text field (for the role)
            $bio = get_sub_field('bio');     // WYSIWYG or Textarea field

        ?>

            <div class="swiper-slide">
              <div class="card team-card">

                <?php
                // Handle the Image field
                if ($image) :
                  $image_url = esc_url($image['url']);
                  // Use the image's alt text, or fall back to the person's title
                  $image_alt = $image['alt'] ? esc_attr($image['alt']) : esc_attr($title);
                ?>
                  <img src="<?php echo $image_url; ?>" class="card-img-top" alt="<?php echo $image_alt; ?>" />
                <?php else :
                  // Optional: show a placeholder if no image is set
                  $placeholder_url = esc_url(get_stylesheet_directory_uri() . '/img/team/placeholder.jpg');
                ?>
                  <img src="<?php echo $placeholder_url; ?>" class="card-img-top" alt="<?php echo esc_attr($title); ?>" />
                <?php endif; ?>


                <div class="card-body">
                  <?php if ($name) : ?>
                    <h5 class="card-title mb-1"><?php echo esc_html($name); ?></h5>
                  <?php endif; ?>
                  <?php if ($title) : ?>
                    <p class="card-text mb-3"><?php echo esc_html($title); ?></p>
                  <?php endif; ?>
                  <?php if ($text) : ?>
                    <p class="card-text mb-3"><?php echo esc_html($text); ?></p>
                  <?php endif; ?>

                  <?php
                  // Only show the collapse section and button if there is bio text
                  if ($bio) :
                  ?>
                    <div class="card-more collapse">
                      <?php echo wpautop(esc_html($bio)); // Converts line breaks to <p> tags 
                      ?>
                    </div>

                    <button
                      class="read-more-btn d-flex justify-content-between align-items-center w-100"
                      type="button">
                      <span>Read More</span>
                      <span class="read-more-icon"></span>
                    </button>
                  <?php endif; // end if $bio 
                  ?>
                </div>
              </div>
            </div>

        <?php
          endwhile;
        else :
        // No slides found
        // You could output a message here if you wanted
        endif;
        ?>
      </div>
    </div>

  </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".mySwiper", {
      slidesPerView: 3, // show 3 fully + peek 4th
      spaceBetween: 24,
      loop: false,
      grabCursor: true,
      centeredSlides: false,
      watchOverflow: true, // ✅ disables Swiper if too few slides
      navigation: {
        nextEl: ".carousel-button-next",
        prevEl: ".carousel-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1.1
        },
        768: {
          slidesPerView: 2.2
        },
        1200: {
          slidesPerView: 3.2
        },
      },
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".team-card").forEach((card, i) => {
      const moreBtn = card.querySelector(".read-more-btn");
      const moreSection = card.querySelector(".card-more");

      // Check if the 'Read More' button exists before adding listeners
      if (moreBtn && moreSection) {
        // Find the text span inside the button
        const btnTextSpan = moreBtn.querySelector("span"); // ADDED THIS LINE

        // Assign unique IDs so Bootstrap collapse works independently
        const uniqueId = `cardMore-${i}`;
        moreSection.id = uniqueId;
        moreBtn.setAttribute("data-bs-toggle", "collapse");
        moreBtn.setAttribute("data-bs-target", `#${uniqueId}`);
        moreBtn.setAttribute("aria-controls", uniqueId);

        // Update text, plus/minus state manually
        moreSection.addEventListener("show.bs.collapse", () => {
          moreBtn.setAttribute("aria-expanded", "true");
          if (btnTextSpan) btnTextSpan.textContent = "Read Less"; // ADDED THIS LINE
        });

        moreSection.addEventListener("hide.bs.collapse", () => {
          moreBtn.setAttribute("aria-expanded", "false");
          if (btnTextSpan) btnTextSpan.textContent = "Read More"; // ADDED THIS LINE
        });
      }
    });
  });
</script>


<section class="section--dark-blue text-white">

  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-5 col-md-5 align-center flex-column d-flex justify-content-center pr-3">
        <h2 class="text-white">How we work</h2>
        <?php the_field('how_we_work_text'); ?>
      </div>
      <div class="col-md-7 d-flex justify-content-end">
        <?php
        $work_image = get_field('how_we_work_image');
        if ($work_image):
          $work_image_url = esc_url($work_image['url']);
          $work_image_alt = $work_image['alt'] ? esc_attr($work_image['alt']) : 'How we work'; // Fallback alt
        ?>
          <img class="rounded-right w-100" src="<?php echo $work_image_url; ?>" alt="<?php echo $work_image_alt; ?>" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>



<section class="section--grey">

  <div class="container">
    <div class="row d-flex justify-content-between">
      <div class="col-md-5">
        <h2>Partner with Us</h2>

      </div>
      <div class="col-md-7 d-flex flex-column">
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

<section class="section--accordion">
  <div class="container">

    <div class="accordion accordion--custom" id="infoAccordion">
      <h2>Community</h2>
      <?php the_field('community_text'); ?>

      <?php
      // Check if the repeater field 'institution' has rows of data
      if (have_rows('institution')):
        // Loop through the rows of data
        $accordion_index = 0; // For unique IDs
        while (have_rows('institution')) : the_row();

          // Get sub field values
          $name        = get_sub_field('name');
          $bio         = get_sub_field('bio');
          $url         = get_sub_field('url');
          $logo        = get_sub_field('logo'); // Image array
          $button_text = get_sub_field('button_text');

          // Create unique IDs for accordion controls
          $heading_id  = 'heading-' . $accordion_index;
          $collapse_id = 'collapse-' . $accordion_index;

          // Is this the first item?
          $is_first = ($accordion_index === 0);
      ?>

          <div class="accordion-item">
            <h3 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                aria-expanded= "false"
                aria-controls="<?php echo esc_attr($collapse_id); ?>">
                <span class="accordion-title h4"><?php echo esc_html($name); ?></span>
                <span class="accordion-icon"></span>
              </button>
            </h3>

            <div
              id="<?php echo esc_attr($collapse_id); ?>"
              class="accordion-collapse collapse"
              aria-labelledby="<?php echo esc_attr($heading_id); ?>"
              data-bs-parent="#infoAccordion">
              <div class="accordion-body">
                <div class="accordion-content d-flex flex-wrap align-items-start -flex  flex-column-reverse flex-xl-row justify-content-between">

                  <div class="accordion-text pe-4 flex-grow-1 d">
                    <?php the_sub_field('bio'); ?>

                    <?php if ($url && $button_text): ?>
                      <a href="<?php echo esc_url($url); ?>" class="btn btn-outline-primary fw-bold rounded-pill mt-3" target="_blank">
                        <?php echo esc_html($button_text); ?>
                      </a>
                    <?php endif; ?>
                  </div>

                  <?php if ($logo): ?>
                    <div class="accordion-logo flex-shrink-0 text-end">
                      <img src="<?php echo esc_url($logo['url']); ?>"
                        alt="<?php echo esc_attr($logo['alt']); ?>"
                        width="170"
                        height="auto"
                        class="img-fluid">
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>

      <?php
          $accordion_index++; // Increment index
        endwhile;
      endif;
      ?>

    </div>
  </div>
</section>



<?php
get_footer();
