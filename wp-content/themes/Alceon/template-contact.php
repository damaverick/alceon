<?php

/**
 Template Name: Contact

 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>



<div id="content" tabindex="-1">

  <div class="container section--white">

    <div class="row gy-4 justify-content-between align-items-start">


      <div class="col-lg-4 pe-0">
        <h2>Let’s connect</h2>
        <p class="text-blue">We welcome all enquiries, big or small. Share a few details here, and a member of our team will be in touch shortly.</p>
      </div>


      <div class="col-lg-6 pe-lg-5">

        <script charset="utf-8" type="text/javascript" src="//js-ap1.hsforms.net/forms/embed/v2.js"></script>


        <div class="custom-hubspot-form form-white-bg">
          <script>
            hbspt.forms.create({
              portalId: "45104793",
              formId: "721c4dd4-9f37-4944-b86f-d4945c761935",
              region: "ap1",
              onFormReady: function($form) {
                $form.find('input[type="submit"]').val('Submit');
              }
            });
          </script>
        </div>

      </div>


    </div>

  </div>



  <section class="image-section image-section--full" aria-hidden="true">
    <div class="image-section__background"></div>
  </section>


  <?php
  // Include modular sections
  get_template_part('template-parts/global/contact-form', 'contact');

  ?>
  <?php
  get_footer();
