<?php

/**
 * The header for our child theme
 *
 * Unified Bootstrap 5 header with shared navbar.
 *
 * @package Understrap Child
 */

defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
  <?php do_action('wp_body_open'); ?>
  <div class="site" id="page">

    <?php if (is_front_page()) : ?>

      <header id="wrapper-navbar"
        class="header-hero d-flex min-vh-100 flex-column justify-content-start text-white position-relative"
        style="background-image: url('<?php echo esc_url(get_stylesheet_directory_uri() . '/img/bg.jpg'); ?>'); background-size: cover;">

        <?php alceon_navbar(); ?>



        <div class="offcanvas offcanvas-end" tabindex="-1" id="tabletOffcanvasMenu" aria-labelledby="tabletMenuLabel">

          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="tabletMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body d-flex flex-column">

            <div class="flex-grow-1 overflow-y-auto">
              <?php
              wp_nav_menu(array(
                'theme_location' => 'mobile_menu', // Use mobile menu
                'container'      => false,
                'menu_class'     => 'navbar-nav mobile-accordion-menu', // Use accordion class
                'fallback_cb'    => false,
                'walker'         => null,
              ));
              ?>
            </div>

            <div class="mt-auto pt-4 border-top">
            </div>

          </div>
        </div>




        <div class="collapse w-100 mobile-menu-container" id="mobileCollapseMenu">

          <div class="container d-flex flex-column">







            <div class="navbar d-flex justify-content-between align-items-center mb-4">
              <a class="navbar-brand site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="logo-img">
              </a>
              <div class="d-flex align-items-center">
                <a href="/wp-login.php" class="btn btn-outline-primary rounded-pill me-3">Login</a>
                <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#mobileCollapseMenu" aria-label="Close"></button>
              </div>
            </div>

            <div class="flex-grow-1 mt-2 overflow-y-auto">

              <?php
              wp_nav_menu(array(
                'theme_location' => 'mobile_menu', // Use mobile menu
                'container'      => false,
                'menu_class'     => 'navbar-nav mobile-accordion-menu', // Use accordion class
                'fallback_cb'    => false,
                'walker'         => null,
              ));
              ?>


            </div>

            <div class="mt-auto"> <?php get_template_part('inc/select-drop-down'); ?> </div>

          </div>
        </div>

        <!--  END MOBILE/ TABLET MENUS -->



        <?php
        // Include modular sections
        get_template_part('template-parts/global/mega-menu', 'mega-menu');

        ?>

        <div class="container mt-5 d-flex align-items-center position-relative" style="z-index: 2;">
          <div class="row align-items-center g-5 py-5">
            <div class="col-lg-8">
              <h1 class="hero-title">Strategic Capital. Enduring Partnerships.</h1>
              <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <?php get_template_part('inc/select-drop-down'); ?>
              </div>
            </div>
          </div>
        </div>
      </header>

    <?php elseif (is_singular('post') || is_home()) : ?>

      <?php
      // --- Setup Internal Hero Variables ---

      // Get the image field (assuming "Image Array" return format in ACF)
      $header_image_data = get_field('header_image');
      $hero_classes      = 'section--blog-hero internal-hero bg-dark-blue text-white position-relative overflow-hidden min-vh-25 d-flex flex-column justify-content-between';

      ?>

      <header class="<?php echo esc_attr($hero_classes); ?>">

        <div class="w-100 position-relative z-3">
          <div class="container">
            <?php alceon_navbar(); // Just the navbar 
            ?>


          </div>
        </div>

        <?php
        // Include modular sections
        get_template_part('template-parts/global/mega-menu', 'mega-menu');
        ?>

        <?php // --- NEW FULL-WIDTH BOTTOM IMAGE --- 
        ?>
        <?php // This block was moved from outside the header and modified 
        ?>
        <?php if ($header_image_data) : ?>
          <div class="internal-hero__image-bottom w-100">
            <img
              src="<?php echo esc_url($header_image_data['url']); ?>"
              alt="<?php echo esc_attr($header_image_data['alt']); ?>">
          </div>
        <?php endif; ?>
        <?php // --- END NEW FULL-WIDTH BOTTOM IMAGE --- 
        ?>

      </header>
      <?php // The image section below is no longer needed, as it's now inside the header
      /*
    <?php if ($header_image) : ?>
      <section class="image-section image-section--half" aria-hidden="true">
        <div class="image-section__background" style="background-image: url('<?php echo esc_url($header_image); ?>');"></div>
      </section>
    <?php endif; ?>
    */
      ?>




    <?php else : ?>

      <?php
      // --- Setup Internal Hero Variables ---
      $hero_bg_image = get_field('hero_bg_image');
      $header_image = get_field('header_image');
      $hero_classes  = 'internal-hero bg-dark-blue text-white position-relative overflow-hidden min-vh-70 d-flex flex-column justify-content-between';
      $hero_style    = '';

      if ($hero_bg_image) {
        $hero_style = "background-image: url('" . esc_url($hero_bg_image) . "'); " .
          "background-size: cover; " .
          "background-position: bottom center; " .
          "background-repeat: no-repeat;";
      }
      ?>

      <header class="<?php echo esc_attr($hero_classes); ?>" <?php if ($hero_style) echo 'style="' . esc_attr($hero_style) . '"'; ?>>

        <div class="w-100 position-relative z-3">
          <div class="container">
            <?php alceon_navbar(); ?>
          </div>
        </div>

        <?php
        // Include modular sections
        get_template_part('template-parts/global/mega-menu', 'mega-menu');

        ?>
        <?php if (! is_single('post')) : ?>

          <div class="container position-relative z-2 internal-hero__text">
            <div class="row gy-4 justify-content-between align-items-start">
              <div class="col-12 col-lg-4">
                <h1 class="internal-hero__title mb-3"><?php the_title(); ?></h1>
              </div>
              <div class="col-12 col-lg-6 pe-lg-5">
                <h3 class="internal-hero__excerpt h2 mb-0">
                  <?php the_field('hero_paragraph'); ?>
                </h3>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if (! $hero_bg_image) : ?>
        <?php endif; ?>
      </header>

      <?php if ($header_image) : ?>
        <section class="image-section image-section--half" aria-hidden="true">
          <div class="image-section__background" style="background-image: url('<?php echo esc_url($header_image); ?>');"></div>
        </section>
      <?php endif; ?>

    <?php endif; // End if ( is_front_page() ) 
    ?>

    <script>
      // TOGGLE MENU

      /**
       * ========================================================================
       * MOBILE MENU ACCORDION
       *
       * This script finds all menus with the class '.mobile-accordion-menu'
       * and dynamically adds Bootstrap 5 collapse functionality and arrow toggles
       * to all parent menu items.
       * ========================================================================
       */
      document.addEventListener('DOMContentLoaded', function() {
        // Find all instances of our mobile menu
        const mobileMenus = document.querySelectorAll('.mobile-accordion-menu');

        if (!mobileMenus.length) {
          return; // Exit if no mobile menus are found
        }

        // A counter to ensure all IDs are unique
        let subMenuCounter = 0;

        mobileMenus.forEach((menu) => {
          const parentItems = menu.querySelectorAll('.menu-item-has-children');

          parentItems.forEach((item) => {
            const link = item.querySelector('a');
            const subMenu = item.querySelector('.sub-menu');

            if (!link || !subMenu) {
              return; // Skip if structure is broken
            }

            // 1. Give the sub-menu a unique ID and Bootstrap class
            const subMenuId = `mobile-submenu-${subMenuCounter++}`;
            subMenu.id = subMenuId;
            subMenu.classList.add('collapse');

            // 2. Create the arrow toggle button
            const toggleBtn = document.createElement('button');
            toggleBtn.classList.add('arrow-toggle');
            toggleBtn.setAttribute('data-bs-toggle', 'collapse');
            toggleBtn.setAttribute('data-bs-target', `#${subMenuId}`);
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.setAttribute('aria-controls', subMenuId);
            toggleBtn.innerHTML =
              '<span class="visually-hidden">Toggle submenu</span>';

            // 3. Create a wrapper to hold the link and the new button
            // This allows them to sit side-by-side
            const wrapper = document.createElement('div');
            wrapper.classList.add('menu-item-wrapper');

            // 4. Insert the wrapper and move the link into it
            link.parentNode.insertBefore(wrapper, link);
            wrapper.appendChild(link);

            // 5. Add the toggle button into the wrapper
            wrapper.appendChild(toggleBtn);
          });
        });
      });
    </script>