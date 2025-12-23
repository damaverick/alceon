jQuery(function ($) {
  'use strict';

  // DOM + state
  var contentArea = $('#jobs-content-area');
  var currentLocation = 'all';
  var currentPage = 1;

  /**
   * Load jobs via AJAX
   * @param {string} location - location filter
   * @param {number} page - page number
   * @param {boolean} updateHash - whether to update the URL hash
   */
  function loadJobs(location, page, updateHash = true) {
    // Loading state
    contentArea.html(
      '<div class="row"><div class="col-12 text-center"><p>Loading jobs...</p></div></div>'
    );

    // Update state
    currentLocation = location || 'all';
    currentPage = page || 1;

    // Update URL hash (for history/back/forward)
    if (updateHash) {
      var hash = 'location=' + currentLocation + '&page=' + currentPage;
      if (window.location.hash !== '#' + hash) {
        window.location.hash = hash;
      }
    }

    // Update active filter button
    $('.filter-btn').removeClass('active');
    $('.filter-btn[data-location="' + currentLocation + '"]').addClass(
      'active'
    );

    // AJAX payload
    var data = {
      action: 'load_jobs_filter',
      nonce: jobsFilter.nonce,
      location: currentLocation,
      page: currentPage,
    };

    // AJAX call
    $.ajax({
      url: jobsFilter.ajax_url,
      type: 'POST',
      data: data,
      success: function (response) {
        if (response && response.success) {
          contentArea.html(response.data);
        } else {
          contentArea.html(
            '<div class="row"><div class="col-12"><p>No jobs found.</p></div></div>'
          );
        }
      },
      error: function () {
        contentArea.html(
          '<div class="row"><div class="col-12"><p>An error occurred. Please try again.</p></div></div>'
        );
      },
    });
  }

  // ---- EVENT HANDLERS ----

  // Filter button clicks
  $('.filter-btn').on('click', function (e) {
    e.preventDefault();
    var location = $(this).data('location') || 'all';
    // Always go to page 1 for a new filter
    if (location !== currentLocation) {
      loadJobs(location, 1, true);
    }
  });

  // Pagination clicks (delegated, because pagination is injected)
  contentArea.on('click', '.pagination a, a.page-link', function (e) {
    e.preventDefault();
    var href = $(this).attr('href') || '';

    // Try to read page from query or pretty permalink
    var match =
      href.match(/[\?&]page=(\d+)/) || href.match(/\/page\/(\d+)(?:\/|$)/);

    var page = match ? parseInt(match[1], 10) : 1;

    // Keep current location; update hash inside loadJobs
    loadJobs(currentLocation, page, true);
    return false; // Hard stop navigation
  });

  // Handle back/forward via hash
  $(window).on('hashchange', function () {
    var hash = window.location.hash.substring(1);
    if (!hash) {
      // No hash -> fallback to page 1
      loadJobs('all', 1, false);
      return;
    }

    var params = new URLSearchParams(hash);
    var location = params.get('location') || 'all';
    var page = parseInt(params.get('page'), 10) || 1;

    // Avoid redundant loads
    if (location !== currentLocation || page !== currentPage) {
      loadJobs(location, page, false);
    }
  });

  // ---- INITIAL BOOT ----
  (function init() {
    var hash = window.location.hash.substring(1);

    if (hash) {
      // Prefer hash (deep link via hash)
      var params = new URLSearchParams(hash);
      var location = params.get('location') || 'all';
      var page = parseInt(params.get('page'), 10) || 1;
      loadJobs(location, page, false);
      return;
    }

    // No hash: load default (all, page 1)
    loadJobs('all', 1, false);
  })();
});
