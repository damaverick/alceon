<?php
// 1. Get the image first
$banner_image = get_field('header_image');

// 2. Set the base classes
$hero_classes = 'section--blog-hero internal-hero bg-dark-blue text-white position-relative justify-content-between d-flex flex-column';

// 3. Check the condition and append the class if true
if (is_page('terms') || (is_singular('post') && empty($banner_image))) {
    $hero_classes .= ' header-sm';
}
?>




<?php if (is_singular('post')) : ?>

  


    <header id="wrapper-navbar"  class="<?php echo esc_attr($hero_classes); ?>">
        <div class="nav-wrapper w-100 z-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php alceon_navbar(); ?>
                    </div>
                </div>

            </div>
        </div>

        <?php get_template_part('template-parts/global/mobile-menus'); ?>
        <?php get_template_part('template-parts/global/mega-menu'); ?>

        <?php
        // Resolve $banner_image (array|id|url) to a URL
        $banner_url = '';
    if (!empty($banner_image)) {
        if (is_array($banner_image) && !empty($banner_image['url'])) {
            $banner_url = esc_url($banner_image['url']);
        } elseif (is_numeric($banner_image)) {
            $maybe = wp_get_attachment_image_url((int) $banner_image, 'full');
            $banner_url = $maybe ? esc_url($maybe) : '';
        } else {
            $banner_url = esc_url((string) $banner_image);
        }
    }
?>

       

    </header>
 <?php if ($banner_url): ?>
            <section class="image-section image-section--half" aria-hidden="true">
                <div class="image-section__background"

                    style="background-image:url('<?php echo $banner_url; ?>')"></div>
            </section>
<?php endif; ?>
<?php else : ?>

    <?php
    // --- Setup Internal Hero Variables ---
    $hero_bg_image = get_field('hero_bg_image');
    $banner_image  = get_field('header_image');
    $hero_classes  = 'internal-hero bg-dark-blue text-white position-relative justify-content-between d-flex flex-column';
    $hero_style    = '';

    if ($hero_bg_image) {
        $hero_style = "background-image: url('" . esc_url($hero_bg_image) . "'); "
            . 'background-size: cover; '
            . 'background-position: bottom center; '
            . 'background-repeat: no-repeat;';
    }
    ?>

    <header id="wrapper-navbar"  class="<?php if ($hero_style) : echo 'hero-bg-image ';
    endif;
echo esc_attr($hero_classes); ?>" <?php if ($hero_style) {
    echo 'style="' . esc_attr($hero_style) . '"';
} ?>>
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


        <div class="container position-relative z-2 internal-hero__text">
            <div class="row gy-4 justify-content-between align-items-start">
                <div class="col-12 col-lg-4" data-aos="fade-up">
                    <h1 class="internal-hero__title mb-3"><?php the_title(); ?></h1>
                </div>
                <div class="col-12 col-lg-7 pe-lg-5" >
                    <?php if (get_field('hero_paragraph')) : ?><h3 class="internal-hero__excerpt h2 mb-0"><span class="me-4">/</span><?php the_field('hero_paragraph'); ?></h3><?php endif; ?>
                </div>
            </div>
        </div>
    </header>



    <?php
    // Resolve $banner_image (array|id|url) to a URL
    $banner_url = '';
if (!empty($banner_image)) {
    if (is_array($banner_image) && !empty($banner_image['url'])) {
        $banner_url = esc_url($banner_image['url']);
    } elseif (is_numeric($banner_image)) {
        $maybe = wp_get_attachment_image_url((int) $banner_image, 'full');
        $banner_url = $maybe ? esc_url($maybe) : '';
    } else {
        $banner_url = esc_url((string) $banner_image);
    }
}
?>

    <?php if ($banner_url): ?>
        <section class="image-section image-section--half" aria-hidden="true" 
        style="background-image:url('<?php echo $banner_url; ?>')" data-aos="blur-in" 
     data-aos-duration="1500"">
       
        </section>
    <?php endif; ?>


<?php endif; ?>