<?php
/**
 * Team Video Carousel
 *
 * Flexible layout: include_team_video
 * Repeater: team_member_vid
 * Subfields:
 * - name_vid            (Text)
 * - title_vid           (Text)
 * - video_preview_vid   (File)
 * - video_vid           (Link)
 */

$is_flexible = isset($args['is_flexible']) && $args['is_flexible'];

// If no rows, bail out early
if (! have_rows('team_member_vid')) {
    return;
}
?>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Owl Carousel JS (jQuery should already be loaded by WordPress) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<section class="growth_testimonials section--white pt-0">
    <div class="container-fluid padding-y-top padding-y-btm p-0">
        <div class="row p-0">
            <div class="col-12 bg">
                <div id="talentCommunity" class="owl-carousel">

                    <?php while (have_rows('team_member_vid')) : the_row(); ?>
                        <?php
                        $name        = get_sub_field('name_vid');
                        $title       = get_sub_field('title_vid');
                        $preview     = get_sub_field('video_preview_vid'); // file
                        $video_link  = get_sub_field('video_vid');         // link

                        // File field can be array or URL depending on ACF settings
                        $preview_url = '';
                        if (is_array($preview) && ! empty($preview['url'])) {
                            $preview_url = $preview['url'];
                        } elseif (is_string($preview)) {
                            $preview_url = $preview;
                        }

                        // Link field can be array or string
                        $video_url = '';
                        if (is_array($video_link) && ! empty($video_link['url'])) {
                            $video_url = $video_link['url'];
                        } elseif (is_string($video_link)) {
                            $video_url = $video_link;
                        }
                        ?>

                        <div class="item">
                            <div class="video_item">
                                <?php if ($preview_url) : ?>
                                    <video loop muted playsinline autoplay class="hide_testimonial_mob">
                                        <source src="<?php echo esc_url($preview_url); ?>" type="video/mp4">
                                    </video>
                                    <video loop muted playsinline autoplay class="hide_testimonial_desk">
                                        <source src="<?php echo esc_url($preview_url); ?>" type="video/mp4">
                                    </video>
                                <?php endif; ?>
                            </div>

                            <div class="caption">
                                <div class="animation_container">
                                    <div class="hover">
                                        <p class="text"></p>
                                    </div>
                                </div>

                                <?php if ($name) : ?>
                                    <h4 class="text-white mb-1">
                                        <?php echo esc_html($name); ?>
                                    </h4>
                                <?php endif; ?>

                                <?php if ($title) : ?>
                                    <p class="text-white mb-3">
                                        <?php echo esc_html($title); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($video_url) : ?>
                                    <a class="btn pill btn-outline-white glightbox"
                                       href="<?php echo esc_url($video_url); ?>">
                                        <span class="inner z-index--2 relative">Watch Video</span>
                                        <span class="hover BtnPosition"></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endwhile; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- GLightbox CSS -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<!-- Magnific Popup CSS (optional; only if still used elsewhere) -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />

<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<!-- Magnific Popup JS (optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
  // custom nav icons – update paths if needed
  const prevIcon = '<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/left-arrow.svg" alt="Left">';
  const nextIcon = '<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/right-arrow.svg" alt="Right">';

  jQuery(document).ready(function ($) {

    if ($("#talentCommunity").length > 0) {
      $("#talentCommunity").owlCarousel({
        items: 4,
        loop: true,
        dots: true,
        margin: 0,
        slideBy: 1,
        dotsEach: 1,
        nav: true,
        navText: [prevIcon, nextIcon],
        responsive: {
          0:   { items: 1 },
          768: { items: 2 },
          1080:{ items: 4 }
        },
        onInitialized: wrapOwlControls
      });
    }

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

    // Desktop hover-to-play behaviour
    if (window.innerWidth > 1024) {
      $("#talentCommunity video").each(function () {
        this.pause();
      });
      $("#talentCommunity .item").hover(
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

    // Optional: Magnific Popup for any .popup-* links
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false
    });

    // GLightbox for .glightbox links
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

  });
</script>
