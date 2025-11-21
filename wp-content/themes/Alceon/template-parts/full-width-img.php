<section class="image-section image-section--full" aria-hidden="true">
  <?php if ($is_video): ?>
    <div class="image-section__background">
      <video class="image-section__video"
        autoplay
        muted
        loop
        playsinline
        preload="metadata"
        <?php if ($poster_url) echo 'poster="' . $poster_url . '"'; ?>>
        <source src="<?php echo esc_url($video_url); ?>" type="<?php echo esc_attr($video_type); ?>">
        <!-- Fallback text -->
        Your browser does not support the video tag.
      </video>
    </div>

    <?php if ($img_url): // optional <noscript> image fallback 
    ?>
      <noscript>
        <div class="image-section__background" style="background-image:url('<?php echo $img_url; ?>');"></div>
      </noscript>
    <?php endif; ?>

  <?php else: // IMAGE path (default/fallback) 
  ?>
    <?php if ($img_url): ?>
      <div class="image-section__background" style="background-image:url('<?php echo $img_url; ?>');" data-parallax
        data-speed="0.25"></div>
    <?php else: ?>
      <div class="image-section__background"></div>
    <?php endif; ?>
  <?php endif; ?>
</section>

<script>
  (function() {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce) return;

    const items = Array.from(document.querySelectorAll('[data-parallax]'));
    if (!items.length) return;

    const active = new Set();
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => entry.isIntersecting ? active.add(entry.target) : active.delete(entry.target));
    }, {
      rootMargin: '10% 0px 10% 0px'
    });

    items.forEach(el => io.observe(el));

    let ticking = false;

    function update() {
      active.forEach(el => {
        const speed = parseFloat(el.getAttribute('data-speed')) || 0.25;
        const host = el.closest('.header-hero') || el.parentElement;
        const rect = host.getBoundingClientRect();
        const vh = window.innerHeight || document.documentElement.clientHeight;

        // progress relative to viewport center
        const centerOffset = (rect.top + rect.height / 2) - (vh / 2);
        const y = -centerOffset * speed;

        el.style.transform = 'translate3d(0,' + y.toFixed(1) + 'px,0)';
      });
      ticking = false;
    }

    function onScroll() {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(update);
    }

    // kick off & bind
    onScroll();
    window.addEventListener('scroll', onScroll, {
      passive: true
    });
    window.addEventListener('resize', onScroll);
  })();
</script>