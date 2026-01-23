<?php
/**
 * Employment Hero Jobs Listing Section.
 */
defined('ABSPATH') || exit;
?>

<section class="section--jobs section--white" id="jobs">
    <div class="container">
        
        <!-- Heading -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <h2>Interested in working at Alceon?</h2>
            </div>
        </div>

        <!-- Location Filter -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="jobs-filter d-flex align-items-center flex-wrap gap-3">
                    <p class="filter-label me-3 mb-0">Filter by:</p>
                    <button class="filter-btn active" data-location="all">All</button>
                    <button class="filter-btn" data-location="Sydney">Sydney</button>
                    <button class="filter-btn" data-location="Melbourne">Melbourne</button>
                    <button class="filter-btn" data-location="Brisbane">Brisbane</button>
                    <button class="filter-btn" data-location="Perth">Perth</button>
                    <button class="filter-btn" data-location="Auckland">Auckland</button>
                </div>
            </div>
        </div>

        <!-- Jobs Content Area -->
        <div id="jobs-content-area">
            <div class="row g-4">
                <div class="col-12 text-center">
                    <p>Loading jobs...</p>
                </div>
            </div>
        </div>

    </div>
</section>