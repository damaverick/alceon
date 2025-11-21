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
