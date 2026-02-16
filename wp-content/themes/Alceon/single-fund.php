<?php

/**
 * The template for displaying a single Fund CPT.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
?>

<!-- START NEW MODULE-->
<section class="section-feature section--gradient section--stats section-feature--overlap-bottom">
  <div class="container">

    <?php if (have_rows('statistics')) : ?>
      <?php
        // --- Count the actual number of statistics items ---
        $column_count = count(get_field('statistics'));

        // --- Set the Bootstrap class based on the count ---
        $md_class = '';
        $lg_class = '';
        if ($column_count == 2) {
            $md_class = 'col-md-6';
            $lg_class = 'col-lg-6';
        } elseif ($column_count == 3) {
            $md_class = 'col-md-4';
            $lg_class = 'col-lg-4';
        } elseif ($column_count == 5) {
            $md_class = 'col-md-6';
            $lg_class = 'col-lg-5th';
        } else {
            // Default for 4 or any other count
            $md_class = 'col-md-3';
            $lg_class = 'col-lg-3';
        }

$column_class = 'col-12 ' . $md_class . ' ' . $lg_class;
?>
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
        $decimals = strlen(substr(strrchr($number, '.'), 1));
    }
    ?>

          <div class="<?php echo esc_attr($column_class); ?>" data-aos="fade-up" data-aos-delay="<?php echo intval($aos_delay); ?>">

            <div class="stat-item">
              <?php if ($statistic) : ?>

                <div class="stat-item__number js-counter" data-target="<?php echo esc_attr($number); ?>" data-decimals="<?php echo esc_attr($decimals); ?>" data-prefix="<?php echo esc_attr($prefix); ?>" data-suffix="<?php echo esc_attr($suffix); ?>">

                  <?php echo esc_html($statistic); ?>
                </div>

              <?php endif; ?>

              <?php if ($supporting_text) : ?>
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

      <div class="col-lg-7 section-feature--overlap-bottom__img-wrap pb-4 pb-lg-0">
        <?php
if (has_post_thumbnail()) :
    the_post_thumbnail('full', [
        'class' => 'img-fluid section-feature__image', 'data-aos' => 'fade-right',
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

          <?php if ($testimonial) : ?>
            <h3 class="text-white h2 mt-1 mt-lg-5"><?php echo esc_html($testimonial); ?></h3>
          <?php endif; ?>

          <?php if ($referee_name || $referee_title) : ?>
            <p>
              <?php if ($referee_name) : ?>
                <strong><?php echo esc_html($referee_name); ?></strong>
              <?php endif; ?>

              <?php if ($referee_title) : ?>
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
      <div class="col">
        <div style="border-bottom:2px solid var(--lightGrey, #e6e6e6);"></div>
      </div>
    </div>

  </div>
</section>

<!-- END NEW MODULE-->


<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/icon-row');
?>

<div class="container">
  <div class="hr-divider row pt-0 pt-md-2" data-aos="fade-in">
    <div class="col">
      <div style="border-bottom:2px solid var(--lightGrey, #e6e6e6);"></div>
    </div>
  </div>
</div>

<!-- START MODULE -->
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

<!-- END MODULE -->


<?php $type = get_field('type'); ?>
<?php if ($type !== 'no_data') : ?>

  <!-- START NEW MODULE -->
  <section class="section--performance-table section--white pt-4">
    <div class="container">
      <div class="row d-flex justify-content-between align-items-start mb-1">
        <div class="col" data-aos="fade-up">
          <h2>Investment Performance</h2>
          <?php
  $getData = getData();
    $data_date = '';
    if ($type == 'ADIF') {
        $data_date = date('d F Y', $getData['date_debt']->value);
    } elseif ($type == 'AAPF') {
        $data_date = date('d F Y', $getData['date_property']->value);
    }
?>
          <?php if ($data_date) : ?>
            <p class="mt-4">As at <?php echo $data_date; ?></p>
          <?php endif; ?>
        </div>
      </div>

      <div class="table-responsive" data-aos="fade-up" data-aos-delay="100">
        <?php
        switch ($type) {
            case 'ADIF':
                ?>
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
                  <td><?= $getData['total_net_return_1_month']->value ?></td>
                  <td><?= $getData['total_net_return_3_month']->value ?></td>
                  <td><?= $getData['total_net_return_6_month']->value ?></td>
                  <td><?= $getData['total_net_return_1_year']->value ?></td>
                  <td><?= $getData['total_net_return_2_year']->value ?></td>
                  <td><?= $getData['total_net_return_3_year']->value ?></td>
                  <td><?= $getData['total_net_return_since_incpetion']->value ?></td>
                </tr>
                <tr>
                  <th scope="row"><span class="text-blue">Distribution Return</span></th>
                  <td><?= $getData['distribution_return_1_month']->value ?></td>
                  <td><?= $getData['distribution_return_3_month']->value ?></td>
                  <td><?= $getData['distribution_return_6_month']->value ?></td>
                  <td><?= $getData['distribution_return_1_year']->value ?></td>
                  <td><?= $getData['distribution_return_2_year']->value ?></td>
                  <td><?= $getData['distribution_return_3_year']->value ?></td>
                  <td><?= $getData['distribution_return_since_incpetion']->value ?></td>
                </tr>
              </tbody>
            </table>
          <?php
                    # code...
                    break;

            case 'AAPF':
                ?>
            <table class="table performance-table mb-0">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Month</th>
                  <th scope="col">Quarter</th>
                  <th scope="col">1 Year</th>
                  <th scope="col">3 Year</th>
                  <th scope="col">5 Year</th>
                  <th scope="col">Since Inception</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row "><span class="text-blue">Alceon Australian Property Fund (net of fees)</span></th>
                  <td><?= $getData['freehold_australian_property_fund_month']->value ?></td>
                  <td><?= $getData['freehold_australian_property_fund_quarter']->value ?></td>
                  <td><?= $getData['freehold_australian_property_fund_1_year']->value ?></td>
                  <td><?= $getData['freehold_australian_property_fund_3_years']->value ?></td>
                  <td><?= $getData['freehold_australian_property_fund_5_years']->value ?></td>
                  <td><?= $getData['freehold_australian_property_fund_since_inception']->value ?></td>
                </tr>
                <tr>
                  <th scope="row"><span class="text-blue">Fund Benchmark*</span></th>
                  <td><?= $getData['fund_benchmark_month']->value ?></td>
                  <td><?= $getData['fund_benchmark_quarter']->value ?></td>
                  <td><?= $getData['fund_benchmark_1_year']->value ?></td>
                  <td><?= $getData['fund_benchmark_3_years']->value ?></td>
                  <td><?= $getData['fund_benchmark_5_years']->value ?></td>
                  <td><?= $getData['fund_benchmark_since_inception']->value ?></td>
                </tr>
                <tr>
                  <th scope="row"><span class="text-blue">Value Add* </span></th>
                  <td><?= $getData['value_add_month']->value ?></td>
                  <td><?= $getData['value_add_quarter']->value ?></td>
                  <td><?= $getData['value_add_1_year']->value ?></td>
                  <td><?= $getData['value_add_3_years']->value ?></td>
                  <td><?= $getData['value_add_5_years']->value ?></td>
                  <td><?= $getData['value_add_since_inception']->value ?></td>
                </tr>
              </tbody>
            </table>
        <?php
                  break;

            default:
                # code...
                break;
        }
?>
      </div>

    </div>
  </section>
  <!-- END NEW MODULE -->
<?php endif; ?>

<?php
// Include modular sections
get_template_part('template-parts/section/icon-row-color-bg-resources');
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
    document.addEventListener('DOMContentLoaded', function() {
      const modalEl = document.getElementById('termsModal');
      const acceptBtn = document.getElementById('acceptTermsBtn');
      if (!modalEl || !acceptBtn) return;

      // bump this if you change the terms text
      const SESSION_KEY = 'termsShown_v1';

      // Check if modal was already shown in this session
      let alreadyShown = false;
      try {
        alreadyShown = sessionStorage.getItem(SESSION_KEY) === 'true';
      } catch (e) {}

      // Only show if not already shown in this session
      if (!alreadyShown) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
          const modal = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
          });

          modal.show();

          acceptBtn.addEventListener('click', function() {
            try {
              sessionStorage.setItem(SESSION_KEY, 'true');
            } catch (e) {}
            modal.hide();
          }, {
            once: true
          });
        } else {
          // Fallback if bootstrap JS isn't loaded: force visible modal + backdrop
          modalEl.classList.add('show');
          modalEl.style.display = 'block';
          modalEl.setAttribute('aria-modal', 'true');
          modalEl.removeAttribute('aria-hidden');

          const backdrop = document.createElement('div');
          backdrop.className = 'modal-backdrop fade show';
          document.body.appendChild(backdrop);

          acceptBtn.addEventListener('click', function() {
            try {
              sessionStorage.setItem(SESSION_KEY, 'true');
            } catch (e) {}
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
            if (backdrop.parentNode) backdrop.parentNode.removeChild(backdrop);
          }, {
            once: true
          });
        }
      }
    });
  </script>
<?php endif; ?>

<?php
get_footer();
?>
