<?php

/**
 * Template Name: News Ajax
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

// $container = get_theme_mod('understrap_container_type'); // You weren't using this
?>

<section class="section--news section--white">
  <div class="container">

  

    <!-- <div class="row mb-5">
      <div class="col-12">
        <div class="news-filter d-flex align-items-center flex-wrap gap-3">
          <span class="filter-label me-3 ">Filter by:</span>
          <button class="filter-btn active" data-slug="all">All</button>
          <button class="filter-btn" data-slug="news">News</button>
          <button class="filter-btn" data-slug="insights">Insights</button>
          <button class="filter-btn" data-slug="podcasts">Podcasts</button>
          <button class="filter-btn" data-slug="other-media">Other Media</button>
          <button class="filter-btn" data-slug="video">Video</button>
        </div>
      </div>
    </div> -->

    <div id="news-content-area">
      <div class="row g-5">
        <div class="col-12 text-center">
          <p>Loading posts...</p>
        </div>
      </div>
    </div>

  </div>
</section>



<?php
get_footer();
?>