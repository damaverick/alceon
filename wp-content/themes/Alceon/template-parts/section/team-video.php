<?php
/**
 * Team Video Carousel.
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

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// If no rows, bail out early
if (! have_rows('team_member_vid')) {
    return;
}
?>



<section class="growth_testimonials section--white pt-0" data-aos="fade-up" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
    <div class="container-fluid padding-y-top padding-y-btm p-0">
        <div class="row p-0">
            <div class="col-12 bg">
                <div id="mediaCarousel" class="owl-carousel">

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
