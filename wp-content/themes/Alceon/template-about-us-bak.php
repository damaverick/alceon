<?php
/**
 Template Name: About Us Bak

 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

  <?php
      // Include modular sections
      // get_template_part( 'template-parts/hero-slim', 'hero-slim' );
     
      ?>

	<div class="<?php echo esc_attr( $container ); ?> container" id="content" tabindex="-1">

		<div class="row">


	





SLIDER REPEATER
Title
Text
Image
Bio




<section class="section--white d-flex pb-5">

	
	<div class="col-md-5"><h2>{intro_text}</h2></div>
	

	<div class="col-md-7">{intro_text</p>}
</div>

</section>




		

			


		</div><!-- .row -->

	</div><!-- #content -->





<link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>


<section class="section--carousel position-relative overflow-hidden   pt-4 pb-5">
  <div class="container d-flex justify-content-between align-items-center mb-5">
    <h2 class="mb-0">Some of the faces behind Alceon</h2>
    <div class="carousel-nav d-flex gap-2">
      <button class="carousel-button-prev" aria-label="Previous slide">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
      </button>
      <button class="carousel-button-next" aria-label="Next slide">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="carousel-wrapper position-relative w-100">
    <!-- full-width viewport slider -->
   <div class="swiper mySwiper">
  <div class="swiper-wrapper">
  








  <div class="swiper-slide">
  <div class="card team-card">
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/team/3.jpg' ); ?>" class="card-img-top" alt="Jane Doe" />

    <div class="card-body">
      <h5 class="card-title mb-1">Jane Doe</h5>
      <p class="card-text mb-3">Senior Partner</p>

      <!-- Hidden expanded text -->
      <div class="card-more collapse">
        <p>
          Jane has over 20 years of experience in investment strategy and
          portfolio management, leading numerous successful projects across
          Australia and New Zealand.
        </p>
      </div>

      <!-- Read More Button -->
      <button
        class="read-more-btn d-flex justify-content-between align-items-center w-100"
        type="button"
      >
        <span>Read More</span>
        <span class="read-more-icon"></span>
      </button>
    </div>
  </div>
</div>





<div class="swiper-slide">
  <div class="card team-card">
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/team/1.jpg' ); ?>" class="card-img-top" alt="Jane Doe" />



    <div class="card-body">
      <h5 class="card-title mb-1">Jane Doe</h5>
      <p class="card-text mb-3">Senior Partner</p>

      <!-- Hidden expanded text -->
      <div class="card-more collapse">
        <p>
          Jane has over 20 years of experience in investment strategy and
          portfolio management, leading numerous successful projects across
          Australia and New Zealand.
        </p>
      </div>

      <!-- Read More Button -->
      <button
        class="read-more-btn d-flex justify-content-between align-items-center w-100"
        type="button"
      >
        <span>Read More</span>
        <span class="read-more-icon"></span>
      </button>
    </div>
  </div>
</div>



<div class="swiper-slide">
  <div class="card team-card">
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/team/2.jpg' ); ?>" class="card-img-top" alt="Jane Doe" />

    <div class="card-body">
      <h5 class="card-title mb-1">Jane Doe</h5>
      <p class="card-text mb-3">Senior Partner</p>

      <!-- Hidden expanded text -->
      <div class="card-more collapse">
        <p>
          Jane has over 20 years of experience in investment strategy and
          portfolio management, leading numerous successful projects across
          Australia and New Zealand.
        </p>
      </div>

      <!-- Read More Button -->
      <button
        class="read-more-btn d-flex justify-content-between align-items-center w-100"
        type="button"
      >
        <span>Read More</span>
        <span class="read-more-icon"></span>
      </button>
    </div>
  </div>
</div>



<div class="swiper-slide">
  <div class="card team-card">
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/team/3.jpg' ); ?>" class="card-img-top" alt="Jane Doe" />

    <div class="card-body">
      <h5 class="card-title mb-1">Jane Doe</h5>
      <p class="card-text mb-3">Senior Partner</p>

      <!-- Hidden expanded text -->
      <div class="card-more collapse">
        <p>
          Jane has over 20 years of experience in investment strategy and
          portfolio management, leading numerous successful projects across
          Australia and New Zealand.
        </p>
      </div>

      <!-- Read More Button -->
      <button
        class="read-more-btn d-flex justify-content-between align-items-center w-100"
        type="button"
      >
        <span>Read More</span>
        <span class="read-more-icon"></span>
      </button>
    </div>
  </div>
</div>


<div class="swiper-slide">
  <div class="card team-card">
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/team/1.jpg' ); ?>" class="card-img-top" alt="Jane Doe" />

    <div class="card-body">
      <h5 class="card-title mb-1">Jane Doe</h5>
      <p class="card-text mb-3">Senior Partner</p>

      <!-- Hidden expanded text -->
      <div class="card-more collapse">
        <p>
          Jane has over 20 years of experience in investment strategy and
          portfolio management, leading numerous successful projects across
          Australia and New Zealand.
        </p>
      </div>

      <!-- Read More Button -->
      <button
        class="read-more-btn d-flex justify-content-between align-items-center w-100"
        type="button"
      >
        <span>Read More</span>
        <span class="read-more-icon"></span>
      </button>
    </div>
  </div>
</div>


  </div>
</div>

    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".mySwiper", {
      slidesPerView: 3.2, // show 3 fully + peek 4th
      spaceBetween: 24,
      loop: false,
      grabCursor: true,
      centeredSlides: false,
      watchOverflow: true, // ✅ disables Swiper if too few slides
      navigation: {
        nextEl: ".carousel-button-next",
        prevEl: ".carousel-button-prev",
      },
      breakpoints: {
        320: { slidesPerView: 1.1 },
        768: { slidesPerView: 2.2 },
        1200: { slidesPerView: 3.2 },
      },
    });
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".team-card").forEach((card, i) => {
    const moreBtn = card.querySelector(".read-more-btn");
    const moreSection = card.querySelector(".card-more");

    // Assign unique IDs so Bootstrap collapse works independently
    const uniqueId = `cardMore-${i}`;
    moreSection.id = uniqueId;
    moreBtn.setAttribute("data-bs-toggle", "collapse");
    moreBtn.setAttribute("data-bs-target", `#${uniqueId}`);
    moreBtn.setAttribute("aria-controls", uniqueId);

    // Update plus/minus state manually
    moreSection.addEventListener("show.bs.collapse", () => {
      moreBtn.setAttribute("aria-expanded", "true");
    });
    moreSection.addEventListener("hide.bs.collapse", () => {
      moreBtn.setAttribute("aria-expanded", "false");
    });
  });
});
</script>


<section class="section--dark-blue text-white">
	
<div class="container">
		<div class="row d-flex justify-content-between">
		<div class="col-md-5 col-md-5 align-center flex-column d-flex justify-content-center pr-3"><h2 class="text-white">How we work</h2>
			<p>At Alceon, we co-invest in every opportunity and stay actively involved from the first conversation through to delivery. Our approach is grounded in clarity and care — shaped by deep insight, structured thinking, and a genuine commitment to long-term partnerships.</p>

<p>We draw on in-house research and decades of experience to act decisively when it counts. Complexity doesn’t deter us — it’s often where we do our best work. Every engagement is led by a thoughtful, hands-on team, backed by the belief that relationships are the most valuable asset we manage.
</p>
		</div>
		<div class="col-md-7 d-flex justify-content-end">
			
			   <img class="rounded-right w-100" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/work.png' ); ?>"  />
		</div>
	</div>
</div>
</section>
	


<section class="section--grey">
	
<div class="container">
		<div class="row d-flex justify-content-between">
		<div class="col-md-5"><h2>Partner with Us</h2>

		</div>
		<div class="col-md-7 d-flex flex-column">
			
						<p>Let’s build something that lasts. At Alceon, growth isn’t templated. It’s tailored. Built on alignment, trust and the ambition to do things better. Whether you’re raising capital, deploying it, or looking for your next challenge, we back people we believe in and stay close through every stage.
</p>


  <section class="actions mt-5 pb-5 w100">
    <!-- Row 1 -->
    <div class="action-row d-flex justify-content-between align-items-center  border-bottom">
      <h3 class="h4 mb-0">Your Capital</h3>
      <a href="#" class="btn btn-outline-dark fw-bold rounded-pill">Invest</a>
    </div>

    <!-- Row 2 -->
    <div class="action-row d-flex justify-content-between align-items-center  border-bottom">
      <h3 class="h4 mb-0">Our Capital</h3>
      <a href="#" class="btn btn-outline-dark fw-bold rounded-pill">Grow</a>
    </div>

    <!-- Row 3 -->
    <div class="action-row d-flex justify-content-between align-items-center  border-bottom">
      <h3 class="h4 mb-0">Your Career</h3>
      <a href="#" class="btn btn-outline-dark fw-bold rounded-pill">Join</a>
    </div>
  </section>



		</div>
	</div>
</div>
</section>
	



<section class="section--accordion">
  <div class="container">



    <div class="accordion accordion--custom" id="infoAccordion">
<h2>Community</h2>
<p>We believe good capital serves more than its investors. Through education, volunteering, philanthropy and long-term partnerships, we aim to support the people and communities that make our work possible.</p>
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
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logos/jca.png"
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
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logos/jca.png"
                     alt="Company Logo"
                     width="170"
                     height="auto"
                     class="img-fluid">
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
