<?php

/**
 * Template Name: Contact.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Auto-link phone numbers in content
 * Finds patterns like "Tel: +61 2 8023 4000" or "Fax: +61 2 8023 4001".
 */
function alceon_autolink_phones($content)
{
    // Pattern matches Tel: or Fax: followed by phone number with international format
    // Captures country code (+XX) and the rest of the number with spaces/dashes
    $pattern = '/\b(Tel|Fax):\s*([\+\d][\d\s\-\(\)]+\d)/i';

    return preg_replace_callback($pattern, function ($matches) {
        $label = $matches[1]; // Tel or Fax
        $number = $matches[2]; // The actual phone number

        // Create clean tel: link (remove spaces, dashes, parentheses)
        $clean_number = preg_replace('/[\s\-\(\)]/', '', $number);

        // Return linked version
        return $label . ': <a href="tel:' . esc_attr($clean_number) . '" class="text-white text-decoration-underline">' . esc_html($number) . '</a>';
    }, $content);
}

get_header();

$container = get_theme_mod('understrap_container_type');

?>



<div id="content" tabindex="-1">

  <div class="<?php echo esc_attr($container); ?> section--white">
    <div class="row gy-4 justify-content-between align-items-start">


      <div class="col-lg-4 pe-0 text-blue" data-aos="fade-right">


        <?php if (get_field('intro_contact')) : ?>
          <?php the_field('intro_contact'); // Using the_field() to allow for <p> tags from a WYSIWYG editor
            ?>
        <?php endif; ?>
      </div>


      <div class="col-lg-6 pe-lg-5" data-aos="fade-left">

          <script charset="utf-8" type="text/javascript" src="//js-ap1.hsforms.net/forms/embed/v2.js"></script>
      <div class="custom-hubspot-form form-white-bg">
<script>
  window.hbspt.forms.create({
    portalId: "4264043",
    formId: "42189065-a810-4835-9d7e-2072a2d6eaf7",
    region: "ap1",
        
              // 2. Updated the target to look for that specific ID
              target: '.form-white-bg', 
    /* This function runs once the form is loaded */
    onFormReady: function($form) {
        
        // 1. First Name
        $form.find('input[name="firstname"]').attr('placeholder', 'First Name');
        
        // 2. Last Name
        $form.find('input[name="lastname"]').attr('placeholder', 'Last Name');
        
        // 3. Email
        $form.find('input[name="email"]').attr('placeholder', 'name@company.com');
        
        // 4. Message (Textarea)
        $form.find('textarea[name="message"]').attr('placeholder', 'How can we help?');

        // 5. Company (Example of a custom field)
        $form.find('input[name="company"]').attr('placeholder', 'Company');

        // 6. Mobile  (Example of a custom field)
        $form.find('input[name="mobilephone"]').attr('placeholder', 'Mobile Phone');

        // 7. Change Submit Button Text
        // We target the class .hs-button and change the value
        $form.find('.hs-button').val('Submit Request');
    }
  });
</script>
 
    
      </div>



      </div>


    </div>

  </div>



  <?php if (have_rows('flexible_content')): ?>
    <section class="flexible-content-wrapper">
      <?php while (have_rows('flexible_content')): the_row(); ?>


        <?php if (get_row_layout() == 'full_width_image_or_video'):

            get_template_part('template-parts/section/full-width-img-video-flex'); ?>

        <?php endif; ?>



      <?php endwhile; ?>
    </section>
  <?php endif; ?>



<section class="section-contact section--gradient text-white">
  <div class="container">
    
    <?php
    // Start the main 'Country Sections' loop
    if (have_rows('country_sections')):
        while (have_rows('country_sections')) : the_row();

            // Get the country name
            $country_name = get_sub_field('country_name');
            ?>

            <div class="row mt-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="text-white pb-0 pb-md-5"><?php echo esc_html($country_name); ?></h2>
                </div>
            </div>

            <div class="row">
                <?php
                // Start the nested 'Locations' loop
                if (have_rows('locations')):

                    // 1. Initialize counter (Resets for each country)
                    $loc_index = 0;

                    while (have_rows('locations')) : the_row();

                        // Get location sub-fields
                        $title = get_sub_field('location_title');
                        $details = get_sub_field('location_details');

                        // 2. Calculate delay (0ms, 100ms, 200ms...)
                        $aos_delay = $loc_index * 100;
                        ?>

                        <div class="col-lg-3 col-md-6 mb-4" 
                             data-aos="fade-up" 
                             data-aos-delay="<?php echo intval($aos_delay); ?>">
                            
                            <?php if ($title): ?>
                                <h5 class="fw-bold"><?php echo esc_html($title); ?></h5>
                            <?php endif; ?>
                            
                            <?php if ($details): ?>
                                <div class="location-details">
                                    <?php echo alceon_autolink_phones(wpautop($details)); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                        <?php
                        // 3. Increment counter
                        $loc_index++;
                    endwhile; // End nested 'locations' loop
                endif;
            ?>
            </div> 
            
            <?php
        endwhile; // End main 'country_sections' loop
    endif;
?>

  </div>
</section>



  <?php
get_footer();
