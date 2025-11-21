<section class="section--icon-widgets pt-0">
    <div class="container">

        <div class="row">
            <div class="col">
                <h2 class="mb-5">Resources</h2>
            </div>
        </div>

        <?php
        $color_classes = [
            'icon-widget--blue',
            'icon-widget--lightblue',
            'icon-widget--pac-blue',
            'icon-widget--purple',
            'icon-widget--violet',
            'icon-widget--bronze',
        ];
        $icon_index = 0;

        if (have_rows('resources')): ?>
            <div class="row g-4">
                <?php while (have_rows('resources')): the_row();
                    $title = get_sub_field('resource_title');           // text
                    $url   = trim((string) get_sub_field('resource_url')); // ACF URL field
                    // Basic sanity check
                    $href  = $url ? esc_url($url) : '';
                    $cls   = $color_classes[$icon_index % count($color_classes)];
                ?>
                    <div class="col-12 col-md-4">
                        <div class="icon-widget position-relative <?php echo esc_attr($cls); ?>">
                            <?php if ($title): ?>
                                <p class="icon-widget__text"><?php echo wp_kses_post($title); ?></p>
                            <?php endif; ?>

                            <div class="icon-widget__icon">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/icons/doc.svg'); ?>" alt="">
                            </div>

                            <?php if ($href): ?>
                                <a
                                    class="stretched-link"
                                    href="<?php echo $href; ?>"
                                    target="_blank" rel="noopener"
                                    aria-label="<?php echo esc_attr($title ?: 'Open resource'); ?>"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                    $icon_index++;
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>