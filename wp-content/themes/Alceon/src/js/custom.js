(function () {
  function initVBVBackgroundVideos() {
    // 1. Safety check
    if (typeof Vimeo === "undefined") {
      console.error("Vimeo API is missing.");
      return;
    }

    const heroes = document.querySelectorAll(".vbv-hero");
    console.log("VBV: found", heroes.length, "hero(s)");

    heroes.forEach(function (hero, index) {
      const iframe = hero.querySelector(".js-vbv-hero-iframe");
      const media = hero.querySelector(".vbv-hero__media");

      if (!iframe || !media) {
        console.warn("VBV: hero", index, "missing iframe or media wrapper");
        return;
      }

      const player = new Vimeo.Player(iframe);

      // helper – make sure we only do this once
      function markLoaded() {
        if (!media.classList.contains("video-loaded")) {
          media.classList.add("video-loaded");
          console.log("VBV: hero", index, "marked as video-loaded");
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
        console.warn("VBV: autoplay blocked for hero", index, err);
      });
    });
  }

  // If DOM is already ready (footer script), run immediately.
  // Otherwise, hook into DOMContentLoaded.
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initVBVBackgroundVideos);
  } else {
    initVBVBackgroundVideos();
  }
})();

//  MEGA MENU

document.addEventListener("DOMContentLoaded", function () {
  const menuItem = document.querySelector("#menu-item-57");
  const mainMenu = document.querySelector(".menu-wrapper");
  const megaMenu = document.getElementById("mega-menu-capital");

  if (!menuItem || !mainMenu || !megaMenu) return;

  // --- MODIFIED FUNCTIONS ---

  const positionMegaMenu = () => {
    // 1. Only run on desktop
    if (window.innerWidth < 992) return;

    const rectMenu = mainMenu.getBoundingClientRect();
    const rectItem = menuItem.getBoundingClientRect();

    megaMenu.style.position = "absolute";
    megaMenu.style.top = `${rectItem.bottom + window.scrollY}px`;
    megaMenu.style.left = `${rectMenu.left + window.scrollX}px`;
    megaMenu.style.width = `${rectMenu.width}px`;
  };

  const showMenu = () => {
    // 2. Only run on desktop
    if (window.innerWidth < 992) return;

    positionMegaMenu();
    megaMenu.style.display = "block";
  };

  const hideMenu = () => {
    // 3. Only run on desktop
    if (window.innerWidth < 992) return;

    megaMenu.style.display = "none";
  };

  // --- MODIFIED EVENTS ---

  // Desktop hover (these are now safe because the functions check the width)
  menuItem.addEventListener("mouseenter", showMenu);
  menuItem.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!megaMenu.matches(":hover")) hideMenu();
    }, 150);
  });
  megaMenu.addEventListener("mouseleave", hideMenu);

  // 4. Mobile click listener has been REMOVED

  // 5. Adjust on resize (modified to hide menu if resized to mobile)
  window.addEventListener("resize", () => {
    if (window.innerWidth < 992) {
      megaMenu.style.display = "none"; // Force hide on mobile
    } else {
      // If it was already open and we're resizing on desktop, reposition it
      if (megaMenu.style.display === "block") {
        positionMegaMenu();
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const menuWrapper = document.getElementById("mega-menu-capital");

  // Select all items we want to animate in the specific DOM order
  // This order creates the "Left-to-Right, Top-to-Bottom" sweep naturally
  const animatableItems = menuWrapper.querySelectorAll("h5, h6, li");

  // FUNCTION: Call this when you want to OPEN the menu
  window.showMegaMenu = function () {
    // 1. Show the wrapper
    menuWrapper.style.display = "block";

    // 2. Loop through items to add animation with staggered delay
    animatableItems.forEach((item, index) => {
      // Remove class first to reset animation if it was opened previously
      item.classList.remove("animate-sweep-item");

      // Force a browser reflow (magic trick to allow animation restart)
      void item.offsetWidth;

      // Set the delay.
      // index * 30 means: Item 1 = 0ms, Item 2 = 30ms, Item 3 = 60ms...
      item.style.animationDelay = `${index * 40}ms`;

      // Add the class to start animation
      item.classList.add("animate-sweep-item");
    });
  };

  // FUNCTION: Call this when you want to CLOSE the menu
  window.hideMegaMenu = function () {
    menuWrapper.style.display = "none";

    // Optional: Reset opacity instantly so it's clean for next time
    animatableItems.forEach((item) => {
      item.classList.remove("animate-sweep-item");
      item.style.opacity = "0";
    });
  };
});
