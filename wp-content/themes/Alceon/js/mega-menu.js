document.addEventListener('DOMContentLoaded', function () {
  // 1. CONFIGURATION
  // ==========================
  const triggerSelector = '#menu-item-57'; // The Nav Link (Investments)
  const menuID = 'mega-menu-capital'; // The Mega Menu Wrapper
  const activeClass = 'is-visible'; // Class added to wrapper
  const animationClass = 'animate-sweep-item'; // Class added to items
  const breakpoint = 992; // Mobile breakpoint
  const leaveDelay = 200; // Delay before closing (ms)

  // 2. SELECT ELEMENTS
  // ==========================
  const triggerBtn = document.querySelector(triggerSelector);
  const megaMenu = document.getElementById(menuID);
  const navWrapper = document.querySelector('.nav-wrapper');

  if (!triggerBtn || !megaMenu) return;

  const grid = megaMenu.querySelector('.mega-menu-grid');
  const columnsList = megaMenu.querySelector('.mega-menu-columns');

  // 2a. CREATE FLYOUT COLUMN & INSERT AFTER FIRST MAIN COLUMN
  // =========================================================
  let flyoutSlot = document.createElement('div');
  flyoutSlot.className = 'mega-flyout-column';

  if (columnsList) {
    const firstCol = columnsList.querySelector('.mega-col');
    if (firstCol) {
      // Insert after first .mega-col inside the UL
      if (firstCol.nextSibling) {
        columnsList.insertBefore(flyoutSlot, firstCol.nextSibling);
      } else {
        columnsList.appendChild(flyoutSlot);
      }
    } else if (grid) {
      // Fallback: put before widget col if no .mega-col found
      const widgetCol = grid.querySelector('.mega-widget-col');
      if (widgetCol) {
        grid.insertBefore(flyoutSlot, widgetCol);
      } else {
        grid.appendChild(flyoutSlot);
      }
    }
  }

  // Elements to animate when opening
  const animatableItems = megaMenu.querySelectorAll(
    'h5, h6, .mega-col-nav > li, .widget-content',
  );

  let closeTimeout = null;

  // 3. CORE FUNCTIONS
  // ==========================

  const openMenu = () => {
    if (window.innerWidth < breakpoint) return;

    if (closeTimeout) clearTimeout(closeTimeout);

    megaMenu.classList.add(activeClass);

    // Reset any inline opacity
    animatableItems.forEach((item) => {
      item.style.opacity = '';
    });

    animatableItems.forEach((item, index) => {
      item.classList.remove(animationClass);
      void item.offsetWidth; // reflow to restart CSS animation
      item.style.animationDelay = `${index * 30}ms`;
      item.classList.add(animationClass);
    });
  };

  const closeMenu = () => {
    if (window.innerWidth < breakpoint) return;

    megaMenu.classList.remove(activeClass);

    animatableItems.forEach((item) => {
      item.classList.remove(animationClass);
      item.style.opacity = '';
    });

    // Collapse flyout column
    flyoutSlot.classList.remove('is-active');
    flyoutSlot.innerHTML = '';
  };

  // 4. EVENT LISTENERS
  // ==========================

  triggerBtn.addEventListener('mouseenter', openMenu);

  triggerBtn.addEventListener('mouseleave', () => {
    closeTimeout = setTimeout(() => {
      if (!megaMenu.matches(':hover')) {
        closeMenu();
      }
    }, leaveDelay);
  });

  megaMenu.addEventListener('mouseenter', () => {
    if (closeTimeout) clearTimeout(closeTimeout);
  });

  megaMenu.addEventListener('mouseleave', closeMenu);

  window.addEventListener('resize', () => {
    if (window.innerWidth < breakpoint) {
      megaMenu.classList.remove(activeClass);
      flyoutSlot.classList.remove('is-active');
      flyoutSlot.innerHTML = '';
    }
  });

  // 5. FLYOUT COLUMN BEHAVIOUR
  // ==========================

  const flyoutTriggers = megaMenu.querySelectorAll(
    '.mega-col-nav > li.has-children',
  );

  if (flyoutTriggers.length) {
    flyoutTriggers.forEach((li) => {
      const submenu = li.querySelector('.mega-flyout-menu');
      if (!submenu) return;

      li.addEventListener('mouseenter', () => {
        // ensure submenu is visible
        submenu.style.display = 'block';

        // Move this submenu into the flyout column
        flyoutSlot.innerHTML = '';
        flyoutSlot.appendChild(submenu);
        flyoutSlot.classList.add('is-active');
      });
    });
  }

  // Hide flyout column when mouse leaves it
  flyoutSlot.addEventListener('mouseleave', () => {
    flyoutSlot.classList.remove('is-active');
    flyoutSlot.innerHTML = '';
  });

  // 6. CLOSE MENU ON SCROLL
  // ==========================
  let lastScrollTop = 0;

  window.addEventListener(
    'scroll',
    () => {
      if (window.innerWidth < breakpoint) return;

      const currentScrollTop =
        window.pageYOffset || document.documentElement.scrollTop;

      // Close mega menu on any scroll (up or down)
      if (megaMenu.classList.contains(activeClass)) {
        closeMenu();
      }

      lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
    },
    false,
  );
});
