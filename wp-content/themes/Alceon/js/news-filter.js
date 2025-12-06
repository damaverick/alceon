jQuery(function ($) {
  'use strict';

  // DOM + state
  var contentArea = $('#news-content-area');
  var currentFilter = 'all';
  var currentPage = 1;

  /**
   * Load posts via AJAX
   * @param {string} filter - category slug ("all" for no filter)
   * @param {number} paged  - page number
   * @param {boolean} updateHash - whether to update the URL hash
   */
  function loadNewsPosts(filter, paged, updateHash = true) {
    // loading state
    contentArea.html(
      '<div class="row"><div class="col-12 text-center"><p>Loading...</p></div></div>'
    );

    // update state
    currentFilter = filter || 'all';
    currentPage = paged || 1;

    // update URL hash (for history/back/forward)
    if (updateHash) {
      var hash = 'filter=' + currentFilter + '&paged=' + currentPage;
      if (window.location.hash !== '#' + hash) {
        window.location.hash = hash;
      }
    }

    // update active filter button
    $('.filter-btn').removeClass('active');
    $('.filter-btn[data-slug="' + currentFilter + '"]').addClass('active');

    // ajax payload
    var data = {
      action: 'load_news_filter',
      nonce: newsFilter.nonce,
      filter: currentFilter,
      paged: currentPage,
    };

    // ajax call
    $.ajax({
      url: newsFilter.ajax_url,
      type: 'POST',
      data: data,
      success: function (response) {
        if (response && response.success) {
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

  // ---- EVENT HANDLERS ----

  // Filter button clicks
  $('.filter-btn').on('click', function (e) {
    e.preventDefault();
    var filter = $(this).data('slug') || 'all';
    // always go to page 1 for a new filter
    if (filter !== currentFilter) {
      loadNewsPosts(filter, 1, true);
    }
  });

  // Pagination clicks (delegated, because pagination is injected)
  // Prevent actual navigation; extract page number from href
  contentArea.on('click', '.pagination a, a.page-link', function (e) {
    e.preventDefault();
    var href = $(this).attr('href') || '';

    // Try to read paged from query or pretty permalink
    var match =
      href.match(/[\?&]paged=(\d+)/) || href.match(/\/page\/(\d+)(?:\/|$)/);

    var paged = match ? parseInt(match[1], 10) : 1;

    // Keep current filter; update hash inside loadNewsPosts
    loadNewsPosts(currentFilter, paged, true);
    return false; // hard stop navigation
  });

  // Handle back/forward via hash
  $(window).on('hashchange', function () {
    var hash = window.location.hash.substring(1);
    if (!hash) {
      // No hash -> fallback to path page or 1
      var pathMatch = window.location.pathname.match(/\/page\/(\d+)\/?$/);
      var pageFromPath = pathMatch ? parseInt(pathMatch[1], 10) : 1;
      loadNewsPosts('all', pageFromPath, false);
      return;
    }

    var params = new URLSearchParams(hash);
    var filter = params.get('filter') || 'all';
    var paged = parseInt(params.get('paged'), 10) || 1;

    // Avoid redundant loads
    if (filter !== currentFilter || paged !== currentPage) {
      loadNewsPosts(filter, paged, false);
    }
  });

  // ---- INITIAL BOOT ----
  (function init() {
    var hash = window.location.hash.substring(1);

    if (hash) {
      // Prefer hash (deep link via hash)
      var params = new URLSearchParams(hash);
      var filter = params.get('filter') || 'all';
      var paged = parseInt(params.get('paged'), 10) || 1;
      loadNewsPosts(filter, paged, false);
      return;
    }

    // No hash: support deep links like /news-insights/page/2/
    var pathMatch = window.location.pathname.match(/\/page\/(\d+)\/?$/);
    var pageFromPath = pathMatch ? parseInt(pathMatch[1], 10) : 1;

    // Boot using page from path (if any), and set hash for future nav
    loadNewsPosts('all', pageFromPath, true);
  })();
});
