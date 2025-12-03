<?php
/**
 * Home Page Header
 */

// 1. Context & ID Setup
$context_id = is_singular() ? get_the_ID() : get_queried_object_id();
$unique_id  = 'hero-' . uniqid(); // Unique ID for CSS scoping

// 2. Get ACF Fields (Standard Array Format)
$type     = strtolower((string) get_field('image_or_video_background', $context_id));
$is_video = str_contains($type, 'video');

$img_desktop = get_field('full_width_image', $context_id);        // Array
$img_mobile  = get_field('header_mobile_image', $context_id);     // Array (New Field)
$video_url   = get_field('header_video', $context_id);            // String
$img_poster  = get_field('header_video_poster', $context_id);     // Array (optional poster)

// 3. Resolve URLs
$desktop_url = $img_desktop['url'] ?? '';
$mobile_url  = $img_mobile['url']  ?? '';
$poster_url  = $img_poster['url']  ?? '';

// Fallbacks:
// - Desktop: poster → desktop
// - Mobile: mobile → desktop fallback
$fallback_desktop = $poster_url ?: $desktop_url;
$fallback_mobile  = $mobile_url ?: $fallback_desktop;

// 4. Vimeo Logic (Simplified)
$vimeo_src = '';
if ($is_video && $video_url) {
    // Simple Regex to grab ID
    if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $video_url, $matches)) {
        $video_id = $matches[1];
        $params   = [
            'background' => '1',
            'autoplay'   => '1',
            'muted'      => '1',
            'loop'       => '1',
            'autopause'  => '0',
            'controls'   => '0',
            'dnt'        => '1',
        ];
        $vimeo_src = 'https://player.vimeo.com/video/' . $video_id . '?' . http_build_query($params);
    } else {
        // Fallback to image if video URL is invalid
        $is_video = false;
    }
}
?>

<header id="wrapper-navbar" class="home-hero home-hero--vbv text-white position-relative">



        <div class="nav-wrapper w-100 position-fixed z-3">
            <div class="container">
                <div class="row">
                    <div class="col"><?php alceon_navbar(); ?></div>
                </div>
            </div>
            <?php get_template_part('template-parts/global/mobile-menus'); ?>
        </div>
        <?php get_template_part('template-parts/global/mega-menu'); ?>
   

    
    
    <?php if ($fallback_desktop) : ?>
        <style>
            #<?php echo esc_attr($unique_id); ?> {
                background-image: url('<?php echo esc_url($fallback_desktop); ?>');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            @media (max-width: 767px) {
                #<?php echo esc_attr($unique_id); ?> {
                    background-image: url('<?php echo esc_url($fallback_mobile); ?>') !important;
                }
            }
        </style>
    <?php endif; ?>

    <div id="<?php echo esc_attr($unique_id); ?>" class="vbv-hero vbv-hero--bleed" aria-hidden="true">
        <div class="vbv-hero__media">
            <?php if ($is_video && $vimeo_src) : ?>
                <iframe class="vbv-hero__iframe js-vbv-hero-iframe"
                        src="<?php echo esc_url($vimeo_src); ?>"
                        title="Background video"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen
                        frameborder="0"></iframe>
            <?php endif; ?>
        </div>

        <div class="vbv-hero__overlay"></div>
    </div>

   

    <div class="home-hero__inner container">
        <div class="home-hero__content row align-items-center g-5">
            <div class="col-lg-8">
                <h1 class="hero-title" data-aos="fade-up">
                    <?php the_field('home_page_heading'); ?>
                </h1>
                <div class="home-hero__select-wrap d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                    <?php get_template_part('inc/select-drop-down'); ?>
                </div>
            </div>
        </div>
    </div>
</header>
