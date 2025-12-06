<section class="section--icon-widgets section--white">
    <div class="container">

        <div class="row">
            <div class="col" data-aos="fade-up">
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
        $modals_html = '';

        if (have_rows('resources')): ?>
            <div class="row g-4">
                <?php while (have_rows('resources')): the_row();

                    // 1. Get Common Data
                    $title = get_sub_field('resource_title');
                    $type  = get_sub_field('resource_type');
                    $cls   = $color_classes[$icon_index % count($color_classes)];

                    // 2. Logic Setup
                    $is_form = ($type === 'form');
                    $href    = '#';
                    $target  = '';
                    $attrs   = '';

                    // 3. Calculate Animation Delay (0, 100, 200...)
                    $aos_delay = $icon_index * 100;

                    if ($is_form) {
                        $modal_id = 'resourceModal-' . $icon_index;

                        // STRICT BOOTSTRAP 5 ATTRIBUTES
                        $attrs = 'data-bs-toggle="modal" data-bs-target="#' . esc_attr($modal_id) . '"';

                        // Prevent page jump
                        $href  = 'javascript:void(0);';
                    } else {
                        $url = trim((string) get_sub_field('resource_url'));
                        if ($url) {
                            $href   = esc_url($url);
                            $target = 'target="_blank" rel="noopener"';
                        }
                    }
                    ?>
                    
                    <div class="col-12 col-md-4" 
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo intval($aos_delay); ?>">
                         
                        <div class="icon-widget position-relative <?php echo esc_attr($cls); ?>">
                            <?php if ($title): ?>
                                <p class="icon-widget__text"><?php echo wp_kses_post($title); ?></p>
                            <?php endif; ?>

                            <div class="icon-widget__icon">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/icons/doc.svg'); ?>" alt="">
                            </div>

                            <a class="stretched-link"
                               href="<?php echo $href; ?>"
                               <?php echo $target; ?>
                               <?php echo $attrs; ?>
                               aria-label="<?php echo esc_attr($title ?: 'Open resource'); ?>">
                            </a>
                        </div>
                    </div>

                <?php
                        // 4. Buffer Modal HTML if this item is a Form
                        if ($is_form):
                            $embed_code = get_sub_field('hubspot_embed_code');
                            $m_title    = get_sub_field('modal_title');
                            $m_intro    = get_sub_field('modal_intro');
                            ob_start();
                            ?>
                    <div class="modal fade" 
                         id="<?php echo esc_attr($modal_id); ?>" 
                         tabindex="-1" 
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content section--gradient text-white" style="border:none; overflow:hidden;">
                                
                                <div class="modal-body p-4 p-md-5 position-relative">
                                    
                                    <button type="button" 
                                            class="btn btn-light btn-outline-white" 
                                            data-bs-dismiss="modal" 
                                            aria-label="Close"
                                            style="position:absolute; top: 2rem; right: 2rem; z-index: 10;">
                                        Close
                                    </button>

                                    <div class="row" style="margin-top: 3.5rem;"> 
                                        <div class="col-12 mb-md-5 text-start">
                                            <?php if ($m_title): ?>
                                                <h2 class="text-white mb-4"><?php echo esc_html($m_title); ?></h2>
                                            <?php endif; ?>
                                            <?php if ($m_intro): ?>
                                                <div class="text-white opacity-75 pt-2 mb-4">
                                                    <?php echo wp_kses_post(wpautop($m_intro)); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-12 text-start">
                                            <div class="custom-hubspot-form" data-hs-forms-root="true">
                                                <?php
                                                            if ($embed_code) {
                                                                echo $embed_code;
                                                            } else {
                                                                echo '<p class="text-danger">Please paste the HubSpot embed code in ACF.</p>';
                                                            }
                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        $modals_html .= ob_get_clean();
                    endif;

                    $icon_index++;
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php echo $modals_html; ?>