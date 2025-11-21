
<section class="vbv-hero vbv-hero--bleed" aria-hidden="true">
  <div class="vbv-hero__media">
    <iframe
      class="vbv-hero__iframe"
      src="https://player.vimeo.com/video/1135962888?background=1&autoplay=1&muted=1&loop=1&autopause=0&controls=0&title=0&byline=0&portrait=0&dnt=1"
      title="Background video"
      allow="autoplay; fullscreen; picture-in-picture"
      allowfullscreen
      frameborder="0"
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
  </div>

  <!-- Optional: show an overlay tint; comment out if not needed -->
  <div class="vbv-hero__overlay"></div>

  <!-- Noscript fallback (optional) -->
  <noscript>
    <div class="vbv-hero__image" style="background-image:url('https://alceon1dev.wpengine.com/wp-content/uploads/2025/11/home-fw-banner.png');"></div>
  </noscript>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var iframe = document.querySelector('.js-vbv-hero-iframe');
  if (!iframe) return;

  var media = iframe.closest('.vbv-hero__media');
  if (!media) return;

  function markLoaded() {
    media.classList.add('video-loaded');
  }

  iframe.addEventListener('load', markLoaded);
});
</script>
