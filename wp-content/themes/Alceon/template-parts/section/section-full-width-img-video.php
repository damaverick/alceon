<?php
/**
 * Content Section (Image or Video)
 * Uses get_sub_field for Flexible Content contexts
 */

// 1. Get ACF Fields
$type     = strtolower( (string) get_sub_field( 'image_or_video_background' ) );
$is_video = str_contains( $type, 'video' );

$img_array  = get_sub_field( 'full_width_image' ); // Array
$video_url  = get_sub_field( 'full_width_video' );
$img_poster = get_sub_field( 'full_width_video_poster_image' ); // Array

// 2. Resolve URLs
$bg_url     = $img_array['url'] ?? '';
$poster_url = $img_poster['url'] ?? $bg_url;

// 3. Vimeo Logic
$vimeo_src = '';
if ( $is_video && $video_url ) {
    if ( preg_match( '/vimeo\.com\/(?:video\/)?(\d+)/', $video_url, $matches ) ) {
        $params = [
            'background' => '1', 'autoplay' => '1', 'muted' => '1', 'loop' => '1',
            'autopause' => '0', 'controls' => '0', 'dnt' => '1'
        ];
        $vimeo_src = 'https://player.vimeo.com/video/' . $matches[1] . '?' . http_build_query( $params );
    } else {
        $is_video = false; // Invalid URL, fallback to image
    }
}
?>

<?php if ( $is_video ) : ?>
    
    <section class="vbv-hero vbv-hero--bleed" aria-hidden="true">
        <div class="vbv-hero__media">
            <?php if ( $poster_url ) : ?>
                <div class="vbv-hero__poster" style="background-image:url('<?php echo esc_url( $poster_url ); ?>');"></div>
            <?php endif; ?>

            <iframe class="vbv-hero__iframe js-vbv-hero-iframe"
                    src="<?php echo esc_url( $vimeo_src ); ?>"
                    title="Background video" allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen frameborder="0"></iframe>
        </div>
        <div class="vbv-hero__overlay"></div>
    </section>

<?php else : ?>

    <section class="image-section image-section--full" aria-hidden="true">
        <?php if ( $bg_url ) : ?>
            <div class="image-section__background"
                 style="background-image:url('<?php echo esc_url( $bg_url ); ?>');"
                 data-parallax data-speed="0.25"></div>
        <?php else: ?>
            <div class="image-section__background"></div>
        <?php endif; ?>
    </section>

<?php endif; ?>