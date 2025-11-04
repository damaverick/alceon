<?php
 /* 


 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>






 




<section class="section-feature section--gradient section--stats  section-feature--overlap-bottom">
  <div class="container">


    <div class="row  g-5 justify-content-start">
      
      <!-- Stat 1 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-item__number">250+</div>
          <p class="stat-item__text">Projects Completed</p>
        </div>
      </div>

      <!-- Stat 2 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-item__number">30%</div>
          <p class="stat-item__text">Average ROI Increase</p>
        </div>
      </div>

      <!-- Stat 3 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-item__number">15yrs</div>
          <p class="stat-item__text">Average Partner Tenure</p>
        </div>
      </div>

      <!-- Stat 4 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-item__number">5B+</div>
          <p class="stat-item__text">Assets Managed</p>
        </div>
      </div>

    </div>




    <div class="row position-relative align-items-center mt-5 pt-5">

      <div class="col-lg-7 section-feature--overlap-bottom__img-wrap">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/home-feature.png' ); ?>" 
             class="img-fluid section-feature__image" 
             alt="A feature description">
      </div>

      <div class="col-lg-5">
        <div class="section-feature__content">
          <h3 class="text-white h2 mt-5">/  Invested in people, grounded in experience, focused on shared outcomes.</h3>
      
        </div>
      </div>

    </div>
  </div>
</section>


    <section class="section--white   mt-5 border-top-0 pb-5">
  <div class="container">

    <!-- Section Heading -->
    <div class="row d-flex justify-content-between align-items-start mb-5">
      <div class="col-md-5">
        <h2 class="mb-3">Invest in opportunity – built on structure, backed by experience</h2>
      </div>
      <div class="col-md-7">
        <p>
At Alceon, real estate is more than a portfolio position — it’s a space we know deeply and invest in personally. With decades of experience across equity, debt and hybrid structures, our real estate platform offers investors disciplined access to a sector that demands both agility and rigour.</p>
     <p>We seek out compelling, risk-adjusted real estate opportunities — delivering income and growth through active structuring and deep due diligence. Our real estate investment strategies are designed for investors who value access, alignment and clarity.        </p>
      </div>
    </div>


    <!-- ===== Divider ===== -->
    <div class="section-divider my-5 pb-4"></div>

      </div>
    </section>


 <?php
      // Include modular sections
      get_template_part( 'template-parts/icon-row', 'icon-row' );
     
      ?>


    <!-- ===== Divider ===== -->
    <div class="section-divider container my-5 pb-4"></div>




    <section class="pt-5 mt-5 border-top-0 ">
  <div class="container">

    <!-- Section Heading -->
    <div class="row d-flex justify-content-between align-items-start ">
      <div class="col-md-5">
        <h2 class="mb-3">How the Fund works</h2>
      </div>
      <div class="col-md-7">
        <p>
At Alceon, real estate is more than a portfolio position — it’s a space we know deeply and invest in personally. With decades of experience across equity, debt and hybrid structures, our real estate platform offers investors disciplined access to a sector that demands both agility and rigour.</p>
     <p>We seek out compelling, risk-adjusted real estate opportunities — delivering income and growth through active structuring and deep due diligence. Our real estate investment strategies are designed for investors who value access, alignment and clarity.        </p>
      </div>
    </div>


    <!-- ===== Divider ===== -->
    <div class="section-divider my-5 pb-4"></div>

      </div>
    </section>



<section class="section--performance-table pt-4 pb-0">
  <div class="container">

        <!-- Section Heading -->
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
            <th scope="col">3 Year (annualised)</th>
            <th scope="col">5 Year (annualised)</th>
            <th scope="col">Since Inception</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th scope="row">Total Net Return</th>
            <td>1.4%</td>
            <td>2.8%</td>
            <td>4.2%</td>
            <td>7.9%</td>
            <td>8.4%</td>
            <td>9.2%</td>
            <td>10.5%</td>
          </tr>

          <tr>
            <th scope="row">Distribution Return</th>
            <td>0.9%</td>
            <td>1.6%</td>
            <td>2.1%</td>
            <td>4.8%</td>
            <td>5.1%</td>
            <td>5.9%</td>
            <td>6.2%</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</section>




     <?php
      // Include modular sections
      get_template_part( 'template-parts/icon-row-color-bg', 'icon-row-color-bg' );
     
      ?>








      <div class="section--grey">
        <div class="container mx-auto">
          <div class="col-md-8 mx-auto">
            <p>The information on this site is of a general nature. It does not take your specific needs or circumstances into consideration, so you should look at your own financial position, objectives and requirements and seek financial advice before making any financial decisions. You should obtain a copy of the product disclosure statement (PDS) relating to the offer of units in the Alceon Australian Property Fund ARSN 169 952 738 (AAPF) or the Alceon Debt Income Fund ARSN 650 960 820 (ADIF) and consider the relevant PDS before making any decision about whether to acquire, dispose of, or to continue to hold, units in AAPF or ADIF. The PDS can be obtained from AAPF or ADIF’s fund page on this website. The issuer of units in AAPF and ADIF is Melbourne Securities Corporation Limited ACN 160 326 545 AFSL 428289.</p>
          <p>
Any investment is subject to risk, including possible loss of income or capital invested. None of Alceon, the Trustee, or any of their officers, advisers, agents, or associates guarantees in any way the performance of the Fund. Past performance is not an indicator of future returns. The content of this website is current at the time of publication and may be amended or revoked by Alceon at any time.</p>
          </div>
        </div>
      </div>


 <?php
      // Include modular sections
      get_template_part( 'template-parts/global/contact-form', 'contact' );
     
      ?>


<!-- Terms of Use Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg terms-modal">
    <div class="modal-content p-4 p-md-5 text-left">
      <h2 class="mb-4">Terms of Use</h2>
      <div class="terms-content text-start mx-auto">
        <p>This website is strictly intended for use by wholesale clients and financial advisers only.  By proceeding you certify that you are:</p>


<ul>

<li>a wholesale client within the meaning of section 716G of the Corporations Act 2001, or</li>
<li>an AFS licensee, or an authorised representative, employee or director of an AFS licensee, that is authorised to provide personal advice to retail clients in relation to managed investment schemes.</li>

</ul>

<p>
Melbourne Securities Corporation Limited (ACN 160 326 545, AFSL 428289) is the responsible entity and the issuer of the product disclosure statements for the Alceon Debt Income Fund ARSN 650 960 820 and Alceon Australian Property Fund ARSN 169 952 738. Offer documentation and factsheets may be accessed through this site.</p>

<p>
That information on this site has been prepared by Alceon Real Asset Management Pty Ltd (ABN 99 627 059 723) Authorised Representative No. 001274531 (ARAM), the investment manager for the Funds and an affiliate member of the Alceon Group. While it has taken all reasonable care in the compilation and updating of this site, there may be  inaccuracies, errors or omissions in the information available from time to time. Neither ARAM nor any member of the Alceon Group, gives any representations or warranties, whether express or implied, or accepts responsibility for the accuracy, timeliness or completeness of the information on this site.
This site is not intended for use in any jurisdiction contrary to any relevant law, regulation or directive. The content of this site does not contain any personal recommendations, offers or solicitations to invest, and all information is fully qualified by relevant disclosure documentation. As such the information on this site is not intended to  form the basis of any investment decision.</p>

<p>
The content of this site is not personal or investment advice. You should seek independent professional advice as to the suitability of any product to your investment needs. It is also your responsibility to ensure that any product, service or investment specified in this site is available in your jurisdiction. You agree to inform yourself as to any legal, regulatory, financial, accounting and taxation requirements that apply to you in respect of the consent of this site and relevant investment opportunity.
Past performance is not indicative of future performance. Neither ARAM, nor any member of the Alceon Group, guarantees or provides any assurance that its investment capabilities will achieve any target, objective or return on capital. The fact that a particular investment strategy or asset or shares in a particular company may have been mentioned is not a recommendation, whether expressly or by implication, to buy, sell or  hold that financial product. Any prospective price-earnings ratios, distributions yields and dividend yields referred to on this site constitute estimates only. Any estimates, projections, opinions or outlook that may be stated on this site are subject to change at any time without notice. You should review the material assumptions, calculations and policies upon which any accompanying estimates or projections are based.</p>
      </div>
  

    <div class="mt-4 d-flex justify-content-start">
    <button id="acceptTermsBtn" class="btn btn-outline-primary pillpx-5">Accept</button>
  </div>




    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalEl = document.getElementById('termsModal');
  const acceptBtn = document.getElementById('acceptTermsBtn');

  // Check localStorage for persistent consent
  const termsAccepted = localStorage.getItem('termsAccepted');

  if (!termsAccepted) {
    const modal = new bootstrap.Modal(modalEl, {
      backdrop: 'static', // prevents closing by clicking outside
      keyboard: false
    });

    modal.show();

    acceptBtn.addEventListener('click', function() {
      localStorage.setItem('termsAccepted', 'true');
      modal.hide();
    });
  }
});
</script>


<?php
get_footer();
