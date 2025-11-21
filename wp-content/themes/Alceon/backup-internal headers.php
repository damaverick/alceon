
    <?php elseif (is_singular('post')) : ?>

      <?php
      // --- Setup Internal Hero Variables ---
      // Get the image field (assuming "Image Array" return format in ACF)
      $header_image_data = get_field('header_image');
      $hero_classes = 'section--blog-hero internal-hero bg-dark-blue text-white position-relative overflow-hidden min-vh-25 d-flex flex-column justify-content-between';
      ?>

      <?php if (is_singular('post') && !$header_image_data) : ?>
        <style>
          .section--blog-hero.internal-hero {
            min-height: 360px !important;
          }
        </style>
      <?php endif; ?>

      <header class="<?php echo esc_attr($hero_classes); ?>">
        <div class="w-100 position-relative z-3">
          <div class="container">
            <div class="row">
                <div class="col">
                    <?php alceon_navbar(); ?>
                </div>
            </div>
            
          </div>
        </div>

        <?php get_template_part('template-parts/global/mobile-menus'); ?>
        <?php get_template_part('template-parts/global/mega-menu'); ?>

        <?php if ($header_image_data) : ?>
          <div class="internal-hero__image-bottom w-100">
            <img
              src="<?php echo esc_url($header_image_data['url']); ?>"
              alt="<?php echo esc_attr($header_image_data['alt']); ?>">
          </div>
        <?php endif; ?>
      </header>

    <?php else : ?>

      <?php
      // --- Setup Internal Hero Variables ---
      $hero_bg_image = get_field('hero_bg_image');
      $header_image  = get_field('header_image');
      $hero_classes  = 'internal-hero bg-dark-blue text-white position-relative overflow-hidden min-vh-70 d-flex flex-column justify-content-between';
      $hero_style    = '';

      if ($hero_bg_image) {
        $hero_style = "background-image: url('" . esc_url($hero_bg_image) . "'); "
          . "background-size: cover; "
          . "background-position: bottom center; "
          . "background-repeat: no-repeat;";
      }
      ?>

      <header class="<?php echo esc_attr($hero_classes); ?>" <?php if ($hero_style) echo 'style="' . esc_attr($hero_style) . '"'; ?>>
        <div class="w-100 position-relative z-3">
          <div class="container">
            <?php alceon_navbar(); ?>
          </div>
        </div>

        <?php get_template_part('template-parts/global/mobile-menus'); ?>
        <?php get_template_part('template-parts/global/mega-menu'); ?>

        <?php if (!is_single('post')) : ?>
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
      </header>



    <?php if ($header_image) : ?>
      <section class="image-section image-section--half" aria-hidden="true">
        <div class="image-section__background" style="background-image: url('<?php echo esc_url($header_image); ?>');"></div>
      </section>
    <?php endif; ?>
