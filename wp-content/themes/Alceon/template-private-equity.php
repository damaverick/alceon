 <?php
/**
 * 
Template Name:  Private Equity

 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>





<section class="section--white what-we-offer border-top-0">
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



     <?php
      // Include modular sections
      get_template_part( 'template-parts/icon-row', 'icon-row' );
     
      ?>


     <?php
      // Include modular sections
      get_template_part( 'template-parts/icon-row-color-bg', 'icon-row-color-bg' );
     
      ?>

      </div></section>


<section class="section--case-studies">
  <div class="container">

    <!-- Section Heading -->
    <div class="row align-items-center mb-5 pb-5">
      <div class="col-md-5">
        <h2 class="mb-2">Case Studies</h2>
        <h4 class="section-subtitle">Strategic Growth in Action</h4>
      </div>
      <div class="col-md-7">
        <p class="mb-0">
          Explore how our partnerships have driven exceptional results across industries.
        </p>
      </div>
    </div>

  <div class="row align-items-center gx-0 mb-5 pb-5">
  <!-- Left column (image) -->
  <div class="col-12 col-lg-7 position-relative">
    <div class="case-img-wrapper">
      <img
        src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/content-img.png' ); ?>"
        alt="Case Study 1"
        class="img-fluid w-100"
      >

      <div class="case-stats position-absolute">
            <div class="case-stats__inner d-flex justify-content-center align-items-center gap-5">
              <div class="case-stat text-center">
                <div class="case-stat__number">120+</div>
                <p class="case-stat__label">Advisory Projects</p>
              </div>
              <div class="case-stat text-center">
                <div class="case-stat__number">15yrs</div>
                <p class="case-stat__label">Average Client Tenure</p>
              </div>
            </div>
          </div>
    </div>
  </div>

  <!-- Right column (text) -->
  <div class="col-12 col-lg-5 mt-4 mt-lg-0 ps-lg-5">
    <h3 class="mb-1">Private Businesses</h3>
    <h4 class="case-subtitle mb-3">Transforming Operational Efficiency</h4>
    <p class="mb-4">
      We helped a mid-market manufacturer achieve 3× growth by modernising capital structure and operations.
    </p>
    <a href="#" class="btn btn-outline-primary rounded-pill">View Case Study</a>
  </div>
</div>




    <!-- === ROW 2 (Even / Alternate) === -->
    <div class="row align-items-center flex-lg-row-reverse gx-0  case-row case-row--alt mb-5 pb-5">
      <div class="col-12 col-lg-7 position-relative ps-lg-5">
        <div class="case-img-wrapper">
          <img
            src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/content-img-2.png' ); ?>"
            alt="Case Study 2"
            class="img-fluid w-100"
          >

          <div class="case-stats position-absolute">
            <div class="case-stats__inner d-flex justify-content-center align-items-center gap-5">
              <div class="case-stat text-center">
                <div class="case-stat__number">120+</div>
                <p class="case-stat__label">Advisory Projects</p>
              </div>
              <div class="case-stat text-center">
                <div class="case-stat__number">15yrs</div>
                <p class="case-stat__label">Average Client Tenure</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-5 mt-4 mt-lg-0  pe-lg-5">
        <h3 class="mb-1">Institutional Partners</h3>
        <h4 class="case-subtitle mb-3">Scaling Investments Globally</h4>
        <p class="mb-4">
          Supporting institutional investors with strategic capital deployment, governance, and operational insights.
        </p>
        <a href="#" class="btn btn-outline-primary rounded-pill">View Case Study</a>
      </div>
    </div>

  </div>
</section>






<section class="section--accordion">
  <div class="container">



    <div class="accordion accordion--custom" id="infoAccordion">
<h2>Our funds</h2>
<p>Alceon offers a range of investment opportunities through open and closed-end vehicles for high-net-worth investors, private wealth firms, family offices and institutions across multiple asset classes..</p>
      <!-- Accordion Item -->
      <div class="accordion-item">
        <h3 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseOne"
            aria-expanded="false"
            aria-controls="collapseOne">
            <span class="accordion-title h4">Black Dog Institute</span>
            <span class="accordion-icon"></span>
          </button>
        </h3>
        <div id="collapseOne" class="accordion-collapse collapse"
             aria-labelledby="headingOne"
             data-bs-parent="#infoAccordion">
          <div class="accordion-body">
            <div class="accordion-content d-flex flex-wrap align-items-start justify-content-between">
              <div class="accordion-text pe-4 flex-grow-1">
                <p>Alceon is a multi-strategy private capital investment firm providing flexible, disciplined capital across Real Estate, Private Equity, and Credit.</p>

                      <a href="#" class="btn btn-outline-primary  fw-bold rounded-pill">Join</a>

              </div>
              <div class="accordion-logo flex-shrink-0 text-end">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg"
                     alt="Company Logo"
                     width="170"
                     height="auto"
                     class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Accordion Item 2 -->
      <div class="accordion-item">
        <h3 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseTwo"
            aria-expanded="false"
            aria-controls="collapseTwo">
            <span class="accordion-title h4">JCA</span>
            <span class="accordion-icon"></span>
          </button>
        </h3>
        <div id="collapseTwo" class="accordion-collapse collapse"
             aria-labelledby="headingTwo"
             data-bs-parent="#infoAccordion">
          <div class="accordion-body">
            <div class="accordion-content d-flex flex-wrap align-items-start justify-content-between">
              <div class="accordion-text pe-4 flex-grow-1">
                <p>We combine institutional-grade execution with the agility and care of a boutique, aligning our interests with partners through co-investment.</p>
              </div>
              <div class="accordion-logo flex-shrink-0 text-end">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg"
                     alt="Company Logo"
                     width="170"
                     class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

  



<section class="section--gradient-dark-blue text-white">
  <div class="container">

    <!-- ===== Exited Investments ===== -->
    <div class="row mb-4">
      <div class="col-12">
        <h3 class="section-title mb-4">Exited Investments</h3>
      </div>
    </div>

    <div class="row g-4 justify-content-between text-white text-center text-md-start mb-5 pb-4">
      <!-- Investment 1 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Alofi" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-2">Education</h4>
          <div class="investment-stat__data d-flex flex-wrap align-items-baseline gap-2">
            <span class="investment-stat__number">114%</span>
            <span class="investment-stat__metric">IRR</span>
          </div>
        </div>
      </div>

      <!-- Investment 2 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/2.svg' ); ?>" alt="Benara" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-2">Education provider</h4>
          <div class="investment-stat__data d-flex flex-wrap align-items-baseline gap-2">
            <span class="investment-stat__number">82%</span>
            <span class="investment-stat__metric">IRR</span>
          </div>
        </div>
      </div>

      <!-- Investment 3 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/3.svg' ); ?>" alt="Maven" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-2">Financial services</h4>
          <div class="investment-stat__data d-flex flex-wrap align-items-baseline gap-2">
            <span class="investment-stat__number">95%</span>
            <span class="investment-stat__metric">IRR</span>
          </div>
        </div>
      </div>

      <!-- Investment 4 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/4.svg' ); ?>" alt="Opal" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-2">Diversified portfolio</h4>
          <div class="investment-stat__data d-flex flex-wrap align-items-baseline gap-2">
            <span class="investment-stat__number">72%</span>
            <span class="investment-stat__metric">IRR</span>
          </div>
        </div>
      </div>

      <!-- Investment 5 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Quadra" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-2">Quadra</h4>
          <div class="investment-stat__data d-flex flex-wrap align-items-baseline gap-2">
            <span class="investment-stat__number">130%</span>
            <span class="investment-stat__metric">IRR</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== Divider ===== -->
    <div class="section-divider--white my-5 pb-4"></div>

    <!-- ===== Current Investments ===== -->
    <div class="row mb-4">
      <div class="col-12">
        <h3 class="section-title mb-4">Current Investments</h3>
      </div>
    </div>

    <div class="row g-4 justify-content-between text-white text-center text-md-start">
      <!-- Current 1 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Quadra" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-0">Orion</h4>
        </div>
      </div>

      <!-- Current 2 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Quadra" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-0">Argon</h4>
        </div>
      </div>

      <!-- Current 3 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Quadra" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-0">Halcyon</h4>
        </div>
      </div>

      <!-- Current 4 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
         <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Quadra" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-0">Montara</h4>
        </div>
      </div>

      <!-- Current 5 -->
      <div class="col-6 col-md-4 col-lg-3">
        <div class="investment-stat d-flex flex-column align-items-center text-white">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logos/1.svg' ); ?>" alt="Quadra" class="investment-stat__logo mb-3">
          <h4 class="investment-stat__title mb-0">Sovereign</h4>
        </div>
      </div>
    </div>
  </div>
</section>




<section class="section--cta section--gradient-purple   text-white mb-0">
  <div class="container">
    <div class="row">
      <div class="col-md-8 align-items-start"><h2 class="text-white">Looking for the deal partner view?
</h2>
<p>See how we shape capital partnerships for real estate funding for developers and asset owners.</p></div>
    

    <div class="col-md-4 align-items-start justify-content-end d-flex"><a href="#" class="btn pill btn-outline-white">Find out more</a> </div>
    </div>
  </div>
</section>


 <?php
      // Include modular sections
      get_template_part( 'template-parts/global/contact-form', 'contact' );
     
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
get_footer();
