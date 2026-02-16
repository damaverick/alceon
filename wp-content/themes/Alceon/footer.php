<?php

/**
 * The template for displaying the footer.
 *
 * Custom footer for Alceon Understrap child theme.
 */

defined('ABSPATH') || exit;

if (
    is_singular('case-study') &&
    is_post_type_archive('case-study')
) : ?>


  <?php
  get_template_part('template-parts/global/cta-purple');
    ?>

<?php endif; ?>

<?php
// Get the current page ID for ACF field
$current_id = get_queried_object_id();
$disclaimer_option = get_field('include_disclaimer', $current_id);
$footer_disclaimer = '';

if ($disclaimer_option === 'yes') {
    // Load default disclaimer from options
    $footer_disclaimer = trim((string) get_field('footer_disclaimer', 'option'));
} elseif ($disclaimer_option === 'custom') {
    // Load custom disclaimer
    $footer_disclaimer = trim((string) get_field('custom_disclaimer', $current_id));
}

// Debug: uncomment to troubleshoot
// echo '<!-- Disclaimer Debug: ID=' . $current_id . ', Option=' . $disclaimer_option . ', Content Length=' . strlen($footer_disclaimer) . ' -->';

// Display disclaimer if content exists
if ($footer_disclaimer !== '') : ?>
  <div class="section--grey section--disclaimer">
    <div class="container mx-auto">
      <div class="col-md-12 mx-auto">
        <?php echo $footer_disclaimer; ?>
      </div>
    </div>
  </div>
<?php endif; ?>


<?php if (
    ! is_front_page() &&
    ! is_page('contact') &&
    ! is_page('terms') &&
    ! is_page('your-career') &&
    ! is_singular('case-study') &&
    ! is_post_type_archive('case-study')
) : ?>

  <?php
  get_template_part('template-parts/global/contact-form');
    ?>

<?php endif; ?>

  








<?php

$container = get_theme_mod('understrap_container_type');
?>

<?php // get_template_part('sidebar-templates/sidebar', 'footerfull');?>

<div class="section--blue text-white" id="wrapper-footer">
  <div class="<?php echo esc_attr($container); ?>">

    <footer class="site-footer" id="colophon">
      <!-- ==============================
           Row 1: Logo + Navigation
      =============================== -->

      <div class="row align-items-center mb-4" data-aos="fade-up">
        <!-- Logo -->
        <div class="col-6 col-lg-3 mb-3 mb-lg-0">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="site-footer__logo-link d-inline-block">
            <img
              src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo.svg'); ?>"
              alt="<?php bloginfo('name'); ?>"
              class="site-footer__logo img-fluid" />
          </a>
        </div>

        <!-- Menu + Login Button -->
        <div class="col-6 col-lg-9">
          <div class="site-footer__nav-wrapper d-flex align-items-center justify-content-between flex-nowrap w-100">
            <!-- Menu (left-aligned) -->
            <nav class="site-footer__nav me-3 flex-grow-1 d-none d-lg-block">
              <?php
              wp_nav_menu(

                  array(
                      'menu_id'        => 'footer',
                      'container'      => false,
                      'menu_class'     => 'site-footer__nav-list list-unstyled d-flex align-items-center mb-0',
                      'fallback_cb'    => '',

                      'depth'          => 1,

                      'walker'         => new understrap_WP_Bootstrap_Navwalker(),

                  )

              );
?>
            </nav>

            <!-- Login Button (right-aligned) -->
            <a href="https://dynamo.dynamosoftware.com/tenant/dynamo3.netagesolutions.com/alceon/RE-Portal"
              target="_blank" class="btn  site-footer__login-btn ms-auto pill btn-outline-white">
              Investor Login
            </a>

          </div>
        </div>
      </div>

      <!-- ==============================
           Row 2: Disclaimer
      =============================== -->
      <div class="row" data-aos="fade-up">
        <div class="col-12 col-lg-9 offset-lg-3">
          <div class="site-footer__disclaimer mb-4">

            <?php echo  get_field('terms_paragraph', 'option'); ?>

          </div>

         

          <!-- Inner Row: Copyright + Link -->
          <div class="row align-items-center" >
            <div class="col-12 col-md-6">
              <p class="site-footer__copyright mb-0">
               <?php echo get_field('copyright_text', 'option'); ?>
              </p>
            </div>
            <div class="col-12 col-md-6 text-md-end mt-2 mt-md-0">
              <a href="<?php get_bloginfo('url'); ?>/terms/" class="site-footer__important-link text-white">Important Information</a>
            </div>
          </div>
        </div>
      </div>

    </footer><!-- #colophon -->

  </div><!-- .container -->
</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php.
?>
</div><!-- #page -->
</div><!-- .site-content-contain -->

<!-- HubSpot Forms Script - Loaded once globally -->
<script src="https://js-ap1.hsforms.net/forms/embed/developer/4264043.js" defer></script>

<?php wp_footer(); ?>

</body>

</html>