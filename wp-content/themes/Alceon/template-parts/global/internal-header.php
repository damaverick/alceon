<?php
// Get ACF fields
$banner_url = get_field('header_image');
$hero_bg_image = get_field('hero_bg_image');
$hero_paragraph = get_field('hero_paragraph');

// Build hero classes
$hero_classes = 'internal-hero bg-dark-blue text-white position-relative justify-content-between d-flex flex-column';
if (is_singular('post')) {
    $hero_classes = 'section--blog-hero ' . $hero_classes;
    if (is_page('terms') || empty($banner_url)) {
        $hero_classes .= ' header-sm';
    }
}

// Build hero background style
$hero_style = '';
if ($hero_bg_image && !is_singular('post')) {
    $hero_style = sprintf(
        "background-image: url('%s'); background-size: cover; background-position: bottom center; background-repeat: no-repeat;",
        esc_url($hero_bg_image)
    );
    $hero_classes = 'hero-bg-image ' . $hero_classes;
}
?>

<header id="wrapper-navbar" class="<?php echo esc_attr($hero_classes); ?>" <?php echo $hero_style ? 'style="' . esc_attr($hero_style) . '"' : ''; ?>>
    <div class="nav-wrapper w-100 z-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php alceon_navbar(); ?>
                </div>
            </div>
        </div>
        <?php get_template_part('template-parts/global/mobile-menus'); ?>
    </div>

    <?php get_template_part('template-parts/global/mega-menu'); ?>

    <?php if (!is_singular('post')) : ?>
        <div class="container position-relative z-2 internal-hero__text">
            <div class="row gy-4 justify-content-between align-items-start">
                <div class="col-12 col-lg-4" data-aos="fade-up">
                    <h1 class="internal-hero__title mb-3"><?php the_title(); ?></h1>
                </div>
                <div class="col-12 col-lg-7 pe-lg-5">
                    <?php if ($hero_paragraph) : ?>
                        <h3 class="internal-hero__excerpt h2 mb-0"><?php echo esc_html($hero_paragraph); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</header>

<?php if ($banner_url) : ?>
    <section class="image-section image-section--half" aria-hidden="true" <?php echo is_singular('post') ? '' : 'style="background-image:url(\'' . $banner_url . '\')" data-aos="blur-in" data-aos-duration="1500"'; ?>>
        <?php if (is_singular('post')) : ?>
            <div class="image-section__background" style="background-image:url('<?php echo $banner_url; ?>')"></div>
        <?php endif; ?>
    </section>
<?php endif; ?>