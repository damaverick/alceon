jQuery(function ($) {
  'use strict';

  // Get the main content area
  var contentArea = $('#news-content-area');
  var currentFilter = 'all'; // Store current filter
  var currentPage = 1; // Store current page

  /**
   * Main function to load posts via AJAX
   * @param {string} filter - The category slug
   * @param {number} paged - The page number
   * @param {boolean} updateHash - Whether to update the URL hash
   */
  function loadNewsPosts(filter, paged, updateHash = true) {
    // Set a loading state
    contentArea.html(
      '<div class="row"><div class="col-12 text-center"><p>Loading...</p></div></div>'
    );

    // Update global state
    currentFilter = filter;
    currentPage = paged;

    // Update URL hash for bookmarking
    if (updateHash) {
      window.location.hash = 'filter=' + filter + '&paged=' + paged;
    }

    // Update active button state
    $('.filter-btn').removeClass('active');
    $('.filter-btn[data-slug="' + filter + '"]').addClass('active');

    // Prepare AJAX data
    var data = {
      action: 'load_news_filter',
      nonce: newsFilter.nonce, // This will now work!
      filter: filter,
      paged: paged,
    };

    // Run the AJAX call
    $.ajax({
      url: newsFilter.ajax_url, // This will also work!
      type: 'POST',
      data: data,
      success: function (response) {
        if (response.success) {
          // Replace content and remove loading state
          contentArea.html(response.data);
        } else {
          contentArea.html(
            '<div class="row"><div class="col-12"><p>No posts found.</p></div></div>'
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

  // --- EVENT HANDLERS ---

  // 1. Filter button clicks
  $('.filter-btn').on('click', function (e) {
    e.preventDefault();
    var filter = $(this).data('slug');

    // Only run if the filter is different
    if (filter !== currentFilter) {
      loadNewsPosts(filter, 1); // Always reset to page 1 on new filter
    }
  });

  // 2. Pagination clicks (using event delegation)
  // We must listen on 'contentArea' because the pagination is loaded via AJAX.
  // OLD
  // Pagination clicks (supports both WP default & Bootstrap)
  // Pagination clicks (supports WP default & Bootstrap)
  contentArea.on('click', 'a.page-numbers, a.page-link', function (e) {
    e.preventDefault();

    let href = $(this).attr('href');
    if (!href) return;

    let match = href.match(/paged=(\d+)/) || href.match(/\/page\/(\d+)/);
    let paged = match ? parseInt(match[1], 10) : 1;

    loadNewsPosts(currentFilter, paged);
  });

  // 3. Handle browser back/forward buttons (hash change)
  $(window).on('hashchange', function () {
    var hash = window.location.hash.substring(1);
    if (hash) {
      // Parse the hash string
      var params = new URLSearchParams(hash);
      var filter = params.get('filter') || 'all';
      var paged = parseInt(params.get('paged')) || 1;

      // Load content without updating hash again
      loadNewsPosts(filter, paged, false);
    }
  });

  // 4. Initial page load
  // Check if a hash exists and load that, otherwise load default
  var initialHash = window.location.hash.substring(1);
  if (initialHash) {
    var params = new URLSearchParams(initialHash);
    var filter = params.get('filter') || 'all';
    var paged = parseInt(params.get('paged')) || 1;
    loadNewsPosts(filter, paged, false); // Load from hash
  } else {
    loadNewsPosts('all', 1, false); // Load default (all, page 1)
  }
});
