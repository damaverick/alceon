jQuery(document).ready(function ($) {
  
  const $carousel = $("#mediaCarousel");

  // Only run if the element exists
  if ($carousel.length > 0) {
    
    // 1. Setup Icons using localized data
    const prevIcon = '<img src="' + mediaParams.themeUrl + '/img/left-arrow.svg" alt="Left">';
    const nextIcon = '<img src="' + mediaParams.themeUrl + '/img/right-arrow.svg" alt="Right">';

    // 2. Initialize Owl Carousel
    $carousel.owlCarousel({
      items: 4,
      loop: true,
      dots: true,
      margin: 0,
      slideBy: 1,
      dotsEach: 1,
      nav: true,
      navText: [prevIcon, nextIcon],
      responsive: {
        0:    { items: 1 },
        768:  { items: 2 },
        1080: { items: 4 }
      },
      onInitialized: wrapOwlControls
    });

    // 3. Desktop Video Hover Logic
    if (window.innerWidth > 1024) {
      // Ensure all videos start paused
      $carousel.find("video").each(function () {
        this.pause();
      });

      $carousel.find(".item").hover(
        function () {
          const v = $(this).find("video")[0];
          if (v) v.play();
        },
        function () {
          const v = $(this).find("video")[0];
          if (v) v.pause();
        }
      );
    }
  }

  // 4. Helper Function: Wrap Controls
  function wrapOwlControls(event) {
    var carousel = $(event.target);
    var nav = carousel.find('.owl-nav');
    var dots = carousel.find('.owl-dots');

    var controlContainer = $(
      '<div class="container bottom_slider">' +
        '<div class="row">' +
          '<div class="col-12"></div>' +
        '</div>' +
      '</div>'
    );

    nav.add(dots).wrapAll(controlContainer);
  }

  // 5. Initialize Magnific Popup (Generic global selector)
  if ($.fn.magnificPopup) {
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false
    });
  }

  // 6. Initialize GLightbox (Generic global selector)
  if (typeof GLightbox !== 'undefined') {
    const lightbox = GLightbox({
      selector: '.glightbox',
      touchNavigation: true,
      autoplayVideos: false,
      closeButton: true,
      hideControls: false,
      prevArrow: false,
      nextArrow: false,
      preload: true
    });
  }

});