 <?php
/**
 * 
Template Name: Obseletee

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
            <span class="accordion-title h4">Alceon Australian Property Fund (AAPF)</span>
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
            <span class="accordion-title h4">Alceon Debt Income Fund (ADIF)</span>
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
            <span class="accordion-title h4">Alceon Real Estate Corporate Senior Master Fund</span>
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
              
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
</section>

  




 <?php
      // Include modular sections
      get_template_part( 'template-parts/global/contact-form', 'contact' );
     
      ?>


<?php
get_footer();
