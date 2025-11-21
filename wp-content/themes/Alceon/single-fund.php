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

<section class="section-feature section--gradient section--stats  section-feature--overlap-bottom">
  <div class="container">

    <?php
    // Check if the 'statistics' repeater field has rows
    if (have_rows('statistics')):
    ?>
      <div class="row  g-5 justify-content-start">

        <?php
        // Loop through each statistic
        while (have_rows('statistics')) : the_row();
          $statistic = get_sub_field('statistic');
          $supporting_text = get_sub_field('supporting_text');
        ?>

          <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-item">
              <?php if ($statistic): ?>
                <div class="stat-item__number"><?php echo esc_html($statistic); ?></div>
              <?php endif; ?>
              <?php if ($supporting_text): ?>
                <p class="stat-item__text"><?php echo esc_html($supporting_text); ?></p>
              <?php endif; ?>
            </div>
          </div>

        <?php endwhile; // End statistic loop 
        ?>

      </div>
    <?php endif; // End if( have_rows('statistics') ) 
    ?>


    <div class="row position-relative align-items-center mt-5 pt-5">

      <div class="col-lg-7 section-feature--overlap-bottom__img-wrap">
        <?php
        // Use the native WordPress Featured Image
        if (has_post_thumbnail()) :
          the_post_thumbnail('full', [
            'class' => 'img-fluid section-feature__image'
          ]);
        endif;
        ?>
      </div>

      <div class="col-lg-5">
        <div class="section-feature__content">
          <?php
          // Get Testimonial fields
          $testimonial = get_field('testimonial');
          $referee_name = get_field('referee_name');
          $referee_title = get_field('referee_title');
          ?>

          <?php if ($testimonial): ?>
            <h3 class="text-white h2 mt-5"><?php echo esc_html($testimonial); ?></h3>
          <?php endif; ?>

          <?php if ($referee_name || $referee_title): // Only show <p> if at least one exists 
          ?>
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


<section class="section--white   mt-5 border-top-0 pb-5">
  <div class="container">

    <div class="row d-flex justify-content-between align-items-start mb-5">
      <div class="col-md-5">
        <h2 class="mb-3">Inside the portfolio</h2>
      </div>
      <div class="col-md-6 pe-lg-5">
        <?php
        $inside_portfolio_text = get_field('inside_portfolio_text');
        if ($inside_portfolio_text) {
          echo wp_kses_post($inside_portfolio_text); // Use wp_kses_post for WYSIWYG fields
        }
        ?>
      </div>
    </div>



  </div>
</section>


<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-icon-row');
?>




<section class="pt-5 mt-5 border-top-0 ">
  <div class="container">

    <div class="row d-flex justify-content-between align-items-start ">
      <div class="col-md-5">
        <h2 class="mb-3">How the Fund works</h2>
      </div>
      <div class="col-md-6 pe-lg-5">
        <?php
        $how_the_fund_works_text = get_field('how_the_fund_works_text');
        if ($how_the_fund_works_text) {
          echo wp_kses_post($how_the_fund_works_text); // Use wp_kses_post for WYSIWYG fields
        }
        ?>
      </div>
    </div>



  </div>
</section>



<section class="section--performance-table section--white pt-4">
  <div class="container">

    <div class="row d-flex justify-content-between align-items-start mb-1">
      <div class="col">
        <h2 class="mb-3">Investment Performance</h2>
        <p class="mt-4">As at 31 May 2025</p>
      </div>
    </div>

    <div class="table-responsive">
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
// get_template_part( 'template-parts/icon-row-color-bg', 'icon-row-color-bg' );
?>






<?php
// Include modular sections
get_template_part('template-parts/section/section-icon-row-color-bg-resources');
?>



<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-disclaimer');
?>






<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg terms-modal">
    <div class="modal-content p-4 p-md-5 text-left">
      <h2 class="mb-4">Terms of Use</h2>
      <div class="terms-content text-start mx-auto">
        <p>This website is strictly intended for use by wholesale clients and financial advisers only.</p>

        <p>By proceeding you certify that you are:</p>
        <ul>
          <li>a wholesale client within the meaning of section 716G of the Corporations Act 2001, or</li>
          <li>an AFS licensee, or an authorised representative, employee or director of an AFS licensee, that is authorised to provide personal advice to retail clients in relation to managed investment schemes.</li>
        </ul>

        <p>Melbourne Securities Corporation Limited (ACN 160 326 545, AFSL 428289) is the responsible entity and the issuer of the product disclosure statements for the Alceon Debt Income Fund ARSN 650 960 820 and Alceon Australian Property Fund ARSN 169 952 738. Offer documentation and factsheets may be accessed through this site.</p>

        <p>That information on this site has been prepared by Alceon Real Asset Management Pty Ltd (ABN 99 627 059 723) Authorised Representative No. 001274531 (ARAM), the investment manager for the Funds and an affiliate member of the Alceon Group. While it has taken all reasonable care in the compilation and updating of this site, there may be inaccuracies, errors or omissions in the information available from time to time. Neither ARAM nor any member of the Alceon Group, gives any representations or warranties, whether express or implied, or accepts responsibility for the accuracy, timeliness or completeness of the information on this site.</p>

        <p>This site is not intended for use in any jurisdiction contrary to any relevant law, regulation or directive. The content of this site does not contain any personal recommendations, offers or solicitations to invest, and all information is fully qualified by relevant disclosure documentation. As such the information on this site is not intended to form the basis of any investment decision.</p>

        <p>The content of this site is not personal or investment advice. You should seek independent professional advice as to the suitability of any product to your investment needs. It is also your responsibility to ensure that any product, service or investment specified in this site is available in your jurisdiction. You agree to inform yourself as to any legal, regulatory, financial, accounting and taxation requirements that apply to you in respect of the consent of this site and relevant investment opportunity.</p>

        <p>Past performance is not indicative of future performance. Neither ARAM, nor any member of the Alceon Group, guarantees or provides any assurance that its investment capabilities will achieve any target, objective or return on capital. The fact that a particular investment strategy or asset or shares in a particular company may have been mentioned is not a recommendation, whether expressly or by implication, to buy, sell or hold that financial product. Any prospective price-earnings ratios, distributions yields and dividend yields referred to on this site constitute estimates only. Any estimates, projections, opinions or outlook that may be stated on this site are subject to change at any time without notice. You should review the material assumptions, calculations and policies upon which any accompanying estimates or projections are based.</p>

      </div>
      <div class="mt-4 d-flex justify-content-start">
        <button id="acceptTermsBtn" class="btn btn-outline-primary pillpx-5">Accept</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalEl  = document.getElementById('termsModal');
    const acceptBtn = document.getElementById('acceptTermsBtn');

    if (!modalEl || !acceptBtn || typeof bootstrap === 'undefined') return;

    // bump this if you change the terms text
    const STORAGE_KEY = 'termsAccepted_v1';

    const hasConsent = () => {
      try { return localStorage.getItem(STORAGE_KEY) === 'true'; }
      catch (e) { return false; } // localStorage might be blocked
    };

    if (!hasConsent()) {
      const modal = new bootstrap.Modal(modalEl, {
        backdrop: 'static',
        keyboard: false
      });

      modal.show();

      acceptBtn.addEventListener('click', function () {
        try { localStorage.setItem(STORAGE_KEY, 'true'); } catch (e) {}
        modal.hide();
      }, { once: true }); // avoid multiple handlers
    }
  });
</script>


<?php
get_footer();
