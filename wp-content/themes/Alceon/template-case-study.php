<?php
/**
 * 
Template Name: Case Study

 * @package Understrap
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
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/case-study.png' ); ?>" 
             class="img-fluid section-feature__image" 
             alt="A feature description">
      </div>

      <div class="col-lg-5">
        <div class="section-feature__content">
          <h3 class="text-white h2 mt-5">"Quote estibulum ultrices ligula vel nibh bibendum, eu biben dum tortor dictum. Mauris consec."</h3>
          <p><strong>Persons Name
Title</strong>
<br>Managing Director</p>
      
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
        <h2 class="mb-3">Asset Highlights</h2>
      </div>
      <div class="col-md-7">
     <ul>
       <li>   Vestibulum ultrices ligula vel nibh bibendum, eu biben dum tortor dictum. Mauris consectetur augue quis tempus egestas. </li>
       <li>Nam vulputate leo ut sapien feugiat dictum. Praesent dapibus digniss.
</li>
       <li>Aliquam ultricies, libero eget vestibulum malesuada, neque nulla venen atis nisi, sed tempus ligula nibh.
Nam vulputate leo ut sapien feugiat dictum. </li>
     </ul>
      </div>
    </div>



      </div>
    </section>



 <?php
      // Include modular sections
      get_template_part( 'template-parts/full-width-img', 'full-width-img' );
     
      ?>




<?php
get_footer();
