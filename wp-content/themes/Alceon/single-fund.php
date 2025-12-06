<?php
/**
 * The template for displaying a single Fund CPT
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
?>

<section class="section-feature section--gradient section--stats section-feature--overlap-bottom">
  <div class="container">

    <?php if (have_rows('statistics')): ?>
      <div class="row g-lg-5 justify-content-start">

        <?php
        $stat_idx = 0; // Initialize counter for stagger

        while (have_rows('statistics')) : the_row();
            $statistic = get_sub_field('statistic');
            $supporting_text = get_sub_field('supporting_text');
            $aos_delay = $stat_idx * 100;

            // --- 1. PARSING LOGIC (Copied & Improved) ---
            // Regex to split: Prefix | Number | Suffix
            preg_match('/^([^\d]*)([\d\.]+)([^\d]*)$/', $statistic, $matches);

            $prefix = isset($matches[1]) ? $matches[1] : '';
            $number = isset($matches[2]) ? $matches[2] : 0;
            $suffix = isset($matches[3]) ? $matches[3] : '';

            // Calculate decimals based on the actual length of the string after the dot
            // This ensures "10.30" gets 2 decimals, while "5" gets 0.
            $decimals = 0;
            if (strpos($number, '.') !== false) {
                $decimals = strlen(substr(strrchr($number, "."), 1));
            }
            ?>

          <div class="col-12 col-md-6 col-lg-3" 
               data-aos="fade-up" 
               data-aos-delay="<?php echo intval($aos_delay); ?>">
               
            <div class="stat-item">
              <?php if ($statistic): ?>
                
                <div class="stat-item__number js-counter"
                     data-target="<?php echo esc_attr($number); ?>" 
                     data-decimals="<?php echo esc_attr($decimals); ?>"
                     data-prefix="<?php echo esc_attr($prefix); ?>"
                     data-suffix="<?php echo esc_attr($suffix); ?>">
                     
                     <?php echo esc_html($statistic); ?>
                </div>

              <?php endif; ?>
              
              <?php if ($supporting_text): ?>
                <p class="stat-item__text"><?php echo wp_kses_post($supporting_text); ?></p>
              <?php endif; ?>
            </div>
          </div>

        <?php
            $stat_idx++;
        endwhile;
        ?>

      </div>
    <?php endif; ?>


    <div class="row position-relative align-items-center mt-1 mt-lg-5 pt-5">

      <div class="col-lg-7 section-feature--overlap-bottom__img-wrap pb-4 pb-lg-0" >
        <?php
        if (has_post_thumbnail()) :
            the_post_thumbnail('full', [
              'class' => 'img-fluid section-feature__image', 'data-aos' => 'fade-right'
            ]);
        endif;
?>
      </div>

      <div class="col-lg-5" data-aos="fade-left">
        <div class="section-feature__content">
          <?php
  $testimonial = get_field('testimonial');
$referee_name = get_field('referee_name');
$referee_title = get_field('referee_title');
?>

          <?php if ($testimonial): ?>
            <h3 class="text-white h2 mt-1 mt-lg-5"><?php echo esc_html($testimonial); ?></h3>
          <?php endif; ?>

          <?php if ($referee_name || $referee_title): ?>
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


<section class="section--white">
  <div class="container">

    <div class="row d-flex justify-content-between align-items-start mb-5">
      <div class="col-md-5" data-aos="fade-right">
        <h2>Inside the portfolio</h2>
      </div>
      <div class="col-md-6 pe-lg-5" data-aos="fade-left">
        <?php
        $inside_portfolio_text = get_field('inside_portfolio_text');
if ($inside_portfolio_text) {
    echo wp_kses_post($inside_portfolio_text);
}
?>
      </div>
    </div>


    <div class="hr-divider row pt-0 pt-md-2" data-aos="fade-in">
      <div class="col"><div style="border-bottom:2px solid var(--lightGrey, #e6e6e6);"></div></div>
    </div>

  </div>
</section>


<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/icon-row');
?>

<div class="container">
  <div class="hr-divider row pt-0 pt-md-2" data-aos="fade-in">
      <div class="col"><div style="border-bottom:2px solid var(--lightGrey, #e6e6e6);"></div></div>
    </div>
</div>


<section class="section--white border-top-0">
  <div class="container"> 

    <div class="row d-flex justify-content-between align-items-start">
      <div class="col-md-5" data-aos="fade-right">
        <h2 class="mb-3">How the Fund works</h2>
      </div>
      <div class="col-md-6 pe-lg-5" data-aos="fade-left">
        <?php
        $how_the_fund_works_text = get_field('how_the_fund_works_text');
if ($how_the_fund_works_text) {
    echo wp_kses_post($how_the_fund_works_text);
}
?>
      </div>
    </div>

  </div>
</section>


<section class="section--performance-table section--white pt-4">
  <div class="container">

    <div class="row d-flex justify-content-between align-items-start mb-1">
      <div class="col" data-aos="fade-up">
        <h2>Investment Performance</h2>
        <p class="mt-4">As at 31 May 2025</p>
      </div>
    </div>

    <div class="table-responsive" data-aos="fade-up" data-aos-delay="100">
      <table class="table performance-table mb-0">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">1 Month</th>
            <th scope="col">3 Month</th>
            <th scope="col">6 Month</th>
            <th scope="col">1 Year</th>
            <th scope="col">3 Year <br>(annualised)</th>
            <th scope="col">5 Year <br>(annualised)</th>
            <th scope="col">Since Inception</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row "><span class="text-blue">Total Net Return</span></th>
            <td>1.4%</td>
            <td>2.8%</td>
            <td>5.1%</td>
            <td>9.2%</td>
            <td>8.5%</td>
            <td>7.9%</td>
            <td>10.5%</td>
          </tr>
          <tr>
            <th scope="row"><span class="text-blue">Distribution Return</span></th>
            <td>0.9%</td>
            <td>1.6%</td>
            <td>3.0%</td>
            <td>5.8%</td>
            <td>5.5%</td>
            <td>5.2%</td>
            <td>6.2%</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</section>

<?php
// Include modular sections
get_template_part('template-parts/section/icon-row-color-bg-resources');
?>

<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/disclaimer');
?>

<?php $terms_modal = get_field('terms_modal', 'option'); ?>
<?php if ($terms_modal) : ?>

<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="false">
  <div class="modal-dialog modal-dialog-centered modal-lg terms-modal">
    <div class="modal-content p-4 p-md-5 text-left">
      <h2>Terms of Use</h2>
      <div class="terms-content text-start mx-auto">
      <?php echo wp_kses_post($terms_modal); ?>
      </div>
      <div class="mt-4 d-flex justify-content-start">
        <button id="acceptTermsBtn" class="btn btn-outline-primary pillpx-5">Accept</button>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('termsModal');
    const acceptBtn = document.getElementById('acceptTermsBtn');
    if (!modalEl || !acceptBtn) return;

    // bump this if you change the terms text
    const STORAGE_KEY = 'termsAccepted_v1';

    // Always show the modal (no consent check)
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
      const modal = new bootstrap.Modal(modalEl, {
        backdrop: 'static',
        keyboard: false
      });

      modal.show();

      acceptBtn.addEventListener('click', function () {
        try { localStorage.setItem(STORAGE_KEY, 'true'); } catch (e) {}
        modal.hide();
      }, { once: true });
    } else {
      // Fallback if bootstrap JS isn't loaded: force visible modal + backdrop
      modalEl.classList.add('show');
      modalEl.style.display = 'block';
      modalEl.setAttribute('aria-modal', 'true');
      modalEl.removeAttribute('aria-hidden');

      const backdrop = document.createElement('div');
      backdrop.className = 'modal-backdrop fade show';
      document.body.appendChild(backdrop);

      acceptBtn.addEventListener('click', function () {
        try { localStorage.setItem(STORAGE_KEY, 'true'); } catch (e) {}
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
        if (backdrop.parentNode) backdrop.parentNode.removeChild(backdrop);
      }, { once: true });
    }
  });
</script>
<?php endif; ?>

<?php
get_footer();
?>