  <div class="offcanvas offcanvas-end" tabindex="-1" id="tabletOffcanvasMenu" aria-labelledby="tabletMenuLabel">

      <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="tabletMenuLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body d-flex flex-column">

          <div class="flex-grow-0 overflow-y-auto">
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

          <div class="mt-4 pt-4 border-top">
              <div class="mt-4"> <?php get_template_part('inc/select-drop-down'); ?> </div>

          </div>

      </div>
  </div>




  <div class="collapse w-100 mobile-menu-container" id="mobileCollapseMenu">

      <div class="container d-flex flex-column">







          <div class="navbar d-flex justify-content-between align-items-start mb-4">
              <a class="navbar-brand site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                  <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="logo-img">
              </a>
              <div class="d-flex align-items-center">
                  <a href="https://dynamo.dynamosoftware.com/tenant/dynamo3.netagesolutions.com/alceon/RE-Portal" target="_blank" class="btn btn-outline-primary rounded-pill me-2">Investor Login</a>
                  <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#mobileCollapseMenu" aria-label="Close"></button>
              </div>
          </div>

          <div class="flex-grow-0 mt-5 overflow-y-auto">

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

          <div class="mt-3"> <?php get_template_part('inc/select-drop-down'); ?> </div>

      </div>
  </div>

  <!--  END MOBILE/ TABLET MENUS -->