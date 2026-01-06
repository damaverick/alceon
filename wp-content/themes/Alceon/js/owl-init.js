jQuery(document).ready(function ($) {
  // Check if the element exists before running logic
  var $carousel = $('#talentCommunity');

  if ($carousel.length > 0) {
    // 1. Reconstruct image paths using the localized theme URL
    const prevIcon =
      '<img src="' + owlParams.themeUrl + '/img/left-arrow.svg" alt="Left">';
    const nextIcon =
      '<img src="' + owlParams.themeUrl + '/img/right-arrow.svg" alt="Right">';

    // 2. Calculate items via JS (Better than passing PHP int)
    const totalItems = $carousel.children().length;

    // 3. Logic to toggle controls
    const controlsEnabled = () => window.innerWidth < 1080 || totalItems > 4;

    $carousel.owlCarousel({
      items: 5,
      loop: false,
      dots: true,
      margin: 0,
      slideBy: 2,
      dotsEach: 2,
      nav: true,
      navText: [prevIcon, nextIcon],
      responsive: {
        0: {
          items: 1,
          nav: true,
          dots: false,
          slideBy: 1,
        },
        768: {
          items: 2,
          nav: true,
          dots: true,
        },
        1080: {
          items: 5,
          nav: true,
          dots: true,
          //   mouseDrag: false,
          //   touchDrag: false,
          //   pullDrag: false,
          //   freeDrag: false,
        },
      },
      onInitialized: wrapOwlControls,
      onResized: wrapOwlControls,
    });
  }

  function wrapOwlControls(event) {
    var carousel = $(event.target);
    var nav = carousel.find('.owl-nav');
    var dots = carousel.find('.owl-dots');

    if (nav.length === 0 && dots.length === 0) return;

    // Only wrap if not already wrapped
    if (carousel.parent().find('.bottom_slider').length === 0) {
      var controlContainer = $(
        '<div class="container bottom_slider"><div class="row"><div class="col-12"></div></div></div>'
      );
      nav.add(dots).wrapAll(controlContainer);
    }

    // Always ensure controls are visible
    carousel.parent().find('.bottom_slider').css('display', 'block');
  }
});
