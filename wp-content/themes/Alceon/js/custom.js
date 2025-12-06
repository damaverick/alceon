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
              }
            );

            observer.unobserve(el);
          }
        });
      },
      { threshold: 0.5 }
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
// MEGA MENU + SWEEP ANIMATION COMBINED
// ========================================================================

document.addEventListener('DOMContentLoaded', function () {
  // 1. Select Elements
  const menuItem = document.querySelector('#menu-item-57');
  const mainMenu = document.querySelector('.menu-wrapper');
  const megaMenu = document.getElementById('mega-menu-capital');

  // Safety check: Exit if elements don't exist
  if (!menuItem || !mainMenu || !megaMenu) return;

  // 2. Select Animation Items (for the sweep effect)
  // This selects headers and list items in DOM order for the "wave" effect
  const animatableItems = megaMenu.querySelectorAll('h5, h6, li');

  // --- FUNCTIONS ---

  const positionMegaMenu = () => {
    // Only run on desktop
    if (window.innerWidth < 992) return;

    const rectMenu = mainMenu.getBoundingClientRect();

    // 1. Detect WordPress Admin Bar displacement
    // WordPress adds 'margin-top' to the <html> tag when logged in. We need to grab that value.
    const htmlMarginTop =
      parseFloat(window.getComputedStyle(document.documentElement).marginTop) ||
      0;

    megaMenu.style.position = 'absolute';

    // 2. Subtract the admin bar height (htmlMarginTop) from the final calculation
    // Formula: [Menu Bottom] + [Scroll Position] + [20px Gap] - [Admin Bar Offset]
    megaMenu.style.top = `${rectMenu.bottom + window.scrollY + 20 - htmlMarginTop}px`;

    megaMenu.style.left = `${rectMenu.left + window.scrollX}px`;
    megaMenu.style.width = `${rectMenu.width}px`;
  };
  const showMenu = () => {
    // Only run on desktop
    if (window.innerWidth < 992) return;

    // 1. Handle Position and Display
    positionMegaMenu();
    megaMenu.style.display = 'block';

    // 2. Trigger Sweep Animation
    animatableItems.forEach((item, index) => {
      // Remove class to reset animation
      item.classList.remove('animate-sweep-item');

      // Force Reflow (Magic trick to restart animation instantly)
      void item.offsetWidth;

      // Set Staggered Delay (40ms per item)
      item.style.animationDelay = `${index * 40}ms`;

      // Add class to fade in and slide
      item.classList.add('animate-sweep-item');
    });
  };

  const hideMenu = () => {
    // Only run on desktop
    if (window.innerWidth < 992) return;

    megaMenu.style.display = 'none';

    // Reset items to invisible so they don't flash when opened next time
    animatableItems.forEach((item) => {
      item.classList.remove('animate-sweep-item');
      // Ensure they are hidden again (CSS handles this, but this is a safety)
      item.style.opacity = '0';
    });
  };

  // --- EVENT LISTENERS ---

  // Desktop Hover Events
  menuItem.addEventListener('mouseenter', showMenu);

  menuItem.addEventListener('mouseleave', () => {
    // Small delay to allow user to move mouse from link into the mega menu
    setTimeout(() => {
      if (!megaMenu.matches(':hover')) {
        hideMenu();
      }
    }, 150);
  });

  megaMenu.addEventListener('mouseleave', hideMenu);

  // Resize Logic
  window.addEventListener('resize', () => {
    if (window.innerWidth < 992) {
      megaMenu.style.display = 'none'; // Force hide on mobile
    } else {
      // If it was already open and we're resizing on desktop, reposition it
      if (megaMenu.style.display === 'block') {
        positionMegaMenu();
      }
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const navbar = document.getElementById('wrapper-navbar');
  const breakpoint = 992; // 992px
  const scrollThreshold = 50; // Add class after scrolling 50px

  function handleScroll() {
    // 1. Check if screen is wide enough
    if (window.innerWidth >= breakpoint) {
      // 2. Check vertical scroll position
      if (window.scrollY > scrollThreshold) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    } else {
      // Optional: Ensure class is removed on mobile
      navbar.classList.remove('scrolled');
    }
  }

  // Run on scroll
  window.addEventListener('scroll', handleScroll);

  // Run on resize (in case user resizes window from mobile to desktop)
  window.addEventListener('resize', handleScroll);
});

document.addEventListener('DOMContentLoaded', function () {
  // 1. Select Elements
  const navbar = document.getElementById('wrapper-navbar');
  const logo = document.querySelector('.site-logo');

  // Safety check
  if (!logo || !navbar) {
    console.warn('Logo swapper: Elements not found');
    return;
  }

  function checkLogoBackground() {
    // 2. Get the specific coordinate of the center of the logo
    const rect = logo.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;

    // 3. Get ALL elements underneath that specific pixel
    // This returns an array of elements (Navbar, Header, Section, Body, HTML)
    const elementsUnderLogo = document.elementsFromPoint(centerX, centerY);

    // 4. Check if ANY element in that stack has your light background classes
    // We use .closest() to ensure we catch it even if the logo is over a <p> or <h2> inside the section
    const isOverLight = elementsUnderLogo.some((el) => {
      return (
        el.classList.contains('section--white') ||
        el.classList.contains('section--grey') ||
        el.closest('.section--white') ||
        el.closest('.section--grey')
      );
    });

    // 5. Toggle the class on the ID wrapper
    if (isOverLight) {
      navbar.classList.add('on-light-bg');
    } else {
      navbar.classList.remove('on-light-bg');
    }
  }

  // 6. Run on Scroll and Resize
  window.addEventListener('scroll', checkLogoBackground, { passive: true });
  window.addEventListener('resize', checkLogoBackground);

  // 7. Run once on load to set initial state
  checkLogoBackground();
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
    { passive: true }
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
        50 + index * 35
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
        });
        jQuery(window.h3SplitInstance.lines).wrap(
          '<div class="line-wrapper" style="overflow:hidden; padding-bottom: 0.2em; margin-bottom: -0.2em;"></div>'
        );
        gsap.set(h3Target, { autoAlpha: 1 });
      }

      // -- Setup H1 (Only needed for splitting, we toggle visibility in MatchMedia) --
      if (document.querySelector(h1Target)) {
        if (window.h1SplitInstance) window.h1SplitInstance.revert();

        // Matches H3 style: Lines & Words
        window.h1SplitInstance = new SplitType(h1Target, {
          types: 'lines, words',
        });
        jQuery(window.h1SplitInstance.lines).wrap(
          '<div class="line-wrapper" style="overflow:hidden; padding-bottom: 0.2em; margin-bottom: -0.2em;"></div>'
        );
      }
    };

    // Run initial split
    setupSplits();

    // Handle Resize (Re-split text to fix line breaks)
    let windowWidth = window.innerWidth;
    window.addEventListener('resize', function () {
      if (windowWidth !== window.innerWidth) {
        windowWidth = window.innerWidth;
        setupSplits();
        // Refresh ScrollTrigger to recalculate start/end positions
        ScrollTrigger.refresh();
      }
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
          '-=0.6'
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
