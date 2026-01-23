document.addEventListener('DOMContentLoaded', function () {
  // --- 1. Define the Counter Logic as a reusable function ---
  const runCounterAnimation = () => {
    // Safety check: Prevent running twice if called multiple times
    if (window.hasRunCounters) return;
    window.hasRunCounters = true;

    // Check if counters exist
    const counters = document.querySelectorAll('.js-counter');
    if (counters.length === 0) return;

    // Setup the Observer
    let observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            let el = entry.target;
            let $el = jQuery(el);

            if ($el.hasClass('counted')) return;
            $el.addClass('counted');

            // Get data
            let targetVal = parseFloat($el.attr('data-target'));
            let decimals = parseInt($el.attr('data-decimals'));
            let prefix = $el.attr('data-prefix') || '';
            let suffix = $el.attr('data-suffix') || '';

            // Run jQuery Animation
            jQuery({ countNum: 0 }).animate(
              {
                countNum: targetVal,
              },
              {
                duration: 2000,
                easing: 'swing',
                step: function () {
                  $el.text(prefix + this.countNum.toFixed(decimals) + suffix);
                },
                complete: function () {
                  $el.text(prefix + this.countNum.toFixed(decimals) + suffix);
                },
              },
            );

            observer.unobserve(el);
          }
        });
      },
      { threshold: 0.5 },
    );

    // Attach Observer
    counters.forEach((counter) => {
      observer.observe(counter);
    });
  };

  // --- 2. Check for the Terms Modal ---
  const $modal = jQuery('#termsModal');
  const $acceptBtn = jQuery('#acceptTermsBtn');

  // Check if modal exists AND is currently visible (has class 'show' or display block)
  if ($modal.length > 0 && $modal.is(':visible')) {
    // OPTION A: Listen for standard Bootstrap close event
    // This works if the user clicks the button OR presses ESC
    $modal.on('hidden.bs.modal', function () {
      runCounterAnimation();
    });

    // OPTION B: Listen for the specific button click (Fallback)
    // We add a slight delay to allow the modal to fade out visually
    $acceptBtn.on('click', function () {
      // Assuming your theme uses Bootstrap JS to close the modal automatically.
      // If you have custom JS closing the modal, ensure this runs.
      setTimeout(function () {
        runCounterAnimation();
      }, 300);
    });
  } else {
    // No modal present (or previously accepted)? Run immediately.
    runCounterAnimation();
  }
});

/**
 * ========================================================================
 * MOBILE MENU ACCORDION
 * ========================================================================
 */
document.addEventListener('DOMContentLoaded', function () {
  // Find all instances of our mobile menu
  const mobileMenus = document.querySelectorAll('.mobile-accordion-menu');

  if (!mobileMenus.length) {
    return; // Exit if no mobile menus are found
  }

  // A counter to ensure all IDs are unique
  let subMenuCounter = 0;

  mobileMenus.forEach((menu) => {
    const parentItems = menu.querySelectorAll('.menu-item-has-children');

    parentItems.forEach((item) => {
      const link = item.querySelector('a');
      const subMenu = item.querySelector('.sub-menu');

      if (!link || !subMenu) {
        return; // Skip if structure is broken
      }

      // 1. Give the sub-menu a unique ID and Bootstrap class
      const subMenuId = `mobile-submenu-${subMenuCounter++}`;
      subMenu.id = subMenuId;
      subMenu.classList.add('collapse');

      // 2. Create the arrow toggle button
      const toggleBtn = document.createElement('button');
      toggleBtn.classList.add('arrow-toggle');
      toggleBtn.setAttribute('data-bs-toggle', 'collapse');
      toggleBtn.setAttribute('data-bs-target', `#${subMenuId}`);
      toggleBtn.setAttribute('aria-expanded', 'false');
      toggleBtn.setAttribute('aria-controls', subMenuId);
      toggleBtn.innerHTML =
        '<span class="visually-hidden">Toggle submenu</span>';

      // 3. Create a wrapper to hold the link and the new button
      // This allows them to sit side-by-side
      const wrapper = document.createElement('div');
      wrapper.classList.add('menu-item-wrapper');

      // 4. Insert the wrapper and move the link into it
      link.parentNode.insertBefore(wrapper, link);
      wrapper.appendChild(link);

      // 5. Add the toggle button into the wrapper
      wrapper.appendChild(toggleBtn);
    });
  });
});

(function () {
  function initVBVBackgroundVideos() {
    // 1. Safety check
    if (typeof Vimeo === 'undefined') {
      console.error('Vimeo API is missing.');
      return;
    }

    const heroes = document.querySelectorAll('.vbv-hero');
    console.log('VBV: found', heroes.length, 'hero(s)');

    heroes.forEach(function (hero, index) {
      const iframe = hero.querySelector('.js-vbv-hero-iframe');
      const media = hero.querySelector('.vbv-hero__media');

      if (!iframe || !media) {
        console.warn('VBV: hero', index, 'missing iframe or media wrapper');
        return;
      }

      const player = new Vimeo.Player(iframe);

      // helper – make sure we only do this once
      function markLoaded() {
        if (!media.classList.contains('video-loaded')) {
          media.classList.add('video-loaded');
          console.log('VBV: hero', index, 'marked as video-loaded');
        }
      }

      // Poll every 250ms until the video time advances
      const checkPlayStatus = setInterval(function () {
        player
          .getCurrentTime()
          .then(function (seconds) {
            if (seconds > 0.1) {
              markLoaded();
              clearInterval(checkPlayStatus);
            }
          })
          .catch(function () {
            // Ignore until the player is ready
          });
      }, 250);

      // Safety fallback after 6s
      setTimeout(function () {
        markLoaded();
        clearInterval(checkPlayStatus);
      }, 6000);

      // Force mute + play (required for autoplay in most browsers)
      player.setVolume(0);
      player.play().catch(function (err) {
        console.warn('VBV: autoplay blocked for hero', index, err);
      });
    });
  }

  // If DOM is already ready (footer script), run immediately.
  // Otherwise, hook into DOMContentLoaded.
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVBVBackgroundVideos);
  } else {
    initVBVBackgroundVideos();
  }
})();

// ========================================================================
// NAVBAR SCROLL LOGIC - Show on Scroll Up Only
// ========================================================================

document.addEventListener('DOMContentLoaded', function () {
  const navWrapper = document.querySelector('.nav-wrapper');
  const breakpoint = 992; // 992px
  const scrollThreshold = 100; // Start tracking after 100px
  const slideOutThreshold = 175; // Start sliding out at 175px from top
  let lastScrollTop = 0;
  let slideUpTimeout = null;

  if (!navWrapper) return;

  function handleScroll() {
    // Only apply on desktop
    if (window.innerWidth < breakpoint) {
      navWrapper.classList.remove('nav-hidden');
      navWrapper.classList.remove('scrolled-up');
      navWrapper.classList.remove('sliding-out');
      return;
    }

    const currentScroll = window.scrollY || document.documentElement.scrollTop;

    // If approaching the top (between 100px and 175px), start transition
    if (currentScroll <= slideOutThreshold && currentScroll > scrollThreshold) {
      if (navWrapper.classList.contains('scrolled-up')) {
        // Remove scrolled-up class and start sliding out
        navWrapper.classList.add('sliding-out');
        navWrapper.classList.remove('scrolled-up');

        // Wait for animation to finish, then remove sliding-out
        clearTimeout(slideUpTimeout);

        slideUpTimeout = setTimeout(() => {
          navWrapper.classList.remove('sliding-out');
        }, 300);
      }
      navWrapper.classList.remove('nav-hidden');
    }
    // If at the very top
    else if (currentScroll <= scrollThreshold) {
      navWrapper.classList.remove('nav-hidden');
      navWrapper.classList.remove('scrolled-up');
      navWrapper.classList.remove('sliding-out');
    }
    // If we're scrolling down and past threshold, hide the nav
    else if (
      currentScroll > lastScrollTop &&
      currentScroll > slideOutThreshold
    ) {
      navWrapper.classList.add('nav-hidden');
      navWrapper.classList.remove('scrolled-up');
      navWrapper.classList.remove('sliding-out');
    }
    // If we're scrolling up, show the nav with dark background
    else if (currentScroll < lastScrollTop) {
      navWrapper.classList.remove('nav-hidden');
      navWrapper.classList.remove('sliding-out');
      navWrapper.classList.add('scrolled-up');
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
  }

  // Run on scroll
  window.addEventListener('scroll', handleScroll, { passive: true });

  // Run on resize
  window.addEventListener('resize', handleScroll);
});

// HIDE MOBILE MENU ON SCROLL

document.addEventListener('DOMContentLoaded', function () {
  const navbar = document.querySelector('.nav-wrapper');
  let lastScrollTop = 0;
  const hideThreshold = 170; // 1. Start hiding after 170px
  const mobileBreakpoint = 991;

  if (!navbar) return;

  window.addEventListener(
    'scroll',
    function () {
      // Stop if we are on desktop
      if (window.innerWidth > mobileBreakpoint) {
        navbar.classList.remove('nav-hidden');
        return;
      }

      const currentScroll =
        window.scrollY || document.documentElement.scrollTop;

      // 2. Logic:
      // A. If we are scrolling DOWN AND have passed the 170px threshold
      if (currentScroll > lastScrollTop && currentScroll > hideThreshold) {
        navbar.classList.add('nav-hidden'); // Slide Up (Hide)
      }
      // B. If we are scrolling UP OR we are at the very top (less than 170px)
      else {
        navbar.classList.remove('nav-hidden'); // Slide Down (Show)
      }

      // Update position for next scroll event, prevent negative numbers
      lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    },
    { passive: true },
  );
});

// ========================================================================
// FADE IN MOBILE ELEMENTS ON CLICK
// ========================================================================

document.addEventListener('DOMContentLoaded', function () {
  const menuID = 'mobileCollapseMenu';
  const menuEl = document.getElementById(menuID);

  if (!menuEl) return;

  const setupAnimations = () => {
    // A. Top Bar
    const topBar = menuEl.querySelector('.navbar');
    if (topBar) topBar.classList.add('modern-fade-item');

    // B. Menu Items
    const listItems = menuEl.querySelectorAll('.mobile-accordion-menu > li');
    listItems.forEach((li) => li.classList.add('modern-fade-item'));

    // C. Form
    const bottomForm = menuEl.querySelector('.select-container');
    if (bottomForm) bottomForm.classList.add('modern-fade-item');
  };

  setupAnimations();

  // --- OPEN EVENT ---
  menuEl.addEventListener('show.bs.collapse', function (e) {
    // FIX 1: Ignore if this event came from a submenu
    if (e.target !== menuEl) return;

    const allItems = menuEl.querySelectorAll('.modern-fade-item');

    allItems.forEach((item, index) => {
      setTimeout(
        () => {
          item.classList.add('is-visible');
        },
        50 + index * 35,
      );
    });
  });

  // --- CLOSE EVENT ---
  menuEl.addEventListener('hide.bs.collapse', function (e) {
    // FIX 2: Ignore if this event came from a submenu
    // This prevents the "Blurry/Disappear" bug when clicking sub-items
    if (e.target !== menuEl) return;

    const allItems = menuEl.querySelectorAll('.modern-fade-item');

    allItems.forEach((item) => {
      item.classList.remove('is-visible');
    });
  });
});

// ========================================================================
// H1 + H3 TEXT ANIMATION
// ========================================================================

document.addEventListener('DOMContentLoaded', function () {
  // Safety Check
  if (typeof gsap !== 'undefined' && typeof SplitType !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);
    let mm = gsap.matchMedia();

    // 1. SELECTORS
    const parentTrigger = '.internal-hero__text'; // The container for both
    const h1Target = '.internal-hero__title';
    const h3Target = '.internal-hero__excerpt';

    // 2. HELPER: Text Splitting Logic (Reusable)
    // We define this to run on load and re-run on resize
    const setupSplits = () => {
      // -- Setup H3 (Global) --
      if (document.querySelector(h3Target)) {
        // Revert if exists (cleanup previous splits)
        if (window.h3SplitInstance) window.h3SplitInstance.revert();

        window.h3SplitInstance = new SplitType(h3Target, {
          types: 'lines, words',
          tagName: 'span',
        });
        jQuery(window.h3SplitInstance.lines).wrap(
          '<div class="line-wrapper" style="overflow:hidden; padding-bottom: 0.2em; margin-bottom: -0.2em;"></div>',
        );
        gsap.set(h3Target, { autoAlpha: 1 });
      }

      // -- Setup H1 (Only needed for splitting, we toggle visibility in MatchMedia) --
      if (document.querySelector(h1Target)) {
        if (window.h1SplitInstance) window.h1SplitInstance.revert();

        // Matches H3 style: Lines & Words
        window.h1SplitInstance = new SplitType(h1Target, {
          types: 'lines, words',
          tagName: 'span',
        });
        jQuery(window.h1SplitInstance.lines).wrap(
          '<div class="line-wrapper" style="overflow:hidden; padding-bottom: 0.2em; margin-bottom: -0.2em;"></div>',
        );
      }
    };

    // Run initial split
    setupSplits();

    // Handle Resize (Re-split text to fix line breaks)
    // Using debounce to prevent excessive re-splitting
    let resizeTimer;
    let windowWidth = window.innerWidth;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (windowWidth !== window.innerWidth) {
          windowWidth = window.innerWidth;
          setupSplits();
          // Refresh ScrollTrigger to recalculate start/end positions
          ScrollTrigger.refresh();
        }
      }, 250);
    });

    // 3. ANIMATION LOGIC (Responsive)

    // --- MOBILE CONTEXT (< 1200px) ---
    mm.add('(max-width: 1199px)', () => {
      // Ensure H1 is visible for GSAP control
      gsap.set(h1Target, { autoAlpha: 1 });

      if (
        document.querySelector(h1Target) &&
        document.querySelector(h3Target)
      ) {
        // Create a Master Timeline
        let tl = gsap.timeline({
          scrollTrigger: {
            trigger: parentTrigger,
            start: 'top 85%', // Trigger when the section hits this point
            toggleActions: 'play none none reverse',
          },
        });

        // A. Animate H1 First
        tl.from(window.h1SplitInstance.words, {
          yPercent: 130,
          duration: 1.0,
          ease: 'power4.out',
          stagger: 0.02,
        });

        // B. Animate H3 After H1 (with small overlap)
        // "-=0.6" means "start this 0.6 seconds BEFORE H1 finishes" for smoothness
        tl.from(
          window.h3SplitInstance.words,
          {
            yPercent: 130,
            duration: 1.0,
            ease: 'power4.out',
            stagger: 0.02,
          },
          '-=0.6',
        );
      }
    });

    // --- DESKTOP CONTEXT (>= 1200px) ---
    mm.add('(min-width: 1200px)', () => {
      // On desktop, H1 is handled by AOS, so we ignore it here.
      // We only animate H3.

      if (document.querySelector(h3Target)) {
        gsap.from(window.h3SplitInstance.words, {
          scrollTrigger: {
            trigger: h3Target,
            start: 'top 85%',
            toggleActions: 'play none none reverse',
          },
          yPercent: 130,
          duration: 1.0,
          ease: 'power4.out',
          stagger: 0.02,
        });
      }
    });
  }
});

// ========================================================================
// CLOSE MENUS WHEN ANCHOR LINKS ARE CLICKED
// ========================================================================
document.addEventListener('DOMContentLoaded', function () {
  // Get all anchor links in the navigation menus
  const anchorLinks = document.querySelectorAll('a[href*="#"]');

  anchorLinks.forEach((link) => {
    link.addEventListener('click', function (e) {
      const href = this.getAttribute('href');

      // Check if it's a hash link (anchor link) and not just "#"
      if (href && href.includes('#') && href !== '#') {
        const hashPart = href.split('#')[1];

        // Make sure there's an actual hash value
        if (hashPart) {
          // Close tablet offcanvas menu (Bootstrap 5)
          const tabletOffcanvas = document.getElementById(
            'tabletOffcanvasMenu',
          );
          if (tabletOffcanvas) {
            const bsOffcanvas =
              bootstrap.Offcanvas.getInstance(tabletOffcanvas);
            if (bsOffcanvas) {
              bsOffcanvas.hide();
            }
          }

          // Close mobile collapse menu (Bootstrap 5)
          const mobileCollapse = document.getElementById('mobileCollapseMenu');
          if (mobileCollapse && mobileCollapse.classList.contains('show')) {
            const bsCollapse = bootstrap.Collapse.getInstance(mobileCollapse);
            if (bsCollapse) {
              bsCollapse.hide();
            } else {
              // If no instance exists, create one and hide it
              const collapse = new bootstrap.Collapse(mobileCollapse, {
                toggle: false,
              });
              collapse.hide();
            }
          }

          // Close desktop mega menu if it's open
          const megaMenu = document.getElementById('mega-menu-capital');
          if (megaMenu && megaMenu.classList.contains('is-visible')) {
            megaMenu.classList.remove('is-visible');
            // Remove any animation classes
            const animatableItems = megaMenu.querySelectorAll(
              '.animate-sweep-item',
            );
            animatableItems.forEach((item) => {
              item.classList.remove('animate-sweep-item');
            });
          }
        }
      }
    });
  });
});
