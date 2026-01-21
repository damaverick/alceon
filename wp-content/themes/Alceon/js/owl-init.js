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

    // 4. Determine max items to show based on total items available
    const maxItems1080 = Math.min(5, totalItems);
    const maxItems1435 = Math.min(6, totalItems);

    $carousel.owlCarousel({
      items: maxItems1435,
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
          items: maxItems1080,
          nav: totalItems > maxItems1080,
          dots: totalItems > maxItems1080,
          //   mouseDrag: false,
          //   touchDrag: false,
          //   pullDrag: false,
          //   freeDrag: false,
        },

        1435: {
          items: maxItems1435,
          nav: totalItems > maxItems1435,
          dots: totalItems > maxItems1435,
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

    // Check if nav/dots are disabled (not needed)
    var navDisabled = nav.hasClass('disabled');
    var dotsDisabled = dots.hasClass('disabled');
    var bothDisabled = navDisabled && dotsDisabled;

    // Find the parent section
    var section = carousel.closest('.growth_testimonials');

    if (nav.length === 0 && dots.length === 0) {
      // No controls at all - remove padding
      if (section.length) {
        section.addClass('no-controls');
      }
      return;
    }

    // Only wrap if not already wrapped
    if (carousel.parent().find('.bottom_slider').length === 0) {
      var controlContainer = $(
        '<div class="container bottom_slider"><div class="row"><div class="col-12"></div></div></div>',
      );
      nav.add(dots).wrapAll(controlContainer);
    }

    var bottomSlider = carousel.parent().find('.bottom_slider');

    // Toggle visibility and padding based on control state
    if (bothDisabled) {
      bottomSlider.hide();
      if (section.length) {
        section.addClass('no-controls');
      }
    } else {
      bottomSlider.show();
      if (section.length) {
        section.removeClass('no-controls');
      }
    }
  }
});
